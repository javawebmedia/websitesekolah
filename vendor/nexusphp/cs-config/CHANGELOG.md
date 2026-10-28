# Changelog

All notable changes to this library will be documented in this file:

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/)
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [v3.29.0](https://github.com/NexusPHP/cs-config/compare/v3.28.5...v3.29.0) - 2026-08-22

- Bump shivammathur/setup-php from 2.37.0 to 2.37.1 (#14)
- Report abandoned packages
- Fix error on phpstan v2.2
- Bump actions/checkout from 6.0.2 to 6.0.3 (#15)
- Bump shivammathur/setup-php from 2.37.1 to 2.37.2 (#16)
- Bump actions/checkout from 6.0.3 to 7.0.0 (#18)
- Bump actions/cache from 5.0.5 to 6.0.0 (#17)
- Bump actions/cache from 6.0.0 to 6.1.0 (#19)
- Bump actions/checkout from 7.0.0 to 7.0.1 (#20)
- Fix impure `FixerProvider::builtin()`
- Fix stale README badge
- Bump coverallsapp/github-action from 2.3.6 to 2.3.8 (#21)
- Prune phpstan baseline via global ignores
- Make min promoted parameters to 2
- Do not unalias `property-read` and `property-write` tags
- Disable `static_private_method` fixer

## [v3.28.5](https://github.com/NexusPHP/cs-config/compare/v3.28.4...v3.28.5) - 2026-05-16

- Fix listing of `phpdoc_separation` based on feedback

## [v3.28.4](https://github.com/NexusPHP/cs-config/compare/v3.28.3...v3.28.4) - 2026-05-15

- Update listing in `phpdoc_separation`

## [v3.28.3](https://github.com/NexusPHP/cs-config/compare/v3.28.2...v3.28.3) - 2026-04-17

- Bump actions/cache from 5.0.4 to 5.0.5 (#13)
- Make minimum number of promoted properties to 3 before multilining
- Change option for `native_constant_invocation`
- Disable `final_public_method_for_abstract_class`

## [v3.28.2](https://github.com/NexusPHP/cs-config/compare/v3.28.1...v3.28.2) - 2026-04-12

- Enforce security hardening for workflows
- Bump shivammathur/setup-php from 2.36.0 to 2.37.0 (#12)
- Bump actions/cache from 5.0.3 to 5.0.4 (#11)
- Bump to php-cs-fixer v3.95
- Fix deprecated fixer and option
- Add `no_whitespace_in_empty_array` fixer
- Add new options to fixers
- Fix .gitattributes
- Allow phpunit:^13.0
- Fix workflows
- Add `/generate-changelog` skill

## [v3.28.1](https://github.com/NexusPHP/cs-config/compare/v3.28.0...v3.28.1) - 2026-02-22

- Use `null` value for `other` option of `phpdoc_line_span`
- Refactor to use `createStub()` instead of `createMock()`
- Enable option of `single_quote`

## [v3.28.0](https://github.com/NexusPHP/cs-config/compare/v3.27.0...v3.28.0) - 2026-02-17

- Bump actions/checkout from 5 to 6 (#9)
- Bump actions/cache from 4 to 5 (#10)
- Add new fixers of php-cs-fixer v3.93
- Bump to php-cs-fixer v3.94
- Add more options to `phpdoc_line_span`
- Enable `fix_lambda` option in `void_return`
- Bump to PHP 8.2
- Bump tachycardia to v2.4

## [v3.27.0](https://github.com/NexusPHP/cs-config/compare/v3.26.4...v3.27.0) - 2025-12-12

- Add `preserve_existing_declaration` option to `declare_strict_types`
- update to php-cs-fixer v3.92
- Add support for rule customisation policies

## [v3.26.4](https://github.com/NexusPHP/cs-config/compare/v3.26.3...v3.26.4) - 2025-09-27

- Add but disable `phpdoc_tag_no_named_arguments`
- Fix sprintf issues
- Add `modifier_keywords` fixer
- Add `@const` to `phpdoc_no_alias_tag`

## [v3.26.3](https://github.com/NexusPHP/cs-config/compare/v3.26.2...v3.26.3) - 2025-08-25

- Fix code style
- Remove phpstan-ignore
- Bump actions/checkout from 4 to 5 (#8)
- Disable `phpdoc_annotation_without_dot`

## [v3.26.2](https://github.com/NexusPHP/cs-config/compare/v3.26.1...v3.26.2) - 2025-07-15

- Bump to php-cs-fixer v3.84

## [v3.26.1](https://github.com/NexusPHP/cs-config/compare/v3.26.0...v3.26.1) - 2025-07-08

- Test using php-cs-fixer's highest PHP version supported

## [v3.26.0](https://github.com/NexusPHP/cs-config/compare/v3.25.2...v3.26.0) - 2025-07-04

- Update build badge
- Bump to php-cs-fixer v3.76
- Add `multiline_promoted_properties`  fixer
- Deprecate own fixers
- Fix phpstan errors
- Add `static_private_method` fixer
- Add `new_expression_parentheses` fixer
- Do not array unpack known arrays
- Potential fix for code scanning alert no. 1: Workflow does not contain permissions (#6)
- Potential fix for code scanning alert no. 2: Workflow does not contain permissions (#7)
- Support allowUnsupportedPhpVersion option in fixer
- Cleanup code

## [v3.25.2](https://github.com/NexusPHP/cs-config/compare/v3.25.1...v3.25.2) - 2025-02-23

- Add `php_unit_data_provider_method_order` fixer

## [v3.25.1](https://github.com/NexusPHP/cs-config/compare/v3.25.0...v3.25.1) - 2025-01-17

- Enable `modernize_stripos` option to `modernize_strpos` fixer

## [v3.25.0](https://github.com/NexusPHP/cs-config/compare/v3.24.3...v3.25.0) - 2025-01-10

- Bump to php-cs-fixer v3.67
- Add `types_map` option to `phpdoc_to_*` fixers
- Add `general_attribute_remove` fixer
- Bump to phpstan v2.1
- Remove `phpExecutable` as `setPhpExecutable()` is now deprecated in upstream
- Add PHP 8.4 to build
- Add `@phpstan-ignore` to ignored tags in `comment_to_phpdoc`
- Remove Nexus80 ruleset as PHP 8.0 is no longer supported
- Add `Nexus83` and `Nexus84` rulesets
- Make `Nexus82` depend on `Nexus81`'s rules
- Use explicit `ubuntu-24.04` in actions
- Add composer scripts
- Fix errors in phpstan-baseline

## [v3.24.3](https://github.com/NexusPHP/cs-config/compare/v3.24.2...v3.24.3) - 2024-09-07

- Add new PHPStan errors to baseline
- Update `phpdoc_separation` groups

## [v3.24.2](https://github.com/NexusPHP/cs-config/compare/v3.24.1...v3.24.2) - 2024-09-03

- Allow multiline in class definition

## [v3.24.1](https://github.com/NexusPHP/cs-config/compare/v3.24.0...v3.24.1) - 2024-08-25

- Add `php_unit_assert_new_names` fixer
- Group `template` and `template-covariant` PHPDocs

## [v3.24.0](https://github.com/NexusPHP/cs-config/compare/v3.23.1...v3.24.0) - 2024-07-28

- Fix phpstan error
- Remove defunct branch alias
- Add more files to .gitattributes
- Apply changes from php-cs-fixer v3.60
- Implement `FixerGenerator::mergeWith()`

## [v3.23.1](https://github.com/NexusPHP/cs-config/compare/v3.23.0...v3.23.1) - 2024-06-16

- Refactor AbstractCustomFixerTestCase

## [v3.23.0](https://github.com/NexusPHP/cs-config/compare/v3.22.1...v3.23.0) - 2024-05-18

- Fix for phpstan
- Bump to php-cs-fixer v3.54
- Enable `php_unit_attributes`
- Enable `ordered_attributes`
- feat: enable parallel fixing (#5)
- Enable `import_symbols` option on `fully_qualified_strict_types`

## [v3.22.1](https://github.com/NexusPHP/cs-config/compare/v3.22.0...v3.22.1) - 2024-03-24

- Allow phpunit v11
- Remove deprecated option of `nullable_type_declaration_for_default_null_value`

## [v3.22.0](https://github.com/NexusPHP/cs-config/compare/v3.21.0...v3.22.0) - 2024-02-24

- Bump to php-cs-fixer v3.50
- Update options for `no_superfluous_phpdoc_tags`
- Enable `phpdoc_array_type`

## [v3.21.0](https://github.com/NexusPHP/cs-config/compare/v3.20.0...v3.21.0) - 2024-02-05

- Bump to php-cs-fixer v3.49
- Add `string_implicit_slashes` fixer
- Enable `phpdoc_list_type` fixer

## [v3.20.0](https://github.com/NexusPHP/cs-config/compare/v3.19.0...v3.20.0) - 2024-01-23

- Bump to php-cs-fixer v3.46
- Enable `union_types` option for phpdoc_to fixers
- Disable `numeric_literal_separator`
- Enable `multiline_string_to_heredoc`
- Disable `heredoc_closing_marker`
- Enable `spacing` option and add more `tags` to `phpdoc_align`
- Bump actions/cache from 3 to 4 (#4)

## [v3.19.0](https://github.com/NexusPHP/cs-config/compare/v3.18.0...v3.19.0) - 2023-12-29

- Bump minimum PHP version to PHP 8.1
- Bump to php-cs-fixer v3.43
- Run build on PHP 8.3
- Bump to phpunit v10.5
- Fix sample ruleset in README

## [v3.18.0](https://github.com/NexusPHP/cs-config/compare/v3.17.0...v3.18.0) - 2023-10-13

- Bump to php-cs-fixer v3.35

## [v3.17.0](https://github.com/NexusPHP/cs-config/compare/v3.16.0...v3.17.0) - 2023-10-01

- Bump to php-cs-fixer v3.34
- Bump to php-cs-fixer v3.30
- Remove Nexus74 ruleset
- Fix tag name in release
- Update release.yml

## [v3.16.0](https://github.com/NexusPHP/cs-config/compare/v3.15.0...v3.16.0) - 2023-09-18

- Add `long_to_shorthand_operator`
- Bump actions/checkout from 3 to 4 (#3)

## [v3.15.0](https://github.com/NexusPHP/cs-config/compare/v3.14.4...v3.15.0) - 2023-08-30

- Enable `ordered_interfaces`
- Add `case_sensitive` options to order fixers

## [v3.14.4](https://github.com/NexusPHP/cs-config/compare/v3.14.3...v3.14.4) - 2023-08-16

- Update phpstan
- Add more groups to phpdoc_separation

## [v3.14.3](https://github.com/NexusPHP/cs-config/compare/v3.14.2...v3.14.3) - 2023-08-15

- Add `return_to_yield_from` fixer
- Add `spaces_inside_parentheses` fixer
- Bump dependencies

## [v3.14.2](https://github.com/NexusPHP/cs-config/compare/v3.14.1...v3.14.2) - 2023-08-05

- Add case to elements monitored by `class_attributes_separation`

## [v3.14.1](https://github.com/NexusPHP/cs-config/compare/v3.14.0...v3.14.1) - 2023-07-21

- Add more checked tokens in `no_extra_blank_lines`
- Use default for `ordered_class_elements`

## [v3.14.0](https://github.com/NexusPHP/cs-config/compare/v3.13.0...v3.14.0) - 2023-07-17

- Configure `yield_from_array_to_yields`
- Configure `php_unit_data_provider_return_type`
- Use native preg_match
- Bump php-cs-fixer to v3.22

## [v3.13.0](https://github.com/NexusPHP/cs-config/compare/v3.12.0...v3.13.0) - 2023-07-15

- Run linter
- Raise phpstan level to 9
- Remove parallel in phpstan.neon.dist
- Require static data providers for all PHP versions
- Bump to php-cs-fixer v3.20
- Configure `nullable_type_declaration` fixer
- Configure `type_declaration_spaces` fixer
- Configure `php_unit_data_provider_name` fixer

## [v3.12.0](https://github.com/NexusPHP/cs-config/compare/v3.11.0...v3.12.0) - 2023-06-19

- Remove `@` in exclude/include options
- Rename options for `final_internal_class`
- Add "as" in space before construct
- Add 'case_sensitive' option to `ordered_class_elements`
- Configure `blank_lines_before_namespace`
- Bump php-cs-fixer to v3.18

## [v3.11.0](https://github.com/NexusPHP/cs-config/compare/v3.10.0...v3.11.0) - 2023-05-23

- Do not `()` in anonymous class
- Remove space after short closure `fn` to match PER 2.0
- Configure `single_line_empty_body` fixer
- Configure `phpdoc_param_order` fixer
- Configure `ordered_types` fixer
- Bump to php-cs-fixer v3.17

## [v3.10.0](https://github.com/NexusPHP/cs-config/compare/v3.9.0...v3.10.0) - 2023-05-05

- Add Nexus82 ruleset
- Fix required PHP version of Nexus81 ruleset
- Remove guards to PHP 8.2 build
- Bump to php-cs-fixer v3.16

## [v3.9.0](https://github.com/NexusPHP/cs-config/compare/v3.8.0...v3.9.0) - 2023-03-05

- Configure `skip_unlisted_annotations` option on `phpdoc_separation` rule
- Configure `php_unit_data_provider_static` rule
- Bump php-cs-fixer to v3.14
- Remove workaround for phpstan
- Set YAML indentation to 2 spaces
- Test PHP 8.2
- Add additional flags to coveralls call
- Run PHPStan without Xdebug
- Combine Composer steps in build workflow
- Remove PHP 7.4 from build workflow
- Use constructor property promotion when possible
- Drop support for PHP 7.4
- Update build.yml
- Bump to phpstan v1.9.0
- Fix FactoryTest
- Use null coalesce

## [v3.8.0](https://github.com/NexusPHP/cs-config/compare/v3.7.0...v3.8.0) - 2022-11-01

- Bump php-cs-fixer to v3.13
- Add 'case_sensitive' option to 'general_phpdoc_annotation_remove'
- Add 'closure_fn_spacing' option to 'function_declaration'

## [v3.7.0](https://github.com/NexusPHP/cs-config/compare/v3.6.0...v3.7.0) - 2022-10-15

- Use dependabot for updates
- Bump php-cs-fixer version to v3.12
- Use phpstan baseline
- Update action workflows

## [v3.6.0](https://github.com/NexusPHP/cs-config/compare/v3.5.0...v3.6.0) - 2022-09-02

- Add new option to `phpdoc_separation`
- Remove deprecated rules
- Configure `no_trailing_comma_in_singleline`
- Bump php-cs-fixer to ^3.11
- Configure `whitespace_after_comma_in_array`
- Use available option of `phpdoc_order`
- Configure `no_multiple_statements_per_line` rule
- Bump php-cs-fixer to v3.10
- Fix PHPStan error

## [v3.5.0](https://github.com/NexusPHP/cs-config/compare/v3.4.0...v3.5.0) - 2022-07-11

- Change 'concat_space' to none
- Configure new rules in v3.9.1
- \[BC BREAK\] Drop Nexus73 ruleset
- Suppress missing iterable value type hints
- Remove use of deprecated rule
- Deprecate `Nexus/space_after_comment_start`
- Configure new rules in v3.8

## [v3.4.0](https://github.com/NexusPHP/cs-config/compare/v3.3.4...v3.4.0) - 2022-02-09

- Fix code style lint
- Add Nexus81 ruleset
- Deprecate Nexus73 ruleset
- Bump php-cs-fixer version to v3.6
- Bump php version to 7.4
- Prune build workflow
- Revert phpstan level to 8

## [v3.3.4](https://github.com/NexusPHP/cs-config/compare/v3.3.3...v3.3.4) - 2021-11-02

- Update to phpstan 1.0
- Add ignored tags to `phpdoc_to_comment` rule

## [v3.3.3](https://github.com/NexusPHP/cs-config/compare/v3.3.2...v3.3.3) - 2021-10-06

- Enable `no_alternative_syntax` rule
- Change class attributes separation to `none` except for methods
- Remove operator override for braces in Nexus80
- Add support for new fixers added in v3.2.0
- Remove deprecated "tokens: use_trait" option
- Use own custom fixers
- Fix phpstan error on v0.12.99

## [v3.3.2](https://github.com/NexusPHP/cs-config/compare/v3.3.1...v3.3.2) - 2021-09-08

- Fix missing string substitution when `FixerGenerator::create()` fails

## [v3.3.1](https://github.com/NexusPHP/cs-config/compare/v3.3.0...v3.3.1) - 2021-08-31

- Fix case where comment is exactly `//`

## [v3.3.0](https://github.com/NexusPHP/cs-config/compare/v3.2.2...v3.3.0) - 2021-08-31

- Fix grammar usages
- Enable all `class_definition` rules
- Remove references to `liaison/cs-config`
- Add NoCodeSeparatorCommentFixer
- Add SpaceAfterCommentStartFixer
- Add support for custom fixers
- Remove `@internal` annotation from classes in public API
- Bump to php-cs-fixer v3.1
- Add FixerGenerator
- Use phpstan's bleeding edge

## [v3.2.2](https://github.com/NexusPHP/cs-config/compare/v3.2.1...v3.2.2) - 2021-08-07

- Add support for `trait_import` in `class_attributes_separation`
- Do not test on PHP 8.1 yet

## [v3.2.1](https://github.com/NexusPHP/cs-config/compare/v3.2.0...v3.2.1) - 2021-07-07

- Forbid running PHPStan on PHP8.1 (for now)
- Standardize `phpunit.xml.dist` structure.
- Remove `include/require` from statements requiring blank line before.
- Fix for `AbstractRulesetTestCase` when configurable fixer is not yet defined by the ruleset.
- \[Nexus80\] Enable `void_return` fixer
- Limit excluded annotations to `@final` and `@no-final` only
- \[Nexus80\] Enable `final_public_method_for_abstract_class`
- \[Nexus80\] Enable `phpdoc_to_param_type` and `phpdoc_to_return_type`
- Remove `@test` annotations from tests
- Disable `php_unit_test_class_requires_covers`. Let PHPUnit do the job instead.

## [v3.2.0](https://github.com/NexusPHP/cs-config/compare/v3.1.1...v3.2.0) - 2021-06-19

- Enable PHP 8.1 build workflow
- Forbid importing global functions and constants in addition to global classes
- \[Possible BC break\] Refactored stricter `AbstractRulesetTestCase`
- Removed superfluous PHPDoc tags if present in method signature
- Changed default rule for `binary_operator_spaces` to `single_space` for all rulesets
- Changed parent namespace to "Nexus"
- Dropped `phpstan/phpstan-strict-rules`

## [v3.1.1](https://github.com/NexusPHP/cs-config/compare/v3.1.0...v3.1.1) - 2021-06-01

- Changed `native_constant_invocation` to fix only a subset of built in constants

## [v3.1.0](https://github.com/NexusPHP/cs-config/compare/v3.0.3...v3.1.0) - 2021-06-01

- Changed `native_constant_invocation` to fix all built in constants
- Completed options for `native_function_invocation`
- Changed `phpdoc_line_span` and `phpdoc_tag_type` rules
- Allow `@author` tags in `general_phpdoc_annotation_remove` rule
- Await `one_if_phpdoc` option for `class_attributes_separation`

## [v3.0.3](https://github.com/NexusPHP/cs-config/compare/v3.0.2...v3.0.3) - 2021-05-07

- Add test for checking missing built-in rules in ruleset
- Optimize tests' execution times

## [v3.0.2](https://github.com/NexusPHP/cs-config/compare/v3.0.1...v3.0.2) - 2021-05-07

- Allow overriding of `AbstractRulesetTestCase::createRuleset()`

## [v3.0.1](https://github.com/NexusPHP/cs-config/compare/v3.0.0...v3.0.1) - 2021-05-07

- Update branch alias to `3.x-dev`
- Fixed default cache file in `Factory`
- Update references of old configuration in README
- Fix `Nexus74` ruleset to enable `phpdoc_to_property_type`
- Change attribute separation of `const` to `none` in `Nexus80` ruleset
- Use descriptive names for rulesets

## [v3.0.0](https://github.com/NexusPHP/cs-config/compare/v2.2.1...v3.0.0) - 2021-05-06

- Update `friendsofphp/php-cs-fixer` to v3.0.0 Constitution
- New ruleset: `Nexus80`, targeting PHP 8.0+
- Add `Tachycardia` for profiling of slow tests
- Build action is also run on schedule

## [v2.2.1](https://github.com/NexusPHP/cs-config/compare/v2.2.0...v2.2.1) - 2021-05-06

- Fixed faulty build action on running `php-cs-fixer`
- Use range diffs in CHANGELOG

## [v2.2.0](https://github.com/NexusPHP/cs-config/compare/v2.1.5...v2.2.0) - 2021-05-06

- Update `friendsofphp/php-cs-fixer` to v2.19 Testament
- Use `new FixerFactory()` instead of `FixerFactory::create()`
- Add `phpdoc_to_property_type` and `trailing_comma_in_multiline` rules
- Removed deprecated fixers from the rulesets
- Removed deprecated fixer options from the rulesets
- Renamed configuration file to `.php-cs-fixer.dist.php`

## [v2.1.5](https://github.com/NexusPHP/cs-config/compare/v2.1.4...v2.1.5) - 2021-02-20

### Fixed

- Removed the faulty `replace` section in composer.json causing halted installations
- Fixed errors reported by PHPStan on level 8

## [v2.1.4](https://github.com/NexusPHP/cs-config/compare/v2.1.3...v2.1.4) - 2021-01-18

### Added

- Added support for PHP 8
- Bump `friendsofphp/php-cs-fixer` to v2.18.0 Remote Void

## [v2.1.3](https://github.com/NexusPHP/cs-config/compare/v2.1.2...v2.1.3) - 2021-01-07

### Fixed

- Fixed a PHPStan error on the incorrect covariant return type of `Factory::invoke`.

## [v2.1.2](https://github.com/NexusPHP/cs-config/compare/v2.1.1...v2.1.2) - 2021-01-07

### Fixed

- Fixed name of `Nexus74` ruleset which was erroneously set as `Nexus73`.
- Fixed license format in `README`.

## [v2.1.1](https://github.com/NexusPHP/cs-config/compare/v2.1.0...v2.1.1) - 2020-12-12

### Changed

- `increment_style` fixer now uses the `['style' => 'pre']`. Previously, this was `post`.

## [v2.1.0](https://github.com/NexusPHP/cs-config/compare/v2.0.2...v2.0.2) - 2020-12-08

### Added

- Added support for new fixers in [v2.17.0 Desert Beast](https://github.com/FriendsOfPHP/PHP-CS-Fixer/releases/tag/v2.17.0).
- Added `Nexus74` ruleset for support on `use_arrow_functions` fixer.
- Added testing for deprecated fixers.

### Changed

- `phpdoc_line_span` has been set to single for all classy elements.
- `binary_operator_spaces` has been set to its default `single_space` for use in this library.

## [v2.0.2](https://github.com/NexusPHP/cs-config/compare/v2.0.1...v2.0.2) - 2020-12-01

### Fixed

- Re-release of previous release due to inconsistency in tagging process.

## [v2.0.1](https://github.com/NexusPHP/cs-config/compare/v2.0.0...v2.0.1) - 2020-12-01

### Changed

- `global_namespace_import` has its option `import_classes` set to `false`.
- Renamed `phpunit.xml.dist`'s `cacheResultFile` attribute

## [v2.0.0](https://github.com/NexusPHP/cs-config/releases/tag/v2.0.0) - 2020-11-28

### Changed

- Initial release in this repository. See [MIGRATION](MIGRATION.md) for the detailed changes
from its predecessor library.
