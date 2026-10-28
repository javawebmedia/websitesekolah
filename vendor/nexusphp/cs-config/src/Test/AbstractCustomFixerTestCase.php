<?php

declare(strict_types=1);

/**
 * This file is part of Nexus CS Config.
 *
 * (c) 2020 John Paul E. Balandan, CPA <paulbalandan@gmail.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace Nexus\CsConfig\Test;

use Nexus\CsConfig\Fixer\AbstractCustomFixer;
use PhpCsFixer\AbstractFixer;
use PhpCsFixer\Fixer\ConfigurableFixerInterface;
use PhpCsFixer\Fixer\DeprecatedFixerInterface;
use PhpCsFixer\FixerConfiguration\FixerOptionInterface;
use PhpCsFixer\FixerDefinition\FileSpecificCodeSampleInterface;
use PhpCsFixer\FixerDefinition\VersionSpecificCodeSampleInterface;
use PhpCsFixer\FixerNameValidator;
use PhpCsFixer\Linter\CachingLinter;
use PhpCsFixer\Linter\LinterInterface;
use PhpCsFixer\Linter\ProcessLinter;
use PhpCsFixer\Preg;
use PhpCsFixer\Tokenizer\Token;
use PhpCsFixer\Tokenizer\Tokens;
use PHPUnit\Framework\TestCase;

/**
 * Used for testing the fixers.
 *
 * Most of the tests here are directly from `PhpCsFixer\Tests\Test\AbstractFixerTestCase`
 * with some modifications and additions, since the test case is not shipped to production.
 *
 * @author Dariusz Rumiński <dariusz.ruminski@gmail.com>
 * @author John Paul E. Balandan, CPA <paulbalandan@gmail.com>
 *
 * @deprecated v3.26.0
 */
abstract class AbstractCustomFixerTestCase extends TestCase
{
    protected AbstractCustomFixer $fixer;
    protected LinterInterface $linter;

    protected function setUp(): void
    {
        parent::setUp();

        $this->fixer = $this->createFixer();
        $this->linter = $this->getLinter();
    }

    final public function testIsRisky(): void
    {
        $riskyDescription = $this->fixer->getDefinition()->getRiskyDescription();

        if ($this->fixer->isRisky()) {
            self::assertIsString($riskyDescription);
            self::assertValidDescription($this->fixer->getName(), 'risky description', $riskyDescription);
        } else {
            self::assertNull($riskyDescription, \sprintf('[%s] Fixer is not risky so no description of it is expected.', $this->fixer->getName()));
        }

        $reflection = new \ReflectionMethod($this->fixer, 'isRisky');

        self::assertSame(
            ! $this->fixer->isRisky(),
            $reflection->getDeclaringClass()->getName() === AbstractFixer::class,
            \sprintf(
                '[%s] Fixer is %s so the method "AbstractFixer::isRisky()" must be %s.',
                $this->fixer->getName(),
                $this->fixer->isRisky() ? 'risky' : 'not risky',
                $this->fixer->isRisky() ? 'overridden' : 'used',
            ),
        );
    }

    final public function testNameIsValid(): void
    {
        $nameValidator = new FixerNameValidator();
        $customFixerName = $this->fixer->getName();

        self::assertTrue(
            $nameValidator->isValid($customFixerName, true),
            \sprintf('Fixer name "%s" is not valid.', $customFixerName),
        );
    }

    final public function testFixerIsFinal(): void
    {
        self::assertTrue(
            (new \ReflectionClass($this->fixer))->isFinal(),
            \sprintf('Fixer "%s" must be declared "final".', $this->fixer->getName()),
        );
    }

    final public function testDeprecatedFixersHaveCorrectSummary(): void
    {
        self::assertStringNotContainsString(
            'DEPRECATED',
            $this->fixer->getDefinition()->getSummary(),
            'Fixer cannot contain word "DEPRECATED" in summary',
        );

        $comment = (new \ReflectionClass($this->fixer))->getDocComment();
        self::assertIsString($comment, \sprintf('[%s] Fixer is missing a class-level PHPDoc.', $this->fixer->getName()));

        if ($this->fixer instanceof DeprecatedFixerInterface) {
            self::assertStringContainsString('@deprecated', $comment);
        } else {
            self::assertStringNotContainsString('@deprecated', $comment);
        }
    }

    final public function testFixerConfigurationDefinitions(): void
    {
        if (! $this->fixer instanceof ConfigurableFixerInterface) {
            $this->addToAssertionCount(1); // not applied to the fixer without configuration

            return;
        }

        $configurationDefinition = $this->fixer->getConfigurationDefinition();

        foreach ($configurationDefinition->getOptions() as $option) {
            self::assertInstanceOf(FixerOptionInterface::class, $option);
            self::assertNotEmpty($option->getDescription());

            self::assertTrue(
                $option->hasDefault(),
                \sprintf(
                    'Option `%s` of fixer `%s` should have a default value.',
                    $option->getName(),
                    $this->fixer->getName(),
                ),
            );

            self::assertStringNotContainsString(
                'DEPRECATED',
                $option->getDescription(),
                'Option description cannot contain word "DEPRECATED"',
            );
        }
    }

    final public function testFixerDefinitions(): void
    {
        $fixerName = $this->fixer->getName();
        $definition = $this->fixer->getDefinition();

        self::assertValidDescription($fixerName, 'summary', $definition->getSummary());

        $samples = $definition->getCodeSamples();
        self::assertNotEmpty($samples, \sprintf('[%s] Code samples are required.', $fixerName));

        $configSamplesProvided = [];
        $dummyFileInfo = new \SplFileInfo(__FILE__);

        foreach ($samples as $counter => $sample) {
            self::assertIsInt($counter);

            ++$counter;
            $code = $sample->getCode();
            self::assertNotEmpty($code, \sprintf('[%s] Code provided by sample #%d must not be empty.', $fixerName, $counter));
            self::assertSame("\n", substr($code, -1), \sprintf('[%s] Sample #%d must end with linebreak', $fixerName, $counter));

            $config = $sample->getConfiguration();

            if (null !== $config) {
                self::assertInstanceOf(
                    ConfigurableFixerInterface::class,
                    $this->fixer,
                    \sprintf('[%s] Sample #%d has configuration, but the fixer is not configurable.', $fixerName, $counter),
                );

                $configSamplesProvided[$counter] = $config;
            } elseif ($this->fixer instanceof ConfigurableFixerInterface) {
                if (! $sample instanceof VersionSpecificCodeSampleInterface) {
                    self::assertArrayNotHasKey(
                        'default',
                        $configSamplesProvided,
                        \sprintf('[%s] Multiple non-versioned samples with default configuration.', $fixerName),
                    );
                }

                $configSamplesProvided['default'] = true;
            }

            if ($sample instanceof VersionSpecificCodeSampleInterface && ! $sample->isSuitableFor(\PHP_VERSION_ID)) {
                continue;
            }

            if ($this->fixer instanceof ConfigurableFixerInterface) {
                // always re-configure as the fixer might have been configured with diff. configuration from previous sample
                $this->fixer->configure($config ?? []);
            }

            Tokens::clearCache();
            $tokens = Tokens::fromCode($code);

            $this->fixer->fix(
                $sample instanceof FileSpecificCodeSampleInterface ? $sample->getSplFileInfo() : $dummyFileInfo,
                $tokens,
            );

            self::assertTrue($tokens->isChanged(), \sprintf('[%s] Sample #%d is not changed during fixing.', $fixerName, $counter));

            $duplicatedCodeSample = array_search(
                $sample,
                \array_slice($samples, 0, $counter - 1),
                true,
            );

            self::assertFalse(
                $duplicatedCodeSample,
                \sprintf('[%s] Sample #%d duplicates #%d.', $fixerName, $counter, (int) $duplicatedCodeSample + 1),
            );
        }

        if ($this->fixer instanceof ConfigurableFixerInterface) {
            if (isset($configSamplesProvided['default'])) {
                reset($configSamplesProvided);
                self::assertSame('default', key($configSamplesProvided), \sprintf('[%s] First sample must be for the default configuration.', $fixerName));
            }

            if (\count($configSamplesProvided) < 2) {
                self::fail(\sprintf('[%s] Configurable fixer only provides a default configuration sample and none for its configuration options.', $fixerName));
            }

            $options = $this->fixer->getConfigurationDefinition()->getOptions();

            foreach ($options as $option) {
                self::assertMatchesRegularExpression('/^[a-z_]+[a-z]$/', $option->getName(), \sprintf('[%s] Option %s is not snake_case.', $fixerName, $option->getName()));
            }
        }
    }

    /**
     * Tests if a fixer fixes a given string to match the expected result.
     *
     * It is used both if you want to test if something is fixed or if it is not touched by the fixer.
     *
     * It also makes sure that the expected output does not change when run through the fixer. That means that you
     * do not need two test cases like [$expected] and [$expected, $input] (where $expected is the same in both cases)
     * as the latter covers both of them.
     *
     * This method throws an exception if $expected and $input are equal to prevent test cases that accidentally do
     * not test anything.
     *
     * @param string      $expected The expected fixer output
     * @param null|string $input    The fixer input, or null if it should intentionally be equal to the output
     */
    protected function doTest(string $expected, ?string $input = null): void
    {
        if ($expected === $input) {
            throw new \LogicException('Input parameter must not be equal to expected parameter.'); // @codeCoverageIgnore
        }

        $file = new \SplFileInfo(__FILE__);

        if (null !== $input) {
            self::assertNull($this->lintSource($input));

            Tokens::clearCache();
            $tokens = Tokens::fromCode($input);

            self::assertTrue($this->fixer->isCandidate($tokens), 'Fixer must be a candidate for input code.');
            self::assertFalse($tokens->isChanged(), 'Fixer must not touch Tokens on candidate check.');
            $this->fixer->fix($file, $tokens);

            self::assertSame(
                $expected,
                $tokens->generateCode(),
                'Code build on input code must match expected code.',
            );
            self::assertTrue($tokens->isChanged(), 'Tokens collection built on input code must be marked as changed after fixing.');

            $tokens->clearEmptyTokens();

            /** @var list<Token> $tokensArray */
            $tokensArray = $tokens->toArray();

            self::assertCount(
                \count($tokens),
                array_unique(array_map(static fn(Token $token): string => spl_object_hash($token), $tokensArray)),
                'Token items inside Tokens collection must be unique.',
            );

            unset($tokensArray);
            Tokens::clearCache();
            $expectedTokens = Tokens::fromCode($expected);
            self::assertTokens($expectedTokens, $tokens);
        }

        self::assertNull($this->lintSource($expected));

        Tokens::clearCache();
        $tokens = Tokens::fromCode($expected);
        $this->fixer->fix($file, $tokens);

        self::assertSame(
            $expected,
            $tokens->generateCode(),
            'Code build on expected code must not change.',
        );
        self::assertFalse($tokens->isChanged(), 'Tokens collection built on expected code must not be marked as changed after fixing.');
    }

    protected function createFixer(): AbstractCustomFixer
    {
        /** @phpstan-var class-string<AbstractCustomFixer> $customFixer */
        $customFixer = Preg::replace('/^(Nexus\\\\CsConfig)\\\\Tests(\\\\.+)Test$/', '$1$2', static::class);

        return new $customFixer();
    }

    /**
     * @codeCoverageIgnore
     */
    protected function lintSource(string $source): ?string
    {
        try {
            $this->linter->lintSource($source)->check();

            return null;
        } catch (\Throwable $e) {
            return \sprintf('Linting "%s" failed with message: %s.', $source, $e->getMessage());
        }
    }

    private function getLinter(): LinterInterface
    {
        /** @var null|CachingLinter $linter */
        static $linter = null;

        if (null === $linter) {
            $linter = new CachingLinter(new ProcessLinter());
        }

        return $linter;
    }

    private static function assertTokens(Tokens $expectedTokens, Tokens $inputTokens): void
    {
        self::assertCount($expectedTokens->count(), $inputTokens, 'Both Tokens collections should have the same size.');

        foreach ($expectedTokens as $index => $expectedToken) {
            $inputToken = $inputTokens[$index];

            self::assertInstanceOf(Token::class, $expectedToken, 'Expected token is null.');
            self::assertInstanceOf(Token::class, $inputToken, 'Input token is null.');
            self::assertTrue(
                $expectedToken->equals($inputToken),
                \sprintf("Token at index %d must be:\n%s,\ngot:\n%s.", $index, $expectedToken->toJson(), $inputToken->toJson()),
            );
        }
    }

    private static function assertValidDescription(string $fixerName, string $descriptionType, string $description): void
    {
        self::assertMatchesRegularExpression('/^[A-Z`][^"]+\.$/', $description, \sprintf('[%s] The %s must start with capital letter or a ` and end with dot.', $fixerName, $descriptionType));
        self::assertStringNotContainsString('phpdocs', $description, \sprintf('[%s] `PHPDoc` must not be in the plural in %s.', $fixerName, $descriptionType));
        self::assertCorrectCasing($description, 'PHPDoc', \sprintf('[%s] `PHPDoc` must be in correct casing in %s.', $fixerName, $descriptionType));
        self::assertCorrectCasing($description, 'PHPUnit', \sprintf('[%s] `PHPUnit` must be in correct casing in %s.', $fixerName, $descriptionType));
        self::assertFalse(strpos($descriptionType, '``'), \sprintf('[%s] The %s must not contain sequential backticks.', $fixerName, $descriptionType));
    }

    private static function assertCorrectCasing(string $needle, string $haystack, string $message): void
    {
        self::assertSame(
            substr_count(strtolower($haystack), strtolower($needle)),
            substr_count($haystack, $needle),
            $message,
        );
    }
}
