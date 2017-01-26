<?php
/**
 * @author Richard Fussenegger <fleshgrinder@users.noreply.github.com>
 * @copyright 2016 Richard Fussenegger
 * @license MIT
 */

namespace Fleshgrinder\Assertion;

/**
 * This test illustrates nicely how dangerous PHP’s {@see empty} is if the caller does not know what he really wants.
 *
 * @covers \Variable::hasNoEmptyValues()
 * @uses \Variable::applyCallback()
 * @uses \Variable::isTraversable()
 */
final class NotEmptyTest extends VariableTest {

	/** @inheritDoc */
	protected function getMethodName() {
		return 'hasNoEmptyValues';
	}

	/** @inheritDoc */
	protected function getDataTypesToExclude() {
		return [
			'bool_true',
			'big_int_negative',
			'int_negative',
			'int',
			'big_int',
			'octal',
			'hex',
			'binary',
			'big_float_negative',
			'float_negative',
			'float',
			'big_float',
			'string',
			'string_minus_zero_int',
			'string_minus_zero_float',
			'int_string_negative',
			'int_string_negative_zero',
			'int_string_positive_zero',
			'int_string',
			'float_string_negative',
			'float_string_negative_zero',
			'float_string_zero',
			'float_string_positive_zero',
			'float_string',
			'array',
			'dictionary',
			'object',
			'empty_stringable',
			'stringable',
			'empty_array_object',
			'array_object',
			'empty_fixed_array',
			'fixed_array',
			'closure',
			'callable_method',
			'callable_static_method',
			'callable_function',
			'resource_stream',
			'resource_gd',
		];
	}

}
