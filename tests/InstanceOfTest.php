<?php
/**
 * @author Richard Fussenegger <fleshgrinder@users.noreply.github.com>
 * @copyright 2016 Richard Fussenegger
 * @license MIT
 */

namespace Fleshgrinder\Assertions;

final class InstanceOfTestHelperClass {}

use Fleshgrinder\Assertions\Variable;

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
