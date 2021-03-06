<?php
/**
 * @author Richard Fussenegger <fleshgrinder@users.noreply.github.com>
 * @copyright 2016 Richard Fussenegger
 * @license MIT
 */

namespace Fleshgrinder\Assertions;

/**
 * @covers \Fleshgrinder\Assertions\Variable::hasIntsOnly()
 * @uses \Fleshgrinder\Assertions\Variable::applyCallback()
 * @uses \Fleshgrinder\Assertions\Variable::isTraversable()
 */
final class IntTest extends VariableTest {

	/** @inheritDoc */
	protected function getMethodName() {
		return 'hasIntsOnly';
	}

	/** @inheritDoc */
	protected function getDataTypesToExclude() {
		return ['int_negative', 'int_negative_zero', 'int_zero', 'int_positive_zero', 'int', 'octal', 'hex', 'binary'];
	}

}
