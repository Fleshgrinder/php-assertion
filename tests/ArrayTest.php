<?php
/**
 * @author Richard Fussenegger <fleshgrinder@users.noreply.github.com>
 * @copyright 2016 Richard Fussenegger
 * @license MIT
 */

namespace Fleshgrinder\Assertions;

/**
 * @covers \Fleshgrinder\Assertions\Variable::hasArraysOnly()
 * @uses \Fleshgrinder\Assertions\Variable::applyCallback()
 * @uses \Fleshgrinder\Assertions\Variable::isTraversable()
 */
final class ArrayTest extends VariableTest {

	/** @inheritDoc */
	protected function getMethodName() {
		return 'hasArraysOnly';
	}

	/** @inheritDoc */
	protected function getDataTypesToExclude() {
		return ['empty_array', 'array', 'dictionary', 'callable_method'];
	}

	/**
	 * @covers \Fleshgrinder\Assertions\Variable::hasAllSet()
	 */
	public static function testHasAllSet() {
		static::assertTrue(Variable::hasAllSet([1, 2, 3]));
	}

	/**
	 * @covers \Fleshgrinder\Assertions\Variable::hasAllSet()
	 */
	public static function testHasAllSetWithUnset() {
		static::assertFalse(Variable::hasAllSet([1, \null, 3]));
	}

}
