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

interface RulesetInterface
{
    /**
     * Name of this ruleset.
     */
    public function getName(): string;

    /**
     * Defined rules for this ruleset.
     *
     * @return array<string, array<string, array<string>|bool|string>|bool>
     */
    public function getRules(): array;

    /**
     * Returns the minimum `PHP_VERSION_ID`
     * that is required by this ruleset.
     */
    public function getRequiredPHPVersion(): int;

    /**
     * Does this ruleset have risky rules?
     *
     * If yes and `PhpCsFixer\Config` has the `$isRiskyAllowed`
     * flag set to `false`, those risky rules won't be run.
     *
     * Set this flag to `true` to automatically setup
     * the `$isRiskyAllowed` flag.
     */
    public function willAutoActivateIsRiskyAllowed(): bool;
}
