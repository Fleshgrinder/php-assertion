<?php
/**
 * @author Richard Fussenegger <fleshgrinder@users.noreply.github.com>
 * @copyright 2016 Richard Fussenegger
 * @license MIT
 */

namespace Fleshgrinder\Assertions;

abstract class VariableDataTypeTest extends \PHPUnit_Framework_TestCase {

	/** @var array */
	protected static $data_types;

	/**
	 * Get the name of the method under test.
	 *
	 * @return string
	 */
	abstract protected function getMethodName();

	/**
	 * Get the names (associative array keys) of the data types that should be excluded from the negative test.
	 *
	 * @see VariableTest::dataProviderDataTypes()
	 * @return string[]
	 */
	abstract protected function getDataTypesToExclude();

	final public function dataProviderDataTypes() {
		if (static::$data_types === null) {
			$x = str_repeat(PHP_INT_MAX, 100);

			static::$data_types = [
				// # Scalar Types
				// ## bool
				'bool_true'                  => [[true]],
				'bool_false'                 => [[false]],
				// ## int
				'big_int_negative'           => [["-{$x}"]],
				'int_negative'               => [[-42]],
				'int_negative_zero'          => [[-0]],
				'int_zero'                   => [[0]],
				'int_positive_zero'          => [[+0]],
				'int'                        => [[42]],
				'big_int'                    => [[$x]],
				'octal'                      => [[0123]],
				'hex'                        => [[0x1A]],
				'binary'                     => [[0b11111111]],
				// ## float
				'big_float_negative'         => [["-{$x}.{$x}"]],
				'float_negative'             => [[-42.42]],
				'float_negative_close_zero'  => [[-0.1E-1000]],
				'float_negative_zero'        => [[-0.0]],
				'float_zero'                 => [[0.0]],
				'float_positive_zero'        => [[+0.0]],
				'float_positive_close_zero'  => [[+0.1E-1000]],
				'float'                      => [[42.42]],
				'big_float'                  => [["{$x}.{$x}"]],
				// ## string
				'empty_string'               => [['']],
				'string'                     => [['PHP']],
				'string_minus_zero_int'      => [['−0']],
				'string_minus_zero_float'    => [['−0.0']],
				// ## string (int)
				'int_string_negative'        => [['-42']],
				'int_string_negative_zero'   => [['-0']],
				'int_string_zero'            => [['0']],
				'int_string_positive_zero'   => [['+0']],
				'int_string'                 => [['42']],
				// ## string (float)
				'float_string_negative'      => [['-42.42']],
				'float_string_negative_zero' => [['-0.0']],
				'float_string_zero'          => [['0.0']],
				'float_string_positive_zero' => [['+0.0']],
				'float_string'               => [['42.42']],

				// # Compound Types
				// ## array
				'empty_array'                => [[[]]],
				'array'                      => [[[0, 1, 2, 3, 4]]],
				'dictionary'                 => [[['foo' => 'bar']]],
				// ## object
				'object'                     => [[(object) []]],
				'empty_stringable'           => [[new Stringable('')]],
				'stringable'                 => [[new Stringable('PHP')]],
				'empty_array_object'         => [[new \ArrayObject([])]],
				'array_object'               => [[new \ArrayObject([0, 1, 2, 3, 4])]],
				'empty_fixed_array'          => [[new \SplFixedArray()]],
				'fixed_array'                => [[\SplFixedArray::fromArray([0, 1, 2, 3, 4])]],
				// callable
				'closure'                    => [[function(){}]],
				'callable_method'            => [[[new Stringable(''), '__toString']]],
				'callable_static_method'     => [[Variable::class . '::applyCallback']],
				'callable_function'          => [['phpversion']],

				// # Special Types
				// ## resource
				'resource_stream'            => [[STDERR]],
				'resource_gd'                => [[imagecreate(1, 1)]],
				// ## null
				'null'                       => [[null]],
			];
		}

		$data_types = static::$data_types;

		foreach ($this->getDataTypesToExclude() as $exclude) {
			unset($data_types[$exclude]);
		}

		return $data_types;
	}

	/** @dataProvider dataProviderDataTypes */
	public function testAllDataTypes($var) {
		$this->assertFalse(call_user_func([Variable::class, $this->getMethodName()], $var));
	}

}
