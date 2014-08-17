<?php

use Howlowck\Socrata\Request;
use Mockery as m;

class SocrataRequestTest extends PHPUnit_Framework_TestCase
{
	public function __construct() {

	}

	public function testAddWhereToQueriesArray() {
		$req = new Request('data.cityofchicago.org', 'xef-ef');
		$req->where('REST=true');
		$this->assertEquals(['$where' => 'REST=true'], $req->getQueriesArray());
	}

	public function testAddAnythingToQueriesArray() {
		$req = new Request('data.cityofchicago.org', 'xef-ef');
		$req->anything('ok_cool');
		$this->assertEquals(['anything' => 'ok_cool'], $req->getQueriesArray());
	}

	public function testBuildUrlWithDefaultProtocol() {
		$req = new Request('data.cityofchicago.org', 'xef-ef');
		$this->assertEquals('http://data.cityofchicago.org/resource/xef-ef.json', $req->buildUrl());
	}

	public function testBuildUrlWithSecureProtocol() {
		$req = new Request('data.cityofchicago.org', 'xef-ef', true);
		$this->assertEquals('https://data.cityofchicago.org/resource/xef-ef.json', $req->buildUrl());
	}

	public function testBuildUrlWithRetrievalNumberId() {
		$req = new Request('data.cityofchicago.org', 'xef-ef');
		$req->retrieve(1);
		$this->assertEquals('http://data.cityofchicago.org/resource/xef-ef/1.json', $req->buildUrl());
	}

//	public function testNewRequestReturnsGuzzleRequest() {
//		$req = new Request('data.cityofchicago.org', 'gkur-vufi');
//		$this->assertInstanceOf('GuzzleHttp\\Request', $req);
//	}

}