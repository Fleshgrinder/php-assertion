<?php
/**
 * @author Richard Fussenegger <fleshgrinder@users.noreply.github.com>
 * @copyright 2016 Richard Fussenegger
 * @license MIT
 */

namespace Fleshgrinder\Assertions;

/**
 * @covers \Fleshgrinder\Assertions\Variable::hasTraversablesOnly()
 * @covers \Fleshgrinder\Assertions\Variable::isTraversable()
 * @uses \Fleshgrinder\Assertions\Variable::applyCallback()
 */
final class TraversableTest extends VariableTest {
	use DisableDeprecationErrors;

	/** @inheritDoc */
	protected function getMethodName() {
		return 'hasTraversablesOnly';
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
