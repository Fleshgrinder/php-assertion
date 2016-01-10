# PHP Assertions

## Installation
Note that this library requires the [GNU Multiple Precision](https://secure.php.net/book.gmp) PHP extension to be
 installed. GMP allows for very fast arbitrary precision integer calculations and is used to ensure that the platform
 does not result in false positives because of overflows.

The installation on [Debian](https://www.debian.org/) based systems is usually as easy as executing `apt-get install php5-gmp`
 if PHP was installed from the official packages. Refer to the [installation page of the extension](https://secure.php.net/gmp.installation)
 if you compile PHP yourself.

## Usage
This library provides a single purely static class that can be used in assertions to ease repetitive scalar inspections
 as well as writing custom inspections on top of it. The following code example illustrates the basic usage:

```php
// Use built-in functions whenever possible.
assert('is_string($var)', 'variable must be of type string.');
assert('Variable::isStringWithContent($var)', 'variable must be of type string with content');
assert('Variable::isStringable($var)', 'variable must be of type string or a convertible object');
assert('Variable::isStringableWithContent($var)', 'variable must be of type string or a convertible object with content');

// Again, use built-in functions whenever possible.
assert('is_null($var) || Variable::isInteger($var)', 'variable must be NULL or an integer (ℤ)');
assert('is_null($var) || Variable::isNaturalNumber($var)', 'variable must be NULL or a natural number (ℕ₀)');
assert('is_null($var) || Variable::isScalarPositiveNaturalNumber($var)', 'variable must be NULL or a positive natural number (ℕ₁) of type int');
```

Of course one could also use `$var === null` in the examples above.

## Design by Contract

## Configuration
Assertions need to be configured appropriately in order to be useful during [Development] as well as in [Production].

### Development
```ini
[Assertion]
assert.active     = 1
assert.bail       = 1
assert.callback   = 0
assert.quiet_eval = 1
assert.warning    = 1
```

### Production
```ini
[Assertion]
assert.active     = 0
assert.bail       = 0
assert.callback   = 0
assert.quiet_eval = 0
assert.warning    = 0
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

## FAQ
_Why does is the class called Variable?_

In order to result in nice English sentences, just look at the following:

```php
assert('Variable::isPositiveNaturalNumber($id)');
// Assert variable (id) is (a) positive natural number.
```

_Why is it a class in the first place and not simply procedural functions?_

Because PHP (composer) does not support lazy loading of procedural functions and it makes no sense to include the file
in production. Using a class makes this possible.

_Why does the class not follow PSR-4 (and the associated vendor prefixing to avoid conflicts) while the tests do?_

To minimize noise within the _assert_ calls and possible extra work with IDEs (like PhpStorm) that automatically import
 classes with _use_ statements that do not work nicely together with _assert_. I consider the likelihood of another
 class being named after something generic as _variable_ to be very low and thus concluded that above arguments are
 reason enough to put it in the global namespace.

## Weblinks
- Wikipedia contributors: “[_Assertion (software development)_](https://en.wikipedia.org/wiki/Assertion_%28software_development%29)”
- Wikipedia contributors: “[_Design by contract_](https://en.wikipedia.org/wiki/Design_by_contract)”
- Wikipedia contributors: “[_Exception handling_](https://en.wikipedia.org/wiki/Exception_handling)”

## License
[![MIT License](https://upload.wikimedia.org/wikipedia/commons/thumb/c/c3/License_icon-mit.svg/48px-License_icon-mit.svg.png)](https://opensource.org/licenses/MIT)
