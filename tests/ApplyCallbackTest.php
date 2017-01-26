<?php
/**
 * @author Richard Fussenegger <fleshgrinder@users.noreply.github.com>
 * @copyright 2016 Richard Fussenegger
 * @license MIT
 */

namespace Fleshgrinder\Assertion;

use Variable;

/**
 * @covers \Variable::applyCallback()
 * @uses \Variable::isTraversable()
 */
final class ApplyCallbackTest extends VariableDataTypeTest {

	public function testWithDelta() {
		$correctly_called = 0;
		$data = ['a', 'b'];
		Variable::applyCallback($data, function ($member, $delta) use (&$correctly_called, $data) {
			if ($delta === $correctly_called && $member === $data[$delta]) {
				++$correctly_called;
			}
		});
		$this->assertSame(2, $correctly_called);
	}

	public function testWithoutDelta() {
		$correctly_called = 0;
		$data = ['a', 'b'];
		$i = 0;
		Variable::applyCallback($data, function ($member, $delta = 42) use (&$correctly_called, $data, &$i) {
			if ($delta === 42 && $member === $data[$i++]) {
				++$correctly_called;
			}
		}, false);
		$this->assertSame(2, $correctly_called);
	}

	/** @dataProvider dataProviderDataTypes */
	public function testAllDataTypes($var) {
		$this->assertFalse(Variable::applyCallback(array_shift($var), function () {
			trigger_error('Callback was called.', E_USER_ERROR);
		}));
	}

	/** @inheritDoc */
	protected function getMethodName() {
		return 'applyCallback';
	}

	/** @inheritDoc */
	protected function getDataTypesToExclude() {
		return [
			'empty_array',
			'array',
			'dictionary',
			'empty_array_object',
			'array_object',
			'empty_fixed_array',
			'fixed_array',
			'callable_method',
			'callable_static_method',
		];
	}

}
