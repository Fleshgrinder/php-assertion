[![Latest Stable Version](https://poser.pugx.org/fleshgrinder/assertion/v/stable?format=flat-square)](https://packagist.org/packages/fleshgrinder/assertion)
[![Latest Unstable Version](https://poser.pugx.org/fleshgrinder/assertion/v/unstable?format=flat-square)](https://packagist.org/packages/fleshgrinder/assertion)
[![Travis](https://img.shields.io/travis/Fleshgrinder/php-assertion.svg?style=flat-square)](https://travis-ci.org/Fleshgrinder/php-assertion)
[![HHVM](https://img.shields.io/hhvm/fleshgrinder/assertion.svg?style=flat-square)](http://hhvm.h4cc.de/package/fleshgrinder/assertion)
[![License](https://poser.pugx.org/fleshgrinder/assertion/license?format=flat-square)](https://packagist.org/packages/fleshgrinder/assertion)
[![Total Downloads](https://poser.pugx.org/fleshgrinder/assertion/downloads?format=flat-square)](https://packagist.org/packages/fleshgrinder/assertion)

[![Coveralls branch](https://img.shields.io/coveralls/Fleshgrinder/php-assertion/master.svg?style=flat-square)](https://coveralls.io/github/Fleshgrinder/php-assertion)
[![Scrutinizer](https://img.shields.io/scrutinizer/g/Fleshgrinder/php-assertion.svg?style=flat-square)](https://scrutinizer-ci.com/g/Fleshgrinder/php-assertion/)
[![SensioLabs Insight](https://img.shields.io/sensiolabs/i/61540e8e-2ca9-4102-bd43-3b9c5a0a38e2.svg?style=flat-square)](https://insight.sensiolabs.com/projects/61540e8e-2ca9-4102-bd43-3b9c5a0a38e2)
[![Code Climate](https://img.shields.io/codeclimate/github/Fleshgrinder/php-assertion.svg?style=flat-square)](https://codeclimate.com/github/Fleshgrinder/php-assertion)
[![Code Climate](https://img.shields.io/codeclimate/issues/github/Fleshgrinder/php-assertion.svg?style=flat-square)](https://codeclimate.com/github/Fleshgrinder/php-assertion)
# PHP Assertions
Library to ease defensive and design by contract (DbC) programming with [`assert()`](https://secure.php.net/assert) in PHP.

## Installation
Open a terminal, enter your project directory and execute the following command to add this package to your
 dependencies:

```bash
$ composer require fleshgrinder/assertion
```

This command requires you to have Composer installed globally, as explained in the
 [installation chapter](https://getcomposer.org/doc/00-intro.md) of the Composer documentation.

**NOTE:** Do not install the library as a development requirement because composer does not install them when a library
 is installed as a dependency of another library. You want your assertions to be executed at all times, except when the
 full application goes into production; which is managed through the [configuration](#configuration).

### Big Integers
The PHP extension [GNU Multiple Precision](https://secure.php.net/gmp) is required to validate big integer numbers.
 It is not required but a `E_USER_NOTICE` error is triggered if a big integer is encountered and the extension is not
 available. The installation on [Debian](https://www.debian.org/) based systems is usually as easy as executing
 `apt-get install php5-gmp` if PHP was installed from the official packages. The required _dll_ is already present on
 Windows systems and only needs to be loaded in the global PHP configuration. Refer to the
 [installation page of the extension](https://secure.php.net/gmp.installation) if you compile PHP yourself.

### Big Floats
The PHP extension [BC Math](https://secure.php.net/bcmath) is required to validate big float numbers. It is not required
 but a `E_USER_NOTICE` error is triggered if a big float is encountered and the extension is not available. PHP must be
 compiled with the `--enable-bcmath` flag and the extension is always loaded on Windows systems.

## Usage
This library provides a single purely static class that can be used in assertions to ease repetitive scalar inspections
 as well as writing custom inspections on top of it. The following code example illustrates the basic usage:

```php
// Use built-in functions whenever possible.
assert(is_string($var), 'variable must be of type string.');
assert(Variable::isStringWithContent($var), 'variable must be of type string with content');
assert(Variable::isStringable($var), 'variable must be of type string or a convertible object');
assert(Variable::isStringableWithContent($var), 'variable must be of type string or a convertible object with content');

// Again, use built-in functions whenever possible.
assert($var === null || Variable::isInteger($var), 'variable must be NULL or an integer (ℤ)');
assert($var === null || Variable::isNaturalNumber($var), 'variable must be NULL or a natural number (ℕ₀)');
assert($var === null || Variable::isScalarPositiveNaturalNumber($var), 'variable must be NULL or a positive natural number (ℕ₁) of type int');
```

### Defensive Programming / Design by Contract
> “**Be polite, Never Assert**
>
> Avoid the `assert()` mechanism, because it could turn a three-day debug fest into a ten minute one.”
>
> — [How to Write Unmaintainable Code](https://thc.org/root/phun/unmaintain.html), Roedy Green.

Be sure to check the [Weblinks](#Weblinks) section and read through all the sources to find out what assertions are good
 for, when to use them, and when not. Feel free to open an issue if you are still in doubt.

### Configuration
Assertions need to be configured appropriately in order to be useful during [Development](#Development) as well as in
 [Production](#Production).

#### Development
```ini
[Assertion]
assert.active     = 1
assert.bail       = 1
assert.callback   = 0
assert.quiet_eval = 1
assert.warning    = 0
; PHP 7
;assert.exception  = 1
;zend.assertions   = 1

```

#### Production
```ini
[Assertion]
assert.active     = 0
assert.bail       = 0
assert.callback   = 0
assert.quiet_eval = 0
assert.warning    = 0
; PHP 7
;assert.exception  = 0
;zend.assertions   = -1
```

### Note
Default functions that are already provided by PHP are not redefined in this library. Use the language functions
 whenever possible, e.g.: `is_string`, `is_int`, `is_float`, `is_numeric`, …

However, many of the filter functions are exposed via methods that do not require additional arguments, for instance
 the integer and float assertions pass their arguments to the filter function with the appropriate filter and options
 set. Be careful and consider using `is_int` and `is_float` if you actually need the correct type but be even more
 careful if you need to handle very big numbers, in these cases use this library again since it will fall back to
 GMP and bcmath functions as needed while ensuring best performance by using the most appropriate library in the
 background.

### FAQ
> _Why is the class called Variable?_

In order to result in nice English sentences, just look at the following:

```php
assert(Variable::isPositiveNaturalNumber($id));
// Assert variable (id) is (a) positive natural number.
```

> _Why is it a class in the first place and not a collection of procedural functions?_

Because PHP (composer) does not support lazy loading of procedural functions and it makes no sense to include the file
in production. Using a class on the other hand makes lazy loading possible.

> _Why does the class not follow PSR-4 (and the associated vendor prefixing to avoid conflicts) while the tests do?_

To minimize noise within the _assert_ calls and possible extra work with IDEs (like PhpStorm) that automatically import
 classes with _use_ statements that do not work nicely together with _assert_. I consider the likelihood of another
 class being named after something generic as _variable_ to be very low and thus concluded that above arguments are
 reason enough to put it in the global namespace.

## Credits
Credit where credit is due: this library was inspired by [Drupal’s](https://www.drupal.org/) 
 [Inspector class](https://github.com/drupal/drupal/blob/8.0.x/core/lib/Drupal/Component/Assertion/Inspector.php).

## Weblinks
- The PHP Group: “[_`assert()`_](https://secure.php.net/assert)”
- Steve McConnell: “[_Code Complete: 2nd Edition_](http://www.stevemcconnell.com/cc.htm),”  2004, Microsoft Press, 960
 pages. ISBN: 0735619670. _Section 8.2 in particular but there is more general advice in regards to defensive
 programming and how to use `assert()` effectively._
- Aki Tendo, et al.: “[_Adding Assertions to Drupal - Test Tools._](https://www.drupal.org/node/2408013)”
- Jess (xjm), et al.: “[_[policy, no patch] Define best practices for using and testing assertions and document them before adding assertions to core_](https://www.drupal.org/node/2548671)”
- Aki Tendo: “[_Runtime Assertions have been added to Drupal core_](https://www.drupal.org/node/2569701),” September 29, 2015.
- Drupal contributors: “[_Well Formed Errors Initiative_](https://www.drupal.org/node/2412507),” March 6, 2015.
- Stackoverflow contributors: “[_When should assertions stay in production code?_](http://stackoverflow.com/questions/17732)”
- Wikipedia contributors: “[_Assertion (software development)_](https://en.wikipedia.org/wiki/Assertion_%28software_development%29)”
- Wikipedia contributors: “[_Design by contract_](https://en.wikipedia.org/wiki/Design_by_contract)”
- Wikipedia contributors: “[_Exception handling_](https://en.wikipedia.org/wiki/Exception_handling)”

## License
[![MIT License](https://upload.wikimedia.org/wikipedia/commons/thumb/c/c3/License_icon-mit.svg/48px-License_icon-mit.svg.png)](https://opensource.org/licenses/MIT)
