<?php
/**
 * @author Richard Fussenegger <fleshgrinder@users.noreply.github.com>
 * @copyright 2016 Richard Fussenegger
 * @license MIT
 */

namespace Fleshgrinder\Assertion;

final class ObjectTest extends VariableTest {

	/** @inheritDoc */
	protected function getMethodName() {
		return 'hasObjectsOnly';
	}

	/**
	 * @inheritDoc
	 */
	protected function getDataTypesToExclude() {
		return [
			'object',
			'empty_stringable',
			'stringable',
			'empty_array_object',
			'array_object',
			'empty_fixed_array',
			'fixed_array',
			'closure',
		];
	}

}
