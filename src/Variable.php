<?php
/**
 * @author Richard Fussenegger <fleshgrinder@users.noreply.github.com>
 * @copyright 2016–2017 Richard Fussenegger
 * @license MIT
 */

namespace Fleshgrinder\Assertions;

/**
 * The variable global static class can be used within {@see assert()} calls to examine variables. All methods return
 * `TRUE` if the given argument complies with the examination rules and `FALSE` if not. Refer to the package’s README
 * for usage examples and more info.
 */
abstract class Variable {

	const BC_MATH_DEFAULT_SCALE = 1000;

	/**
	 * Assert variable members all contain substring.
	 *
	 * @param mixed $var
	 * @param string $needle
	 * @param bool $case_sensitive
	 * @return bool
	 */
	final public static function allContain($var, $needle, $case_sensitive = false) {
		return static::applyCallback($var, function ($member) use ($needle, $case_sensitive) {
			return static::contains($member, $needle, $case_sensitive);
		});
	}

	/**
	 * Assert variable members all match PCRE pattern.
	 *
	 * @param mixed $var
	 * @param string $pattern
	 * @return bool
	 */
	final public static function allMatch($var, $pattern) {
		return static::applyCallback($var, function ($member) use ($pattern) {
			return static::matches($member, $pattern);
		});
	}

	/**
	 * Apply callback to all members of traversable variable.
	 *
	 * @param mixed $var
	 * @param callable $callback
	 *   will be called with the member (value in array terms) as the first argument and the delta (index or key in
	 *   array terms) as second argument. It need to return `FALSE` to abort the iteration and `FALSE` will be returned
	 *   to the caller as well then, otherwise `TRUE` will be returned.
	 * @param bool $pass_delta
	 *   Whether to pass the delta (index or key in array terms) to the callback or not. Some PHP functions emit an
	 *   error or warning if an erroneous second argument is passed.
	 * @return bool
	 */
	final public static function applyCallback($var, callable $callback, $pass_delta = true) {
		assert('is_bool($pass_delta)', 'Third argument must be of type bool.');

		if (is_iterable($var)) {
			/** @noinspection ForeachSourceInspection */
			foreach ($var as $delta => $member) {
				if (($pass_delta ? $callback($member, $delta) : $callback($member)) === false) {
					return false;
				}
			}
			return true;
		}
		return false;
	}

	/**
	 * Assert variable contains substring.
	 *
	 * @param mixed $var
	 * @param string $needle
	 * @param bool $case_sensitive
	 * @return bool
	 */
	final public static function contains($var, $needle, $case_sensitive = false) {
		assert('is_string($needle) && $needle !== \'\'', 'second argument must be of type string and have content');
		assert('is_bool($case_sensitive)', 'third argument must be of type bool');

		if (!is_bool($var) && (is_scalar($var) || method_exists($var, '__toString'))) {
			if ($case_sensitive) {
				return strpos($var, $needle) !== false;
			}
			return stripos($var, $needle) !== false;
		}
		return false;
	}

	/**
	 * Assert variable has all members set (not `NULL`).
	 *
	 * @param mixed $var
	 * @return bool
	 */
	final public static function hasAllSet($var) {
		return static::applyCallback($var, function ($member) {
			return $member !== \null;
		});
	}

	/**
	 * Assert variable contains arrays only.
	 *
	 * @see is_array()
	 * @param mixed $var
	 * @return bool
	 */
	final public static function hasArraysOnly($var) {
		return static::applyCallback($var, 'is_array', false);
	}

	/**
	 * Assert variable contains bools only.
	 *
	 * @see is_bool()
	 * @param mixed $var
	 * @return bool
	 */
	final public static function hasBoolsOnly($var) {
		return static::applyCallback($var, 'is_bool', false);
	}

	/**
	 * Assert variable contains callables only.
	 *
	 * @param mixed $var
	 * @return bool
	 */
	final public static function hasCallablesOnly($var) {
		return static::applyCallback($var, 'is_callable', false);
	}

	/**
	 * Assert variable contains floats only.
	 *
	 * @link https://secure.php.net/float
	 * @see is_float()
	 * @param mixed $var
	 * @return bool
	 */
	final public static function hasFloatsOnly($var) {
		return static::applyCallback($var, 'is_float', false);
	}

	/**
	 * Assert variable contains instances of class only.
	 *
	 * @see isInstanceOf()
	 * @param mixed $var
	 * @param string|object $class
	 * @param bool $allow_string
	 *   Whether to invoke the auto-loader if the variable is a string or not and fail if variable is not an object.
	 * @return bool
	 */
	final public static function hasInstancesOfOnly($var, $class, $allow_string = true) {
		if (is_object($class)) {
			$class = get_class($class);
		}

		return static::applyCallback($var, function ($member) use ($class, $allow_string) {
			return static::isInstanceOf($member, $class, $allow_string);
		});
	}

	/**
	 * Assert variable contains ints only.
	 *
	 * @link https://secure.php.net/integer
	 * @see is_int()
	 * @param mixed $var
	 * @return bool
	 */
	final public static function hasIntsOnly($var) {
		return static::applyCallback($var, 'is_int', false);
	}

	/**
	 * Assert variable contains integers (ℤ) only, asserts big numbers with {@see GMP}.
	 *
	 * @link https://secure.php.net/integer
	 * @see isInteger()
	 * @param mixed $var
	 * @return bool
	 */
	final public static function hasIntegersOnly($var) {
		return static::applyCallback($var, [__CLASS__, 'isInteger']);
	}

	/**
	 * Assert variable contains iterables only.
	 *
	 * @see is_iterable()
	 * @param mixed $var
	 * @return bool
	 */
	final public static function hasIterablesOnly($var) {
		return static::applyCallback($var, 'is_iterable', false);
	}

	/**
	 * Assert variable contains all keys.
	 *
	 * @see array_key_exists()
	 * @param mixed $var
	 * @param string[] ...$keys
	 * @return bool
	 */
	final public static function hasKeys($var, ...$keys) {
		if (is_iterable($var)) {
			foreach ($keys as $key) {
				if (!array_key_exists($key, $var)) {
					return false;
				}
			}
			return true;
		}
		return false;
	}

	/**
	 * Assert variable contains natural numbers (ℕ₀) only, asserts big numbers with {@see GMP}.
	 *
	 * @link https://secure.php.net/integer
	 * @see isNaturalNumber()
	 * @param mixed $var
	 * @return bool
	 */
	final public static function hasNaturalNumbersOnly($var) {
		return static::applyCallback($var, [__CLASS__, 'isNaturalNumber']);
	}

	/**
	 * Assert variable has not empty values. Use this method with care! PHP’s {@see empty} function might result in
	 * unintended positive assertions if not applied correctly. Check the [PHP manual](https://secure.php.net/empty)
	 * and the associated unit test for more information.
	 *
	 * @param mixed $var
	 * @return bool
	 */
	final public static function hasNoEmptyValues($var) {
		return static::applyCallback($var, function ($member) {
			return !empty($member);
		});
	}

	/**
	 * Assert variable contains numerics only.
	 *
	 * @see is_numeric()
	 * @param mixed $var
	 * @return bool
	 */
	final public static function hasNumericsOnly($var) {
		return static::applyCallback($var, 'is_numeric', false);
	}

	/**
	 * Assert variable contains objects only.
	 *
	 * @see is_object()
	 * @param mixed $var
	 * @return bool
	 */
	final public static function hasObjectsOnly($var) {
		return static::applyCallback($var, 'is_object', false);
	}

	/**
	 * Assert variable contains positive natural numbers (ℕ₁) only, asserts big numbers with {@see GMP}.
	 *
	 * @link https://secure.php.net/integer
	 * @see isPositiveNaturalNumber()
	 * @param mixed $var
	 * @return bool
	 */
	final public static function hasPositiveNaturalNumbersOnly($var) {
		return static::applyCallback($var, [__CLASS__, 'isPositiveNaturalNumber']);
	}

	/**
	 * Assert variable contains real numbers (ℝ) only, asserts big numbers with BC Math.
	 *
	 * @see https://secure.php.net/float
	 * @see isRealNumber()
	 * @param mixed $var
	 * @param int $scale
	 * @return bool
	 */
	final public static function hasRealNumbersOnly($var, $scale = self::BC_MATH_DEFAULT_SCALE) {
		return static::applyCallback($var, function ($member) use ($scale) {
			return static::isRealNumber($member, $scale);
		});
	}

	/**
	 * Assert variable contains resources only.
	 *
	 * @param mixed $var
	 * @return bool
	 */
	final public static function hasResourcesOnly($var) {
		return static::applyCallback($var, 'is_resource', false);
	}

	/**
	 * Assert variable contains scalars only.
	 *
	 * @see is_scalar()
	 * @param mixed $var
	 * @return bool
	 */
	final public static function hasScalarsOnly($var) {
		return static::applyCallback($var, 'is_scalar', false);
	}

	/**
	 * Assert variable contains natural numbers (ℕ₀) of type int only.
	 *
	 * @link https://secure.php.net/integer
	 * @see isScalarNaturalNumber()
	 * @param mixed $var
	 * @return bool
	 */
	final public static function hasScalarNaturalNumbersOnly($var) {
		return static::applyCallback($var, [__CLASS__, 'isScalarNaturalNumber']);
	}

	/**
	 * Assert variable contains positive natural numbers (ℕ₁) of type int only.
	 *
	 * @link https://secure.php.net/integer
	 * @see isScalarPositiveNaturalNumber()
	 * @param mixed $var
	 * @return bool
	 */
	final public static function hasScalarPositiveNaturalNumbersOnly($var) {
		return static::applyCallback($var, [__CLASS__, 'isScalarPositiveNaturalNumber']);
	}

	/**
	 * Assert variable contains stream resources only.
	 *
	 * @param mixed $var
	 * @return bool
	 */
	final public static function hasStreamResourcesOnly($var) {
		return static::applyCallback($var, [__CLASS__, 'isStreamResource']);
	}

	/**
	 * Assert variable contains strict arrays only.
	 *
	 * @see isStrictArray()
	 * @param mixed $var
	 * @return bool
	 */
	final public static function hasStrictArraysOnly($var) {
		return static::applyCallback($var, [__CLASS__, 'isStrictArray']);
	}

	/**
	 * Assert variable contains strings only.
	 *
	 * @see is_string()
	 * @param mixed $var
	 * @return bool
	 */
	final public static function hasStringsOnly($var) {
		return static::applyCallback($var, 'is_string', false);
	}

	/**
	 * Assert variable contains strings with content only.
	 *
	 * @see isStringWithContent()
	 * @param mixed $var
	 * @return bool
	 */
	final public static function hasStringsWithContentOnly($var) {
		return static::applyCallback($var, [__CLASS__, 'isStringWithContent']);
	}

	/**
	 * Assert variable contains stringables (string or convertible object) only.
	 *
	 * @see isStringable()
	 * @param mixed $var
	 * @return bool
	 */
	final public static function hasStringablesOnly($var) {
		return static::applyCallback($var, [__CLASS__, 'isStringable']);
	}

	/**
	 * Assert variable contains stringables (string or convertible object) with content only.
	 *
	 * @see isStringableWithContent()
	 * @param mixed $var
	 * @return bool
	 */
	final public static function hasStringablesWithContentOnly($var) {
		return static::applyCallback($var, [__CLASS__, 'isStringableWithContent']);
	}

	/**
	 * Assert variable contains subclasses of class only.
	 *
	 * @see isSubclassOf()
	 * @param mixed $var
	 * @param object|string $class
	 * @param bool $allow_string
	 *   Whether to invoke the auto-loader if the variable is a string or not and fail if variable is not an object.
	 * @return bool
	 */
	final public static function hasSubclassesOfOnly($var, $class, $allow_string = true) {
		if (is_object($class)) {
			$class = get_class($class);
		}

		return static::applyCallback($var, function ($member) use ($class, $allow_string) {
			return static::isSubclassOf($member, $class, $allow_string);
		});
	}

	/**
	 * Assert variable contains traversables only.
	 *
	 * @deprecated Use {@see hasIterablesOnly} instead.
	 * @see isTraversable()
	 * @param mixed $var
	 * @return bool
	 */
	final public static function hasTraversablesOnly($var) {
		@trigger_error('Use Variable::hasIterablesOnly() instead.', E_USER_DEPRECATED);

		return static::applyCallback($var, [__CLASS__, 'isTraversable']);
	}

	/**
	 * Assert variable is an instance of the given class.
	 *
	 * @param mixed $var
	 * @param object|string $class
	 * @param bool $allow_string
	 *   Whether to invoke the auto-loader if the variable is a string or not and fail if variable is not an object.
	 * @return bool
	 */
	final public static function isInstanceOf($var, $class, $allow_string = true) {
		assert('is_object($class) || is_string($class)', 'second argument must be of type object or string');
		assert('is_bool($allow_string)', 'third argument must be of type bool');

		if (is_object($class)) {
			$class = get_class($class);
		}

		return is_a($var, $class, $allow_string);
	}

	/**
	 * Assert variable is an integer (ℤ), asserts big numbers with {@see GMP} if available. This method triggers
	 * an error of severity `E_USER_NOTICE` if GMP is not installed.
	 *
	 * @lnk https://secure.php.net/integer
	 * @param mixed $var
	 * @return bool
	 */
	final public static function isInteger($var) {
		return !is_bool($var) && !is_float($var) && \filter_var($var, \FILTER_VALIDATE_INT) !== \false || static::matches($var, '/^(?:\+|-)?[1-9]\d*$/D');
	}

	/**
	 * Assert variable is a natural number (ℕ₀), asserts big numbers with {@see GMP} if available. This method triggers
	 * an error of severity `E_USER_NOTICE` if GMP is not installed.
	 *
	 * @lnk https://secure.php.net/integer
	 * @param mixed $var
	 * @return bool
	 */
	final public static function isNaturalNumber($var) {
		return static::isInteger($var) && $var >= 0;
	}

	/**
	 * Assert variable is a natural number (ℕ₀), asserts big numbers with {@see GMP} if available. This method triggers
	 * an error of severity `E_USER_NOTICE` if GMP is not installed.
	 *
	 * @lnk https://secure.php.net/integer
	 * @param mixed $var
	 * @return bool
	 */
	final public static function isPositiveNaturalNumber($var) {
		return static::isInteger($var) && $var >= 1;
	}

	/**
	 * Assert variable is a real number (ℝ), asserts big numbers with BC Math if available. This method triggers an
	 * error of severity `E_USER_NOTICE` if BC Math is not installed.
	 *
	 * @link https://secure.php.net/float
	 * @param mixed $var
	 * @param int $scale
	 * @return bool
	 */
	final public static function isRealNumber($var, $scale = self::BC_MATH_DEFAULT_SCALE) {
		assert('Variable::isScalarNaturalNumber($scale)', 'BC Math scale must be a natural number (ℕ₀) of type int');

		if (is_numeric($var)) {
			if (filter_var($var, FILTER_VALIDATE_FLOAT) !== false) {
				return true;
			}

			if (function_exists('bccomp')) {
				return is_string($var) && bccomp($var, $var, $scale) === 0;
			}
			else {
				trigger_error('BC Math not installed cannot assert big floating-point numbers.', E_USER_NOTICE);
			}
		}

		return false;
	}

	/**
	 * Assert variable is a natural number (ℕ₀) of type int.
	 *
	 * @lnk https://secure.php.net/integer
	 * @see is_int()
	 * @param mixed $var
	 * @return bool
	 */
	final public static function isScalarNaturalNumber($var) {
		return is_int($var) && $var > -1;
	}

	/**
	 * Assert variable is a positive natural number (ℕ₁) of type int.
	 *
	 * @lnk https://secure.php.net/integer
	 * @see is_int()
	 * @param mixed $var
	 * @return bool
	 */
	final public static function isScalarPositiveNaturalNumber($var) {
		return is_int($var) && $var > 0;
	}

	/**
	 * Assert variable is a stream resource.
	 *
	 * @param mixed $var
	 * @return bool
	 */
	final public static function isStreamResource($var) {
		return is_resource($var) && get_resource_type($var) === 'stream';
	}

	/**
	 * Assert variable is a strict array, only variables of type array or {@see SplFixedArray} are considered valid.
	 *
	 * Arrays in PHP are unlike arrays in most other programming languages not strictly indexed at all times. They can
	 * be sparse (missing indices), associative (string indices), and multi-dimensional (array with array values). This
	 * assertion iterates through the whole variable and ensures that it is continuously indexed from zero (`0`) to
	 * _n_ (total count).
	 *
	 * Note that {@see SplFixedArray}s are never sparse and can be iterated with a for loop. However, the {@see empty}
	 * operation is not possible, it only works as expected on variables of type array.
	 *
	 * Note that `NULL` values are considered valid and keys are checked with {@see array_key_exists}.
	 *
	 * @param mixed $var
	 * @return bool
	 */
	final public static function isStrictArray($var) {
		if ($var instanceof \SplFixedArray) {
			return true;
		}

		if (is_array($var)) {
			$c = count($var);
			for ($i = 0; $i < $c; ++$i) {
				if (!array_key_exists($i, $var)) {
					return false;
				}
			}
			return true;
		}

		return false;
	}

	/**
	 * Assert variable is a string with content.
	 *
	 * @param mixed $var
	 * @return bool
	 */
	final public static function isStringWithContent($var) {
		return is_string($var) && $var !== '';
	}

	/**
	 * Assert variable is a stringable (string or convertible object).
	 *
	 * @param mixed $var
	 * @return bool
	 */
	final public static function isStringable($var) {
		return is_string($var) || method_exists($var, '__toString');
	}

	/**
	 * Assert variable is a stringable (string or convertible object) with content.
	 *
	 * @param mixed $var
	 * @return bool
	 */
	final public static function isStringableWithContent($var) {
		return static::isStringable($var) && ((string) $var) !== '';
	}

	/**
	 * Assert variable is a subclass of class.
	 *
	 * @param mixed $var
	 * @param object|string $class
	 * @param bool $allow_string
	 *   Whether to invoke the auto-loader if the variable is a string or not and fail if variable is not an object.
	 * @return bool
	 */
	final public static function isSubclassOf($var, $class, $allow_string = true) {
		assert('is_object($class) || (is_string($class) && class_exists($class))', 'second argument must be an object or the name of an existing class');
		assert('is_bool($allow_string)', 'third argument must be of type bool');

		$str = \is_string($var);

		if (\is_object($var) === \false && $str === \false) {
			return \false;
		}

		if ($str && ($allow_string === \false || \class_exists($var) === \false)) {
			return \false;
		}

		/** @noinspection ExceptionsAnnotatingAndHandlingInspection */
		return (new \ReflectionClass($var))->isSubclassOf(new \ReflectionClass($class));
	}

	/**
	 * Assert variable is traversable (array or instance of {@see Traversable}).
	 *
	 * @deprecated Use {@see is_iterable} instead.
	 * @param mixed $var
	 * @return bool
	 */
	final public static function isTraversable($var) {
		@trigger_error('Use is_iterable() instead.', E_USER_DEPRECATED);

		return is_iterable($var);
	}

	/**
	 * Assert variable matches PCRE pattern.
	 *
	 * @param mixed $var
	 * @param string $pattern
	 * @return bool
	 */
	final public static function matches($var, $pattern) {
		assert('is_string($pattern) && $pattern !== \'\'', 'second argument must be of type string and have content');

		if (!is_bool($var) && (is_scalar($var) || method_exists($var, '__toString'))) {
			return preg_match($pattern, $var) === 1;
		}

		return false;
	}

}
