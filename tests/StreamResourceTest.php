<?php
/**
 * @author Richard Fussenegger <fleshgrinder@users.noreply.github.com>
 * @copyright 2016 Richard Fussenegger
 * @license MIT
 */

namespace Fleshgrinder\Assertion;

/**
 * @covers \Variable::hasStreamResourcesOnly()
 * @covers \Variable::isStreamResource()
 * @uses \Variable::applyCallback()
 * @uses \Variable::isTraversable()
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
