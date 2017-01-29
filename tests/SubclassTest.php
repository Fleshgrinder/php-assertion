<?php
/**
 * @author Richard Fussenegger <fleshgrinder@users.noreply.github.com>
 * @copyright 2016 Richard Fussenegger
 * @license MIT
 */

namespace Fleshgrinder\Assertions;

class SubclassTestParentClass {}

final class SubclassTestChildClass extends SubclassTestParentClass {}

use Fleshgrinder\Assertions\Variable;

/**
 * @covers \Fleshgrinder\Assertions\Variable::hasSubclassesOfOnly()
 * @covers \Fleshgrinder\Assertions\Variable::isSubclassOf()
 * @uses \Fleshgrinder\Assertions\Variable::applyCallback()
 * @uses \Fleshgrinder\Assertions\Variable::isTraversable()
 */
final class SubclassTest extends VariableDataTypeTest {

	/** @inheritDoc */
	protected function getMethodName() {
		return 'hasSubclassesOfOnly';
	}

	/** @inheritDoc */
	protected function getDataTypesToExclude() {
		return [];
	}

	/** @dataProvider dataProviderDataTypes */
	public function testAllDataTypes($var) {
		$this->assertFalse(Variable::hasSubclassesOfOnly($var, '\stdClass'));
	}

	public function testInstance() {
		$this->assertTrue(Variable::hasSubclassesOfOnly([new SubclassTestChildClass()], new SubclassTestParentClass(), false));
	}

	public function testString() {
		$this->assertTrue(Variable::hasSubclassesOfOnly([SubclassTestChildClass::class], SubclassTestParentClass::class));
	}

	public function testNotInstance() {
		$this->assertFalse(Variable::hasSubclassesOfOnly([new SubclassTestChildClass()], $this, false));
	}

	public function testNotString() {
		$this->assertFalse(Variable::hasSubclassesOfOnly([SubclassTestChildClass::class], static::class, true));
	}

}
