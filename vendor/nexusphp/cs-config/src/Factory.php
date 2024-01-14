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

use Nexus\CsConfig\Ruleset\RulesetInterface;
use PhpCsFixer\Config;
use PhpCsFixer\ConfigInterface;
use PhpCsFixer\Finder;

/**
 * The Factory class is invoked on each project's `.php-cs-fixer.dist.php` to create
 * the specific ruleset for the project.
 */
final class Factory
{
    /**
     * @param array{
     *     cacheFile: string,
     *     customFixers: iterable<\PhpCsFixer\Fixer\FixerInterface>,
     *     finder: \PhpCsFixer\Finder|iterable<\SplFileInfo>,
     *     format: string,
     *     hideProgress: bool,
     *     indent: string,
     *     lineEnding: string,
     *     phpExecutable: null|string,
     *     isRiskyAllowed: bool,
     *     usingCache: bool,
     *     rules: array<string, array<string, mixed>|bool>
     * } $options Array of resolved options
     */
    private function __construct(private RulesetInterface $ruleset, private array $options) {}

    /**
     * Prepares the ruleset and options before the `PhpCsFixer\Config` object
     * is created.
     *
     * @param array<string, array<string, mixed>|bool> $overrides
     * @param array{
     *     cacheFile?: string,
     *     customFixers?: iterable<\PhpCsFixer\Fixer\FixerInterface>,
     *     finder?: \PhpCsFixer\Finder|iterable<\SplFileInfo>,
     *     format?: string,
     *     hideProgress?: bool,
     *     indent?: string,
     *     lineEnding?: string,
     *     phpExecutable?: null|string,
     *     isRiskyAllowed?: bool,
     *     usingCache?: bool,
     *     customRules?: array<string, array<string, mixed>|bool>
     * } $options
     */
    public static function create(RulesetInterface $ruleset, array $overrides = [], array $options = []): self
    {
        if (\PHP_VERSION_ID < $ruleset->getRequiredPHPVersion()) {
            throw new \RuntimeException(sprintf(
                'The "%s" ruleset requires a minimum PHP_VERSION_ID of "%d" but current PHP_VERSION_ID is "%d".',
                $ruleset->getName(),
                $ruleset->getRequiredPHPVersion(),
                \PHP_VERSION_ID,
            ));
        }

        // Meant to be used in vendor/ to get to the root directory
        $dir = \dirname(__DIR__, 4);
        $dir = (string) realpath($dir);

        $defaultFinder = Finder::create()
            ->files()
            ->in([$dir])
            ->exclude(['build'])
        ;

        // Resolve Config options
        $options['cacheFile'] ??= '.php-cs-fixer.cache';
        $options['customFixers'] ??= [];
        $options['finder'] ??= $defaultFinder;
        $options['format'] ??= 'txt';
        $options['hideProgress'] ??= false;
        $options['indent'] ??= '    ';
        $options['lineEnding'] ??= "\n";
        $options['phpExecutable'] ??= null;
        $options['isRiskyAllowed'] ??= $ruleset->willAutoActivateIsRiskyAllowed();
        $options['usingCache'] ??= true;
        $options['rules'] = array_merge($ruleset->getRules(), $overrides, $options['customRules'] ?? []);

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

        $header = sprintf(
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
     *
     * @internal
     */
    private function invoke(array $overrides = []): ConfigInterface
    {
        $rules = array_merge($this->options['rules'], $overrides);

        return (new Config($this->ruleset->getName()))
            ->registerCustomFixers($this->options['customFixers'])
            ->setCacheFile($this->options['cacheFile'])
            ->setFinder($this->options['finder'])
            ->setFormat($this->options['format'])
            ->setHideProgress($this->options['hideProgress'])
            ->setIndent($this->options['indent'])
            ->setLineEnding($this->options['lineEnding'])
            ->setPhpExecutable($this->options['phpExecutable'])
            ->setRiskyAllowed($this->options['isRiskyAllowed'])
            ->setUsingCache($this->options['usingCache'])
            ->setRules($rules)
        ;
    }
}
