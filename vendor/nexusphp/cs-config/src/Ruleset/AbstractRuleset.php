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

abstract class AbstractRuleset implements ConfigurableAllowedUnsupportedPhpVersionRulesetInterface
{
    /**
     * Name of the ruleset.
     */
    protected string $name = '';

    /**
     * Rules for the ruleset.
     *
     * @var array<string, array<string, bool|list<string>|string>|bool>
     */
    protected array $rules = [];

    /**
     * Minimum PHP version.
     *
     * @var int<80100, 90000>
     */
    protected int $requiredPHPVersion = 8_01_00;

    /**
     * Have this ruleset turn on `$isRiskyAllowed` flag?
     */
    protected bool $autoActivateIsRiskyAllowed = false;

    /**
     * Allow unsupported PHP versions.
     */
    protected bool $isUnsupportedPhpVersionAllowed = \PHP_VERSION_ID > self::PHP_CS_FIXER_MAX_SUPPORTED_PHP_VERSION_ID;

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

    final public function getRules(): array
    {
        return $this->rules;
    }

    final public function getRequiredPHPVersion(): int
    {
        return $this->requiredPHPVersion;
    }

    final public function willAutoActivateIsRiskyAllowed(): bool
    {
        return $this->autoActivateIsRiskyAllowed;
    }

    final public function isUnsupportedPhpVersionAllowed(): bool
    {
        return $this->isUnsupportedPhpVersionAllowed;
    }
}
