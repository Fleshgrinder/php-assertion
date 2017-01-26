<?php
/**
 * @author Richard Fussenegger <fleshgrinder@users.noreply.github.com>
 * @copyright 2016 Richard Fussenegger
 * @license MIT
 */

namespace Fleshgrinder\Assertion;

use Variable;

abstract class VariableTest extends VariableDataTypeTest {

	public function test() {
		$var = $this->getVariables();
		if (!is_array($var)) {
			$var = [$var];
		}
		$this->assertTrue(call_user_func([Variable::class, $this->getMethodName()], $var));
	}

	/**
	 * Get the variables that should result in a positive test.
	 *
	 * @return mixed
	 */
	protected function getVariables() {
		$variables = [];

		foreach ($this->getDataTypesToExclude() as $include) {
			$variables[] = static::$data_types[$include][0][0];
		}

		return $variables;
	}

}
