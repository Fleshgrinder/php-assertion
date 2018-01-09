# Change Log
All notable changes to this project will be documented in this file.
This project adheres to [Semantic Versioning](http://semver.org/).

## [Unreleased]

## [2.0.0] - 2018-01-09
### Added
- [`symfony/polyfill-php71`](https://github.com/symfony/polyfill-php71) to
  import the [`is_iterable`](https://php.net/is-iterable) function.
- `Variable::hasIterablesOnly` which uses `is_iterable` in favor of the now
  deprecated `Variable::hasTraversablesOnly`.
### Changed
- Deprecated `Variable::hasTraversablesOnly` as well as
  `Variable::isTraversable` in favor of `Variable::hasIterablesOnly` and
  `is_iterable` respectively.
- Moved `Variable` class to `Fleshgrinder\Assertions` namespace, backwards
  compatibility is provided by a new `Variable` class which extends the old
  one.
### Removed
- [GNU Multi Precision](https://php.net/gmp) dependency to validate big
  integers. A regular expression is used instead now which works similar to
  PHP’s integer parsing algorithm.
- HHVM and PHP 5 support.

## [1.1.0] - 2016-03-17
### Added
- New method `hasAllSet` to assert `isset` on all members of a traversable.

## [1.0.0] - 2016-01-10
### Added
- Initial Release

[Unreleased]: https://github.com/fleshgrinder/php-assertion/compare/2.0.0...HEAD
[2.0.0]: https://github.com/fleshgrinder/php-assertion/compare/v1.1.0...2.0.0
[1.1.0]: https://github.com/fleshgrinder/php-assertion/compare/v1.0.0...1.1.0
[1.0.0]: https://github.com/fleshgrinder/php-assertion/compare/v1.0.0...1.1.0
