<?php
/**
 * @author Richard Fussenegger <fleshgrinder@users.noreply.github.com>
 * @copyright 2016 Richard Fussenegger
 * @license MIT
 */

namespace Fleshgrinder\Assertions;

/**
 * @covers \Fleshgrinder\Assertions\Variable::hasInstancesOfOnly()
 * @covers \Fleshgrinder\Assertions\Variable::isInstanceOf()
 * @uses \Fleshgrinder\Assertions\Variable::applyCallback()
 * @uses \Fleshgrinder\Assertions\Variable::isTraversable()
 */
final class InstanceOfTest extends VariableDataTypeTest {

	/** @inheritDoc */
	protected function getMethodName() {
		return 'hasInstancesOfOnly';
	}

	/** @inheritDoc */
	protected function getDataTypesToExclude() {
		return ['object'];
	}

	/** @dataProvider dataProviderDataTypes */
	public function testAllDataTypes($var) {
		static::assertFalse(Variable::isInstanceOf($var, \stdClass::class));
	}

	public static function testInstance() {
		static::assertTrue(Variable::isInstanceOf(new InstanceOfTestHelperClass, new InstanceOfTestHelperClass, false));
	}

	public static function testAllInstances() {
		static::assertTrue(Variable::hasInstancesOfOnly([new InstanceOfTestHelperClass], new InstanceOfTestHelperClass, false));
	}

	public static function testString() {
		static::assertTrue(Variable::isInstanceOf(InstanceOfTestHelperClass::class, InstanceOfTestHelperClass::class));
	}

	public static function testAllStrings() {
		static::assertTrue(Variable::hasInstancesOfOnly([InstanceOfTestHelperClass::class], InstanceOfTestHelperClass::class));
	}

	public static function testNotInstance() {
		static::assertFalse(Variable::isInstanceOf(new InstanceOfTestHelperClass, new \DateTIme, false));
	}

	public static function testAllNotInstances() {
		static::assertFalse(Variable::hasInstancesOfOnly([new InstanceOfTestHelperClass], new \DateTIme, false));
	}

	public static function testNotString() {
		static::assertFalse(Variable::isInstanceOf(InstanceOfTestHelperClass::class, static::class, true));
	}

	public static function testAllNotStrings() {
		static::assertFalse(Variable::hasInstancesOfOnly([InstanceOfTestHelperClass::class], static::class, true));
	}

}
