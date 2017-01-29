<?php
/**
 * @author Richard Fussenegger <fleshgrinder@users.noreply.github.com>
 * @copyright 2016 Richard Fussenegger
 * @license MIT
 */

namespace Fleshgrinder\Assertions;

/**
 * @covers \Fleshgrinder\Assertions\Variable::hasPositiveNaturalNumbersOnly()
 * @covers \Fleshgrinder\Assertions\Variable::isPositiveNaturalNumber()
 * @uses \Fleshgrinder\Assertions\Variable::applyCallback()
 * @uses \Fleshgrinder\Assertions\Variable::isInteger()
 * @uses \Fleshgrinder\Assertions\Variable::isTraversable()
 * @uses \Fleshgrinder\Assertions\Variable::matches()
 */
final class PositiveNaturalNumberTest extends VariableTest {

	/** @inheritDoc */
	protected function getMethodName() {
		return 'hasPositiveNaturalNumbersOnly';
	}

	/** @inheritDoc */
	protected function getDataTypesToExclude() {
		return ['int', 'big_int', 'int_string', 'octal', 'hex', 'binary'];
	}

}
