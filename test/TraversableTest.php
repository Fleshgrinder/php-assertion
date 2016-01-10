<?php
/**
 * @author Richard Fussenegger <fleshgrinder@users.noreply.github.com>
 * @copyright 2016 Richard Fussenegger
 * @license MIT
 */

namespace Fleshgrinder\Assertion;

final class TraversableTest extends VariableTest {

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
