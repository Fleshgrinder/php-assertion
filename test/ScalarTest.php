<?php
/**
 * @author Richard Fussenegger <fleshgrinder@users.noreply.github.com>
 * @copyright 2016 Richard Fussenegger
 * @license MIT
 */

namespace Fleshgrinder\Assertion;

/**
 * @covers \Variable::hasScalarsOnly()
 * @uses \Variable::applyCallback()
 * @uses \Variable::isTraversable()
 */
final class ScalarTest extends VariableTest {

	/** @inheritDoc */
	protected function getMethodName() {
		return 'hasScalarsOnly';
	}

	/** @inheritDoc */
	protected function getDataTypesToExclude() {
		return [
			'bool_true',
			'bool_false',
			'big_int_negative',
			'int_negative',
			'int_negative_zero',
			'int_zero',
			'int_positive_zero',
			'int',
			'big_int',
			'octal',
			'hex',
			'binary',
			'big_float_negative',
			'float_negative',
			'float_negative_close_zero',
			'float_negative_zero',
			'float_zero',
			'float_positive_zero',
			'float_positive_close_zero',
			'float',
			'big_float',
			'empty_string',
			'string',
			'string_minus_zero_int',
			'string_minus_zero_float',
			'int_string_negative',
			'int_string_negative_zero',
			'int_string_zero',
			'int_string_positive_zero',
			'int_string',
			'float_string_negative',
			'float_string_negative_zero',
			'float_string_zero',
			'float_string_positive_zero',
			'float_string',
			'callable_static_method',
			'callable_function',
		];
	}

}
