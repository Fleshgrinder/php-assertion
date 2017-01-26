<?php
/**
 * @author Richard Fussenegger <fleshgrinder@users.noreply.github.com>
 * @copyright 2017 Richard Fussenegger
 * @license MIT
 */

namespace Fleshgrinder\Assertion;

/**
 * @covers \Variable::hasIterablesOnly()
 * @uses \Variable::applyCallback()
 */
final class IterableTest extends VariableTest {

	/** @inheritDoc */
	protected function getMethodName() {
		return 'hasIterablesOnly';
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
		];
	}

}
