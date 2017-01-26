<?php

namespace Fleshgrinder\Assertion;

trait DisableDeprecationErrors {

	private $previous;

	/** @before */
	public function disableDeprecationErrors() {
		$this->previous = error_reporting();
		error_reporting($this->previous & ~E_USER_DEPRECATED);
	}

	/** @after */
	public function enableDeprecationErrors() {
		error_reporting($this->previous);
	}

}
