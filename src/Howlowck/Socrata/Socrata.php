<?php namespace Howlowck\Socrata;

class Socrata {
	protected $baseUrl = 'http://opendata.socrata.com';
	protected $secretToken = null;
	protected $publicToken = null;

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

	public function createRequest($resource) {
		$req = new Request($this->baseUrl, $resource, $this->publicToken);
		if ( ! is_null($this->publicToken)) {
			$req->token($this->publicToken);
		}
		return $req;
	}

}