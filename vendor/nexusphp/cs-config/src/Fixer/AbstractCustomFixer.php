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

namespace Nexus\CsConfig\Fixer;

use PhpCsFixer\AbstractFixer;
use PhpCsFixer\Utils;

abstract class AbstractCustomFixer extends AbstractFixer
{
    /**
     * Vendor namespace in fixer's name.
     */
    protected static ?string $namespace;

    /**
     * Returns the fixer name for easy use in fixer registration and usage.
     */
    public static function name(): string
    {
        $nameParts = explode('\\', static::class);
        $namespace = static::$namespace ?? $nameParts[0];
        $name = substr(end($nameParts), 0, -\strlen('Fixer'));

        return $namespace.'/'.Utils::camelCaseToUnderscore($name);
    }

    /**
     * {@inheritDoc}
     */
    public function getName(): string
    {
        return self::name();
    }
}
