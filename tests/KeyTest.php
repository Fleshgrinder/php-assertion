<?php
/**
 * @author Richard Fussenegger <fleshgrinder@users.noreply.github.com>
 * @copyright 2016–2017 Richard Fussenegger
 * @license MIT
 */

namespace Fleshgrinder\Assertions;

/**
 * @covers \Fleshgrinder\Assertions\Variable::hasKeys()
 */
final class KeyTest extends VariableDataTypeTest {

	public function testHasKeys() {
		$this->assertTrue(Variable::hasKeys(['foo' => false, 'bar' => null], 'foo', 'bar'));
	}

	/** @dataProvider dataProviderDataTypes */
	public function testAllDataTypes($var) {
		$this->assertFalse(Variable::hasKeys(array_shift($var), 'foo'));
	}

	/** @inheritDoc */
	protected function getMethodName() {
		return 'hasKeys';
	}

	/** @inheritDoc */
	protected function getDataTypesToExclude() {
		return ['dictionary'];
	}

}
