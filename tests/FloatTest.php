<?php
/**
 * @author Richard Fussenegger <fleshgrinder@users.noreply.github.com>
 * @copyright 2016 Richard Fussenegger
 * @license MIT
 */

namespace Fleshgrinder\Assertion;

/**
 * @covers \Variable::hasFloatsOnly()
 * @uses \Variable::applyCallback()
 * @uses \Variable::isTraversable()
 */
final class FloatTest extends VariableTest {

	/** @inheritDoc */
	protected function getMethodName() {
		return 'hasFloatsOnly';
	}

	/** @inheritDoc */
	protected function getVariables() {
		return [-0.0, 0.0, +0.0, 4.2, 1.2e3, 7E-10];
	}

	/** @inheritDoc */
	protected function getDataTypesToExclude() {
		return ['float_negative', 'float_negative_close_zero', 'float_negative_zero', 'float_zero', 'float_positive_zero', 'float_positive_close_zero', 'float'];
	}

}
