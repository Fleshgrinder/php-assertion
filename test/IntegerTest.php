<?php
/**
 * @author Richard Fussenegger <fleshgrinder@users.noreply.github.com>
 * @copyright 2016 Richard Fussenegger
 * @license MIT
 */

namespace Fleshgrinder\Assertion;

final class IntegerTest extends VariableTest {

	/** @inheritDoc */
	protected function getMethodName() {
		return 'hasIntegersOnly';
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
			'int_string_negative',
			'int_string_negative_zero',
			'int_string_zero',
			'int_string_positive_zero',
			'int_string',
		];
	}

}
