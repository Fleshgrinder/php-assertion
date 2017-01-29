<?php
/**
 * @author Richard Fussenegger <fleshgrinder@users.noreply.github.com>
 * @copyright 2016 Richard Fussenegger
 * @license MIT
 */

namespace Fleshgrinder\Assertions;

/**
 * @covers \Fleshgrinder\Assertions\Variable::gmpCreate()
 * @covers \Fleshgrinder\Assertions\Variable::hasNaturalNumbersOnly()
 * @covers \Fleshgrinder\Assertions\Variable::isNaturalNumber()
 * @uses \Fleshgrinder\Assertions\Variable::applyCallback()
 * @uses \Fleshgrinder\Assertions\Variable::isTraversable()
 */
final class NaturalNumberTest extends VariableTest {

	/** @inheritDoc */
	protected function getMethodName() {
		return 'hasNaturalNumbersOnly';
	}

	/** @inheritDoc */
	protected function getDataTypesToExclude() {
		return [
			'int_negative_zero',
			'int_zero',
			'int_positive_zero',
			'int',
			'big_int',
			'octal',
			'hex',
			'binary',
			'int_string_negative_zero',
			'int_string_zero',
			'int_string_positive_zero',
			'int_string',
		];
	}

}
