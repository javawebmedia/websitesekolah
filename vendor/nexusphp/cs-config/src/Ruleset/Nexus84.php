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
 * Ruleset for `Nexus` group.
 *
 * @internal
 */
final class Nexus84 extends AbstractRuleset
{
    public function __construct()
    {
        $this->name = 'Nexus for PHP 8.4';
        $this->rules = [
            ...(new Nexus83())->getRules(),
            'new_expression_parentheses' => ['use_parentheses' => false],
        ];
        $this->requiredPHPVersion = 8_04_01;
        $this->autoActivateIsRiskyAllowed = true;
    }
}
