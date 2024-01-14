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

use Nexus\CsConfig\Ruleset\RulesetInterface;
use PhpCsFixer\Fixer\ConfigurableFixerInterface;
use PhpCsFixer\Fixer\FixerInterface;
use PhpCsFixer\FixerConfiguration\DeprecatedFixerOptionInterface;
use PhpCsFixer\FixerConfiguration\FixerOptionInterface;
use PhpCsFixer\Preg;
use PHPUnit\Framework\TestCase;

/**
 * Used for testing the rulesets.
 */
abstract class AbstractRulesetTestCase extends TestCase
{
    /**
     * @var array<string, FixerInterface>
     */
    private static array $builtInFixers = [];

    /**
     * @var array<int, string>
     */
    private static array $configuredFixers = [];

    /**
     * @var array<string, array<string, bool|string|string[]>|bool>
     */
    private static array $enabledFixers = [];

    /**
     * @codeCoverageIgnore
     */
    public static function setUpBeforeClass(): void
    {
        $fixerProvider = FixerProvider::create(static::createRuleset());
        self::$builtInFixers = $fixerProvider->builtin();
        self::$configuredFixers = $fixerProvider->configured();
        self::$enabledFixers = $fixerProvider->enabled();
    }

    /**
     * @codeCoverageIgnore
     */
    public static function tearDownAfterClass(): void
    {
        FixerProvider::reset();
        self::$builtInFixers = [];
        self::$configuredFixers = [];
        self::$enabledFixers = [];
    }

    // =========================================================================
    // TESTS
    // =========================================================================

    final public function testAllConfiguredFixersAreNotUsingPresets(): void
    {
        $fixersThatArePresets = array_filter(
            self::$enabledFixers,
            static fn(string $fixer): bool => substr($fixer, 0, 1) === '@',
            ARRAY_FILTER_USE_KEY,
        );

        self::assertEmpty($fixersThatArePresets, sprintf(
            '[%s] Ruleset should not be using rule sets (presets) as fixers. Found: "%s".',
            static::createRuleset()->getName(),
            implode('", "', array_keys($fixersThatArePresets)),
        ));
    }

    final public function testAllBuiltInFixersNotDeprecatedAreConfiguredInThisRuleset(): void
    {
        $fixersNotConfigured = array_diff(array_keys(self::$builtInFixers), self::$configuredFixers);

        sort($fixersNotConfigured);
        $c = \count($fixersNotConfigured);

        self::assertEmpty($fixersNotConfigured, sprintf(
            '[%s] Non-deprecated built-in %s "%s" %s not configured in the ruleset.',
            static::createRuleset()->getName(),
            $c > 1 ? 'fixers' : 'fixer',
            implode('", "', $fixersNotConfigured),
            $c > 1 ? 'are' : 'is',
        ));
    }

    final public function testAllConfiguredFixersInThisRulesetAreBuiltInAndNotDeprecated(): void
    {
        $fixersNotBuiltIn = array_diff(self::$configuredFixers, array_keys(self::$builtInFixers));

        sort($fixersNotBuiltIn);
        $c = \count($fixersNotBuiltIn);

        self::assertEmpty($fixersNotBuiltIn, sprintf(
            '[%s] Ruleset used %s "%s" which %s unknown and/or deprecated in PhpCsFixer.',
            static::createRuleset()->getName(),
            $c > 1 ? 'fixers' : 'fixer',
            implode('", "', $fixersNotBuiltIn),
            $c > 1 ? 'are' : 'is',
        ));
    }

    final public function testAllConfiguredFixersInThisRulesetAreSortedByName(): void
    {
        $fixers = self::$configuredFixers;
        $sorted = $fixers;
        sort($sorted);

        self::assertSame($sorted, $fixers, sprintf(
            '[%s] Fixers are not sorted by name.',
            static::createRuleset()->getName(),
        ));
    }

    final public function testHeaderCommentFixerIsDisabledByDefault(): void
    {
        self::assertArrayHasKey('header_comment', self::$enabledFixers);
        self::assertFalse(self::$enabledFixers['header_comment']);
    }

    /**
     * @dataProvider provideEnabledConfigurableFixerUsesAllAvailableOptionsNotDeprecatedCases
     *
     * @param string[] $goodOptions
     * @param string[] $deprecatedOptions
     */
    final public function testEnabledConfigurableFixerUsesAllAvailableOptionsNotDeprecated(string $name, array $goodOptions, array $deprecatedOptions): void
    {
        /** @var null|array<string, bool|string|string[]>|bool $ruleConfiguration */
        $ruleConfiguration = self::$enabledFixers[$name] ?? null;

        if (null === $ruleConfiguration) {
            self::markTestSkipped(sprintf('`%s` is not yet defined in this ruleset.', $name)); // @codeCoverageIgnore
        }

        if (false === $ruleConfiguration) {
            // fixer is turned off
            $this->addToAssertionCount(1);

            return;
        }

        $ruleConfiguration = \is_array($ruleConfiguration) ? $ruleConfiguration : [];
        $ruleConfiguration = array_keys($ruleConfiguration);

        $missingOptions = array_diff($goodOptions, $ruleConfiguration);
        $usedDeprecatedOptions = array_intersect($deprecatedOptions, $ruleConfiguration);
        $extraUsedOptions = array_diff($ruleConfiguration, $goodOptions);

        self::assertEmpty($missingOptions, sprintf(
            'Enabled configurable fixer "%s" does not use its available array %s "%s". Missing %s: "%s".',
            $name,
            \count($goodOptions) > 1 ? 'options' : 'option',
            implode('", "', $goodOptions),
            \count($missingOptions) > 1 ? 'options' : 'option',
            implode('", "', $missingOptions),
        ));
        self::assertEmpty($usedDeprecatedOptions, sprintf(
            'Enabled configurable fixer "%s" uses deprecated %s: "%s".',
            $name,
            \count($usedDeprecatedOptions) > 1 ? 'options' : 'option',
            implode('", "', $usedDeprecatedOptions),
        ));
        self::assertEmpty($extraUsedOptions, sprintf(
            '%s "%s" for enabled configurable fixer "%s" %s not defined by PhpCsFixer.',
            \count($extraUsedOptions) > 1 ? 'Options' : 'Option',
            implode('", "', $extraUsedOptions),
            $name,
            \count($extraUsedOptions) > 1 ? 'are' : 'is',
        ));
    }

    /**
     * @codeCoverageIgnore
     *
     * @return iterable<string, array{0: string, 1: string[], 2: string[]}>
     */
    public static function provideEnabledConfigurableFixerUsesAllAvailableOptionsNotDeprecatedCases(): iterable
    {
        $fixers = FixerProvider::create(static::createRuleset())->builtin();
        ksort($fixers);

        foreach ($fixers as $name => $fixer) {
            if ($fixer instanceof ConfigurableFixerInterface) {
                $options = $fixer->getConfigurationDefinition()->getOptions();

                $goodOptions = array_map(
                    static fn(FixerOptionInterface $option): string => $option->getName(),
                    array_filter(
                        $options,
                        static fn(FixerOptionInterface $option): bool => ! $option instanceof DeprecatedFixerOptionInterface,
                    ),
                );

                $deprecatedOptions = array_map(
                    static fn(FixerOptionInterface $option): string => $option->getName(),
                    array_filter(
                        $options,
                        static fn(FixerOptionInterface $option): bool => $option instanceof DeprecatedFixerOptionInterface,
                    ),
                );

                yield $name => [$name, $goodOptions, $deprecatedOptions];
            }
        }
    }

    protected static function createRuleset(): RulesetInterface
    {
        /** @phpstan-var class-string<RulesetInterface> $className */
        $className = Preg::replace('/^(Nexus\\\\CsConfig)\\\\Tests(\\\\.+)Test$/', '$1$2', static::class);

        return new $className();
    }
}
