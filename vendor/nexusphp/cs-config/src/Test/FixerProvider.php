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
use PhpCsFixer\Fixer\DeprecatedFixerInterface;
use PhpCsFixer\Fixer\FixerInterface;
use PhpCsFixer\FixerFactory;
use PhpCsFixer\RuleSet\RuleSet;

final class FixerProvider
{
    /**
     * Built-in fixers from php-cs-fixer.
     *
     * @var array<string, FixerInterface>
     */
    private static array $builtIn = [];

    /**
     * @param array<int, string>                                      $configured configured fixers from a ruleset
     * @param array<string, array<string, bool|string|string[]>|bool> $enabled    enabled fixers from a ruleset
     */
    private function __construct(private array $configured, private array $enabled) {}

    public static function create(RulesetInterface $ruleset): self
    {
        if ([] === self::$builtIn) {
            $fixers = array_filter(
                (new FixerFactory())->registerBuiltInFixers()->getFixers(),
                static fn(FixerInterface $fixer): bool => ! $fixer instanceof DeprecatedFixerInterface,
            );
            $names = array_map(static fn(FixerInterface $fixer): string => $fixer->getName(), $fixers);

            self::$builtIn = array_combine($names, $fixers);
        }

        $rules = $ruleset->getRules();

        $configured = array_map(static function ($ruleConfiguration): bool {
            return true; // force enable all rules
        }, $rules);

        return new self(array_keys((new RuleSet($configured))->getRules()), $rules);
    }

    public static function reset(): void
    {
        self::$builtIn = [];
    }

    /**
     * Returns the names and instances of built-in fixers.
     *
     * @return array<string, FixerInterface>
     */
    public function builtin(): array
    {
        return self::$builtIn;
    }

    /**
     * Returns the names of the configured fixers.
     *
     * @return array<int, string>
     */
    public function configured(): array
    {
        return $this->configured;
    }

    /**
     * Returns the enabled rules from a ruleset and
     * their configuration.
     *
     * @return array<string, array<string, bool|string|string[]>|bool>
     */
    public function enabled(): array
    {
        return $this->enabled;
    }
}
