<?php
/**
 * @author Richard Fussenegger <fleshgrinder@users.noreply.github.com>
 * @copyright 2016 Richard Fussenegger
 * @license MIT
 */

namespace Fleshgrinder\Assertion;

use Variable;

final class MatchesTest extends VariableDataTypeTest {

	public function testMatch() {
		$this->assertTrue(Variable::allMatch(['foo bar'], '/^foo bar$/D'));
	}

	public function testNoMatch() {
		$this->assertFalse(Variable::allMatch(['foo bar'], '/^bar foo$/D'));
	}

	/** @dataProvider dataProviderDataTypes */
	public function testAllDataTypes($var) {
		$this->assertFalse(Variable::allMatch($var, '/^$/D'));
	}

	/** @inheritDoc */
	protected function getMethodName() {
		return 'allMatch';
	}

	/** @inheritDoc */
	protected function getDataTypesToExclude() {
		return ['empty_string', 'empty_stringable'];
	}

}
