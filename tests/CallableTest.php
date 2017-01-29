<?php
/**
 * @author Richard Fussenegger <fleshgrinder@users.noreply.github.com>
 * @copyright 2016 Richard Fussenegger
 * @license MIT
 */

namespace Fleshgrinder\Assertions;

/**
 * @covers \Fleshgrinder\Assertions\Variable::hasCallablesOnly()
 * @uses \Fleshgrinder\Assertions\Variable::applyCallback()
 * @uses \Fleshgrinder\Assertions\Variable::isTraversable()
 */
final class CallableTest extends VariableTest {

	/** @inheritDoc */
	protected function getMethodName() {
		return 'hasCallablesOnly';
	}

	/** @inheritDoc */
	protected function getDataTypesToExclude() {
		return ['closure', 'callable_method', 'callable_static_method', 'callable_function'];
	}

}
