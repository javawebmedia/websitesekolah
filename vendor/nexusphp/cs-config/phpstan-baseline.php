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

$ignoreErrors = [];
$ignoreErrors[] = [
    'message' => '#^Call to static method PHPUnit\\\\Framework\\\\Assert\\:\\:assertSame\\(\\) with arguments "\\\\n", string and string will always evaluate to true\\.$#',
    'count' => 1,
    'path' => __DIR__.'/src/Test/AbstractCustomFixerTestCase.php',
];
$ignoreErrors[] = [
    'message' => '#^Method Nexus\\\\CsConfig\\\\Test\\\\AbstractCustomFixerTestCase\\:\\:getLinter\\(\\) should return PhpCsFixer\\\\Linter\\\\LinterInterface but returns mixed\\.$#',
    'count' => 1,
    'path' => __DIR__.'/src/Test/AbstractCustomFixerTestCase.php',
];
$ignoreErrors[] = [
    'message' => '#^Only numeric types are allowed in pre\\-increment, int\\<0, max\\>\\|false given\\.$#',
    'count' => 1,
    'path' => __DIR__.'/src/Test/AbstractCustomFixerTestCase.php',
];
$ignoreErrors[] = [
    'message' => '#^Cannot access offset \'header\' on array\\<string, mixed\\>\\|bool\\.$#',
    'count' => 1,
    'path' => __DIR__.'/tests/FactoryTest.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to static method PHPUnit\\\\Framework\\\\Assert\\:\\:assertEmpty\\(\\) with non\\-empty\\-array will always evaluate to false\\.$#',
    'count' => 1,
    'path' => __DIR__.'/tests/Test/FixerProviderTest.php',
];
$ignoreErrors[] = [
    'message' => '#^Method \\S+Test\\:\\:\\S+ return type has no value type specified in iterable type iterable\\.$#',
];

return ['parameters' => ['ignoreErrors' => $ignoreErrors]];
