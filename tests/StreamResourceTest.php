<?php
/**
 * @author Richard Fussenegger <fleshgrinder@users.noreply.github.com>
 * @copyright 2016 Richard Fussenegger
 * @license MIT
 */

namespace Fleshgrinder\Assertions;

/**
 * @covers \Fleshgrinder\Assertions\Variable::hasStreamResourcesOnly()
 * @covers \Fleshgrinder\Assertions\Variable::isStreamResource()
 * @uses \Fleshgrinder\Assertions\Variable::applyCallback()
 * @uses \Fleshgrinder\Assertions\Variable::isTraversable()
 */
final class StreamResourceTest extends VariableTest {

	/** @inheritDoc */
	protected function getMethodName() {
		return 'hasStreamResourcesOnly';
	}

	/** @inheritDoc */
	protected function getDataTypesToExclude() {
		return ['resource_stream'];
	}

}
