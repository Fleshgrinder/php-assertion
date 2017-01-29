<?php
/**
 * @author Richard Fussenegger <fleshgrinder@users.noreply.github.com>
 * @copyright 2016 Richard Fussenegger
 * @license MIT
 */

namespace Fleshgrinder\Assertions;

/**
 * @covers \Fleshgrinder\Assertions\Variable::hasNumericsOnly()
 * @uses \Fleshgrinder\Assertions\Variable::applyCallback()
 * @uses \Fleshgrinder\Assertions\Variable::isTraversable()
 */
final class NumericTest extends VariableTest {

	/** @inheritDoc */
	protected function getMethodName() {
		return 'hasNumericsOnly';
	}

	/** @inheritDoc */
	protected function getDataTypesToExclude() {
		return [
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
		];
	}

}
