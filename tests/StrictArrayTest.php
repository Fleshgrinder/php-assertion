<?php
/**
 * @author Richard Fussenegger <fleshgrinder@users.noreply.github.com>
 * @copyright 2016 Richard Fussenegger
 * @license MIT
 */

namespace Fleshgrinder\Assertions;

/**
 * @covers \Fleshgrinder\Assertions\Variable::hasStrictArraysOnly()
 * @covers \Fleshgrinder\Assertions\Variable::isStrictArray()
 * @uses \Fleshgrinder\Assertions\Variable::applyCallback()
 * @uses \Fleshgrinder\Assertions\Variable::isTraversable()
 */
final class StrictArrayTest extends VariableTest {

	/** @inheritDoc */
	protected function getMethodName() {
		return 'hasStrictArraysOnly';
	}

	/** @inheritDoc */
	protected function getDataTypesToExclude() {
		return [
			'empty_array',
			'array',
			'empty_fixed_array',
			'fixed_array',
			'callable_method',
		];
	}

}
