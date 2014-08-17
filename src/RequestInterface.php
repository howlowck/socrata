<?php namespace Howlowck\Socrata;

interface RequestInterface {
	public function select($filters);
	public function where($query);
	public function order($sort);
	public function group($group);
	public function offset($offset);
	public function limit($limit);
	public function query($query);

	public function get();
	public function post();
	public function delete();
	public function put();

}