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

/**
 * @todo v4.0.0 Merge this with `RulesetInterface`.
 */
interface ConfigurableAllowedUnsupportedPhpVersionRulesetInterface extends RulesetInterface
{
    /**
     * @internal
     */
    public const PHP_CS_FIXER_MAX_SUPPORTED_PHP_VERSION_ID = 8_05_99;

    /**
     * Returns whether this ruleset allows unsupported PHP versions.
     *
     * If this returns `true`, the PHP-CS-Fixer will not throw an error
     * when the current PHP version is more than the required PHP version.
     */
    public function isUnsupportedPhpVersionAllowed(): bool;
}
