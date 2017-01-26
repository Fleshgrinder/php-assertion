<?php
/**
 * @author Richard Fussenegger <fleshgrinder@users.noreply.github.com>
 * @copyright 2016 Richard Fussenegger
 * @license MIT
 */

namespace Fleshgrinder\Assertion;

final class InstanceOfTestHelperClass {}

use Variable;

/**
 * @covers \Variable::hasInstancesOfOnly()
 * @covers \Variable::isInstanceOf()
 * @uses \Variable::applyCallback()
 * @uses \Variable::isTraversable()
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
		$this->assertFalse(Variable::hasInstancesOfOnly($var, '\stdClass'));
	}

	public function testInstance() {
		$this->assertTrue(Variable::hasInstancesOfOnly([new InstanceOfTestHelperClass()], new InstanceOfTestHelperClass(), false));
	}

	public function testString() {
		$this->assertTrue(Variable::hasInstancesOfOnly([InstanceOfTestHelperClass::class], InstanceOfTestHelperClass::class));
	}

	public function testNotInstance() {
		$this->assertFalse(Variable::hasInstancesOfOnly([new InstanceOfTestHelperClass()], $this, false));
	}

	public function testNotString() {
		$this->assertFalse(Variable::hasInstancesOfOnly([InstanceOfTestHelperClass::class], static::class, true));
	}

}
