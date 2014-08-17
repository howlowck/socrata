<?php namespace Howlowck\Socrata;

class Socrata {
	protected $baseUrl = 'http://opendata.socrata.com';
	protected $secretToken = '';
	protected $publicToken = '';

	function __construct ($baseUrl = null, $secretToken = null, $publicToken = null) {
		if ( ! is_null ($baseUrl)) {
			$this->baseUrl = $baseUrl;
		}
		if ( ! is_null ($secretToken)) {
			$this->secretToken = $secretToken;
		}
		if ( ! is_null($publicToken)) {	
			$this->publicToken = $publicToken;
		}
	}

	public function get($path) {
		return $path . '!!!';
	}


}