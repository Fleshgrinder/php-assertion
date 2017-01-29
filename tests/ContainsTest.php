<?php
/**
 * @author Richard Fussenegger <fleshgrinder@users.noreply.github.com>
 * @copyright 2016 Richard Fussenegger
 * @license MIT
 */

namespace Fleshgrinder\Assertions;

/**
 * @covers \Fleshgrinder\Assertions\Variable::allContain()
 * @covers \Fleshgrinder\Assertions\Variable::contains()
 * @uses \Fleshgrinder\Assertions\Variable::applyCallback()
 * @uses \Fleshgrinder\Assertions\Variable::isTraversable()
 */
final class ContainsTest extends VariableDataTypeTest {

	public function testContainsCaseInsensitive() {
		$this->assertTrue(Variable::allContain(['foo sub bar'], 'SUB'));
	}

	public function testContainsCaseInsensitiveStringable() {
		$this->assertTrue(Variable::allContain([new Stringable('foo sub bar')], 'SUB'));
	}

	public function testContainsCaseSensitive() {
		$this->assertTrue(Variable::allContain(['foo sub bar'], 'sub'), true);
	}

	public function testContainsCaseSensitiveStringable() {
		$this->assertTrue(Variable::allContain([new Stringable('foo sub bar')], 'sub'), true);
	}

	public function testNotContainsCaseSensitive() {
		$this->assertFalse(Variable::allContain(['foo sub bar'], 'SUB', true));
	}

	public function testNotContainsCaseSensitiveStringable() {
		$this->assertFalse(Variable::allContain([new Stringable('foo sub bar')], 'SUB', true));
	}

	public function testNotContainsCaseInsensitive() {
		$this->assertFalse(Variable::allContain(['foo bar'], 'sub'));
	}

	public function testNotContainsCaseInsensitiveStringable() {
		$this->assertFalse(Variable::allContain([new Stringable('foo bar')], 'sub'));
	}

	public function testContainsInt() {
		$this->assertTrue(Variable::allContain([42], '2'));
	}

	public function testContainsFloat() {
		$this->assertTrue(Variable::allContain([42.42], '2'));
	}

	/** @dataProvider dataProviderDataTypes */
	public function testAllDataTypes($var) {
		$this->assertFalse(Variable::allContain($var, 'substring'));
	}

	/** @inheritDoc */
	protected function getMethodName() {
		return 'allContain';
	}

	/** @inheritDoc */
	protected function getDataTypesToExclude() {
		return [];
	}

}
