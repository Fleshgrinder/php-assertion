<?php
/**
 * @author Richard Fussenegger <fleshgrinder@users.noreply.github.com>
 * @copyright 2016 Richard Fussenegger
 * @license MIT
 */

namespace Fleshgrinder\Assertion;

/**
 * @covers \Variable::gmpCreate()
 * @covers \Variable::hasPositiveNaturalNumbersOnly()
 * @covers \Variable::isPositiveNaturalNumber()
 * @covers \Variable::setWarningHandler()
 * @uses \Variable::applyCallback()
 * @uses \Variable::isTraversable()
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
