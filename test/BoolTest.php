<?php
/**
 * @author Richard Fussenegger <fleshgrinder@users.noreply.github.com>
 * @copyright 2016 Richard Fussenegger
 * @license MIT
 */

namespace Fleshgrinder\Assertion;

final class BoolTest extends VariableTest {

	/** @inheritDoc */
	protected function getMethodName() {
		return 'hasBoolsOnly';
	}

	/** @inheritDoc */
	protected function getDataTypesToExclude() {
		return ['bool_true', 'bool_false'];
	}

}
