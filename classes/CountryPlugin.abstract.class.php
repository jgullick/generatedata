<?php

abstract class CountryPlugin {
	protected $countryName;
	protected $countrySlug;
  protected $regionNames;
  protected $zipFormat;

	static function install() {
		return;
	}

	final public function getName() {
    return $this->countryName;
	}

	final public function getSlug() {
    return $this->countrySlug;
	}
}