<?php

namespace Fleshgrinder\Assertions;

final class Stringable {

	private $string;

	public function __construct($string) {
		$this->string = $string;
	}

	public function __toString() {
		return (string) $this->string;
	}

}
