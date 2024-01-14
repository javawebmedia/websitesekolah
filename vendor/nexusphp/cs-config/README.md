# Nexus CS Config

[![PHP version](https://img.shields.io/packagist/php-v/nexusphp/cs-config)](https://php.net)
![build](https://github.com/NexusPHP/cs-config/workflows/build/badge.svg?branch=develop)
[![Coverage Status](https://coveralls.io/repos/github/NexusPHP/cs-config/badge.svg?branch=develop)](https://coveralls.io/github/NexusPHP/cs-config?branch=develop)
[![Latest Stable Version](https://poser.pugx.org/nexusphp/cs-config/v)](//packagist.org/packages/nexusphp/cs-config)
[![license MIT](https://img.shields.io/github/license/nexusphp/cs-config)](LICENSE)
[![Total Downloads](https://poser.pugx.org/nexusphp/cs-config/downloads)](//packagist.org/packages/nexusphp/cs-config)

This library provides a factory for custom rulesets for [`friendsofphp/php-cs-fixer`][1].

[1]: https://github.com/FriendsOfPHP/PHP-CS-Fixer

## Installation

You can add this library as a local, per-project dependency to your project
using [Composer](https://getcomposer.org/):

    composer require nexusphp/cs-config

If you only need this library during development, for instance to run your project's test suite,
then you should add it as a development-time dependency:

    composer require --dev nexusphp/cs-config

## Configuration

* Create a `.php-cs-fixer.dist.php` at the root of your project:

```php
<?php

use Nexus\CsConfig\Factory;
use Nexus\CsConfig\Ruleset\Nexus73;

return Factory::create(new Nexus73())->forProjects();

```

* Include the cache file in your `.gitignore`. By
default, the cache file will be saved in the project root.

```diff
 vendor/

+# php-cs-fixer
+.php-cs-fixer.php
+.php-cs-fixer.cache
```

## Advanced Configuration

### Adding Preformatted License Header

You can create a preformatted license header to all PHP files by using the public `forLibrary()` method
instead of `forProjects()`. This method accepts two required arguments (the library name and author) and
two optional arguments (the email address and starting year of license).

* Scenario 1: Providing all arguments
```diff
 <?php

 use Nexus\CsConfig\Factory;
 use Nexus\CsConfig\Ruleset\Nexus73;

-return Factory::create(new Nexus73())->forProjects();
+return Factory::create(new Nexus73())->forLibrary('My Library', 'John Doe', 'john@doe.com', 2020);
```

This setting will configure a license header similar to below:

```php
<?php

/**
 * This file is part of My Library.
 *
 * (c) 2020 John Doe <john@doe.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace Nexus\CsConfig;
```

* Scenario 2: Providing only the required arguments

If you opted not to provide any of the optional arguments (i.e., email address, starting license year),
these will not be shown on the license header allowing flexibility on the copyright portion.

```diff
<?php

 use Nexus\CsConfig\Factory;
 use Nexus\CsConfig\Ruleset\Nexus73;

-return Factory::create(new Nexus73())->forProjects();
+return Factory::create(new Nexus73())->forLibrary('My Library', 'John Doe');
```

This will give the following license header:

```php
<?php

/**
 * This file is part of My Library.
 *
 * (c) John Doe
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace Nexus\CsConfig;
```

### Overriding Rules in a Ruleset

If you feel that a specific rule in the ruleset is not appropriate for you, you can override it instead of creating a new ruleset:

```diff
 <?php

 use Nexus\CsConfig\Factory;
 use Nexus\CsConfig\Ruleset\Nexus73;

-return Factory::create(new Nexus73())->forProjects();
+return Factory::create(new Nexus73(), [
+    'binary_operator_spaces' => false,
+])->forProjects();

```

### Specifying Options to `PhpCsFixer\Config`

The `Factory` class returns an instance of `PhpCsFixer\Config` and fully supports all of
its properties setup. You can pass an array to the third parameter of `Factory::create()`
containing your desired options.

**Options**

| Key            | Allowed Types                            | Default                              |
| -------------- | :--------------------------------------: | :----------------------------------: |
| cacheFile      | `string`                                 | `.php-cs-fixer.cache`                |
| customFixers   | `FixerInterface[], iterable, \Traversable` | `[]`                                 |
| finder         | `iterable, string[], \Traversable`         | default `PhpCsFixer\Finder` instance |
| format         | `string`                                 | `txt`                                |
| hideProgress   | `bool`                                   | `false`                              |
| indent         | `string`                                 | `'    '` // 4 spaces                 |
| lineEnding     | `string`                                 | `"\n"`                               |
| phpExecutable  | `null, string`                           | `null`                               |
| isRiskyAllowed | `bool`                                   | `false`                              |
| usingCache     | `bool`                                   | `true`                               |
| customRules    | `array`                                  | `[]`                                 |

```diff
 <?php

 use Nexus\CsConfig\Factory;
 use Nexus\CsConfig\Ruleset\Nexus73;

-return Factory::create(new Nexus73())->forProjects();
+return Factory::create(new Nexus73(), [], [
+    'usingCache'  => false,
+    'hideProgress => true,
+])->forProjects();
```

## Customization of Ruleset

What is the purpose of a configuration factory if not able to create a custom ruleset for
an organization-wide usage, right? Well, you are not constrained to use the default rulesets
and putting a long array of overrides. That's pretty nasty.

The way to achieve this is dependent on you but the main idea is creating a new ruleset that
extends `Nexus\CsConfig\Ruleset\AbstractRuleset`. Yup, it's that easy. Then you just need to
provide details for its required four (4) protected properties.

```php
<?php

namespace MyCompany\CodingStandards\Ruleset;

use Nexus\CsConfig\Ruleset\AbstractRuleset;

final class MyCompany extends AbstractRuleset
{
  public function __construct()
  {
    $this->name = 'My Company';
    $this->rules = [
      '@PSR2' => true,
      ...
    ];
    $this->requiredPHPVersion = 70400;
    $this->autoActivateIsRiskyAllowed = true;
  }
}

```

Then, in creating your `.php-cs-fixer.dist.php`, use your own ruleset.

```php
<?php

use Nexus\CsConfig\Factory;
use MyCompany\CodingStandards\Ruleset\MyCompany;

return Factory::create(new MyCompany())->forProjects();

```

## Credits

This project is inspired by and an enhancement of [`ergebnis/php-cs-fixer-config`](https://github.com/ergebnis/php-cs-fixer-config).

## Contributing

Contributions are very much welcome. If you see an improvement or bugfix, open a [PR](https://github.com/NexusPHP/cs-config/pulls) now!
