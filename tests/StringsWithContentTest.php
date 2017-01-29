<?php
/**
 * @author Richard Fussenegger <fleshgrinder@users.noreply.github.com>
 * @copyright 2016 Richard Fussenegger
 * @license MIT
 */

namespace Fleshgrinder\Assertions;

/**
 * @covers \Fleshgrinder\Assertions\Variable::hasStringsWithContentOnly()
 * @covers \Fleshgrinder\Assertions\Variable::isStringWithContent()
 * @uses \Fleshgrinder\Assertions\Variable::applyCallback()
 * @uses \Fleshgrinder\Assertions\Variable::isTraversable()
 */
final class StringsWithContentTest extends VariableTest {

	/** @inheritDoc */
	protected function getMethodName() {
		return 'hasStringsWithContentOnly';
	}

	/**
	 * @inheritDoc
	 */
	protected function getDataTypesToExclude() {
		return [
			'big_int_negative',
			'big_int',
			'big_float_negative',
			'big_float',
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
