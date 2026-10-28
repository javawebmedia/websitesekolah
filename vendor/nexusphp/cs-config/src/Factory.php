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

namespace Nexus\CsConfig;

use Nexus\CsConfig\Ruleset\ConfigurableAllowedUnsupportedPhpVersionRulesetInterface;
use Nexus\CsConfig\Ruleset\RulesetInterface;
use PhpCsFixer\Config;
use PhpCsFixer\Config\RuleCustomisationPolicyInterface;
use PhpCsFixer\ConfigInterface;
use PhpCsFixer\Console\Application;
use PhpCsFixer\Finder;
use PhpCsFixer\Fixer\FixerInterface;
use PhpCsFixer\Runner\Parallel\ParallelConfigFactory;

/**
 * The Factory class is invoked on each project's `.php-cs-fixer.dist.php` to create
 * the specific ruleset for the project.
 */
final class Factory
{
    /**
     * @param array{
     *     cacheFile: non-empty-string,
     *     customFixers: iterable<FixerInterface>,
     *     finder: Finder|iterable<\SplFileInfo>,
     *     format: string,
     *     hideProgress: bool,
     *     indent: non-empty-string,
     *     lineEnding: non-empty-string,
     *     isRiskyAllowed: bool,
     *     usingCache: bool,
     *     ruleCustomisers: null|RuleCustomisationPolicyInterface,
     *     rules: array<string, array<string, mixed>|bool>
     * } $options Array of resolved options
     */
    private function __construct(
        private RulesetInterface $ruleset,
        private array $options,
    ) {}

    /**
     * Prepares the ruleset and options before the `PhpCsFixer\Config` object
     * is created.
     *
     * @param array<string, array<string, mixed>|bool> $overrides
     * @param array{
     *     cacheFile?: non-empty-string,
     *     customFixers?: iterable<FixerInterface>,
     *     finder?: Finder|iterable<\SplFileInfo>,
     *     format?: string,
     *     hideProgress?: bool,
     *     indent?: non-empty-string,
     *     lineEnding?: non-empty-string,
     *     isRiskyAllowed?: bool,
     *     usingCache?: bool,
     *     ruleCustomisers?: null|RuleCustomisationPolicyInterface,
     *     customRules?: array<string, array<string, mixed>|bool>
     * } $options
     */
    public static function create(RulesetInterface $ruleset, array $overrides = [], array $options = []): self
    {
        if (\PHP_VERSION_ID < $ruleset->getRequiredPHPVersion()) {
            throw new \RuntimeException(\sprintf(
                'The "%s" ruleset requires a minimum PHP_VERSION_ID of "%d" but current PHP_VERSION_ID is "%d".',
                $ruleset->getName(),
                $ruleset->getRequiredPHPVersion(),
                \PHP_VERSION_ID,
            ));
        }

        // Resolve Config options
        $options['cacheFile'] ??= '.php-cs-fixer.cache';
        $options['customFixers'] ??= [];
        // Default finder meant to be used in vendor/ to get to the root directory
        $options['finder'] ??= Finder::create()
            ->files()
            ->in([(string) realpath(\dirname(__DIR__, 4))])
            ->exclude(['build'])
        ;
        $options['format'] ??= 'txt';
        $options['hideProgress'] ??= false;
        $options['indent'] ??= '    ';
        $options['lineEnding'] ??= "\n";
        $options['isRiskyAllowed'] ??= $ruleset->willAutoActivateIsRiskyAllowed();
        $options['usingCache'] ??= true;
        $options['ruleCustomisers'] ??= null;
        $options['rules'] = array_merge($ruleset->getRules(), $overrides, $options['customRules'] ?? []);

        unset($options['customRules']);

        return new self($ruleset, $options);
    }

    /**
     * Creates a `PhpCsFixer\Config` object that is applicable for libraries,
     * i.e., has their own header docblock in place.
     */
    public function forLibrary(string $library, string $author, string $email = '', ?int $startingYear = null): ConfigInterface
    {
        $year = (string) $startingYear;

        if ('' !== $year) {
            $year .= ' ';
        }

        if ('' !== $email) {
            $email = trim($email, '<>');
            $email = ' <'.$email.'>';
        }

        $header = \sprintf(
            <<<'HEADER'
                This file is part of %s.

                (c) %s%s%s

                For the full copyright and license information, please view
                the LICENSE file that was distributed with this source code.
                HEADER,
            $library,
            $year,
            $author,
            $email,
        );

        return $this->invoke([
            'header_comment' => [
                'header' => trim($header),
                'comment_type' => 'PHPDoc',
                'location' => 'after_declare_strict',
                'separate' => 'both',
            ],
        ]);
    }

    /**
     * Plain invocation of `Config` with no additional arguments.
     */
    public function forProjects(): ConfigInterface
    {
        return $this->invoke();
    }

    /**
     * The main method of creating the Config instance.
     *
     * @param array<string, array<string, mixed>|bool> $overrides
     */
    private function invoke(array $overrides = []): ConfigInterface
    {
        /** @var Config $config */
        $config = (new Config($this->ruleset->getName()))
            ->setParallelConfig(ParallelConfigFactory::detect())
            ->registerCustomFixers($this->options['customFixers'])
            ->setCacheFile($this->options['cacheFile'])
            ->setFinder($this->options['finder'])
            ->setFormat($this->options['format'])
            ->setHideProgress($this->options['hideProgress'])
            ->setIndent($this->options['indent'])
            ->setLineEnding($this->options['lineEnding'])
            ->setRiskyAllowed($this->options['isRiskyAllowed'])
            ->setUsingCache($this->options['usingCache'])
            ->setRules([...$this->options['rules'], ...$overrides])
        ;

        // @todo v4.0.0 Cleanup
        if ($this->ruleset instanceof ConfigurableAllowedUnsupportedPhpVersionRulesetInterface) {
            /** @var Config $config */
            $config = $config->setUnsupportedPhpVersionAllowed(
                $this->ruleset->isUnsupportedPhpVersionAllowed(),
            );
        }

        // @todo v4.0.0 Cleanup
        if (version_compare(Application::VERSION, '3.92.0', '>=')) {
            /** @var Config $config */
            $config = $config->setRuleCustomisationPolicy($this->options['ruleCustomisers']);
        }

        return $config;
    }
}
