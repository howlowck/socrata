<?php namespace Howlowck\Socrata;

use GuzzleHttp\Client as Client;

class Request implements RequestInterface {
	protected $client;
	protected $protocol;
	protected $domain;
	protected $identifier;
	protected $resource;
	protected $request;

	protected $format;
	protected $queriesArray = [];

	function __construct($baseurl, $resource, $protocol = false, $format = 'json') {
		$this->client = new Client();
		$this->domain = $baseurl;
		$this->resource = $resource;
		$this->protocol = $protocol;
		$this->format = $format;
	}

	public function getRequest() {
		return $this->request;
	}

	public function setRequest($request) {
		return $this->request = $request;
	}

	public function token($token) {
		$this->addQuery('$$app_token', $token);
	}

	public function format($format) {
		$this->format = $format;
	}

	public function retrieve($id) {
		$this->identifier = $id;
	}

	public function select($query) {
		$this->addQuery('$select', $query);
		return $this;
	}

	public function where($query) {
		$this->addQuery('$where', $query);
		return $this;
	}

	public function order($query) {
		$this->addQuery('$order', $query);
		return $this;
	}

	public function group($query) {
		$this->addQuery('$group', $query);
		return $this;
	}

	public function offset($number) {
		$this->addQuery('$offset', $number);
		return $this;
	}

	public function limit($number) {
		$this->addQuery('$limit', $number);
		return $this;
	}

	public function query($query) {
		$this->addQuery('$q', $query);
		return $this;
	}

	public function getQueriesArray() {
		return $this->queriesArray;
	}

	protected function addQuery($name, $value) {
		if (is_array($value)) {
			$value = implode(',', $value);
		}
		$this->queriesArray[$name] = $value;
		return $this;
	}

	public function buildUrl() {
		$http = $this->protocol ? 'https://' : 'http://';
		if ( !! $this->identifier) {
			return $http . $this->domain . '/resource/' . $this->resource . '/' . $this->identifier . '.' . $this->type;
		}
		return $http . $this->domain . '/resource/' . $this->resource . '.' . $this->format;
	}

	public function get() {
		$req = $this->client->createRequest('GET', $this->buildUrl());
		$req->setQuery($this->queriesArray);

		$this->setRequest($req);
		$query = $req->getQuery();
		$query->setEncodingType(false);
		return $this->client->send($req);
	}

	public function post() {
		//TODO
	}

	public function delete() {
		//TODO
	}

	public function put() {
		//TODO
	}

	public function __call($name, $args) {
		$this->addQuery($name, $args[0]);
	}
}