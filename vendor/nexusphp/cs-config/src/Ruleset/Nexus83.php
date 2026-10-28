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
final class Nexus83 extends AbstractRuleset
{
    public function __construct()
    {
        $this->name = 'Nexus for PHP 8.3';
        $this->rules = [
            ...(new Nexus82())->getRules(),
            'phpdoc_readonly_class_comment_to_keyword' => true,
            'php_unit_test_case_static_method_calls' => [
                'call_type' => 'self',
                'methods' => [],
                'target' => 'newest',
            ],
        ];
        $this->requiredPHPVersion = 8_03_00;
        $this->autoActivateIsRiskyAllowed = true;
    }
}
