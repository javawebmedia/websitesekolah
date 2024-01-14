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

namespace Nexus\CsConfig\Ruleset;

abstract class AbstractRuleset implements RulesetInterface
{
    /**
     * Name of the ruleset.
     */
    protected string $name = '';

    /**
     * Rules for the ruleset.
     *
     * @var array<string, array<string, array<string>|bool|string>|bool>
     */
    protected array $rules = [];

    /**
     * Minimum PHP version.
     *
     * @phpstan-var int<0, max>
     */
    protected int $requiredPHPVersion = 0;

    /**
     * Have this ruleset turn on `$isRiskyAllowed` flag?
     */
    protected bool $autoActivateIsRiskyAllowed = false;

    /**
     * {@inheritDoc}
     */
    final public function getName(): string
    {
        if ('' !== $this->name) {
            return $this->name;
        }

        if (str_contains(static::class, '\\')) {
            $class = str_replace('\\', '/', static::class);

            return basename($class);
        }

        return static::class;
    }

    /**
     * {@inheritDoc}
     */
    final public function getRules(): array
    {
        return $this->rules;
    }

    /**
     * {@inheritDoc}
     */
    final public function getRequiredPHPVersion(): int
    {
        return $this->requiredPHPVersion;
    }

    /**
     * {@inheritDoc}
     */
    final public function willAutoActivateIsRiskyAllowed(): bool
    {
        return $this->autoActivateIsRiskyAllowed;
    }
}
