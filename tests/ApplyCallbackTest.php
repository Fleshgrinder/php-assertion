<?php
/**
 * @author Richard Fussenegger <fleshgrinder@users.noreply.github.com>
 * @copyright 2016 Richard Fussenegger
 * @license MIT
 */

namespace Fleshgrinder\Assertions;

/**
 * @covers \Fleshgrinder\Assertions\Variable::applyCallback()
 * @uses \Fleshgrinder\Assertions\Variable::isTraversable()
 */
final class ApplyCallbackTest extends VariableDataTypeTest {

	public static function testWithDelta() {
		$correctly_called = 0;
		$data = ['a', 'b'];
		Variable::applyCallback($data, function ($member, $delta) use (&$correctly_called, $data) {
			if ($delta === $correctly_called && $member === $data[$delta]) {
				++$correctly_called;
			}
		});
		static::assertSame(2, $correctly_called);
	}

	public static function testWithDeltaFailure() {
		static::assertFalse(Variable::applyCallback([1], function () {
			return \false;
		}));
	}

	public static function testWithoutDelta() {
		$correctly_called = 0;
		$data = ['a', 'b'];
		$i = 0;
		Variable::applyCallback($data, function ($member, $delta = 42) use (&$correctly_called, $data, &$i) {
			if ($delta === 42 && $member === $data[$i++]) {
				++$correctly_called;
			}
		}, false);
		static::assertSame(2, $correctly_called);
	}

	public static function testWithoutDeltaFailure() {
		static::assertFalse(Variable::applyCallback([1], function () {
			return \false;
		}), \false);
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
