<?php
/**
 * @author Richard Fussenegger <fleshgrinder@users.noreply.github.com>
 * @copyright 2016 Richard Fussenegger
 * @license MIT
 */

namespace Fleshgrinder\Assertion;

final class ScalarNaturalNumberTest extends VariableTest {

	/** @inheritDoc */
	protected function getMethodName() {
		return 'hasScalarNaturalNumbersOnly';
	}

	/** @inheritDoc */
	protected function getDataTypesToExclude() {
		return [
			'int_negative_zero',
			'int_zero',
			'int_positive_zero',
			'int',
			'octal',
			'hex',
			'binary',
		];
	}

}