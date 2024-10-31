<?php

namespace PerryRylance\WordPress\RestQueryMonitor;

use WP_REST_Request;

class Entry
{
	private $_request;
	private $_queries;
	
	public function __construct(WP_REST_Request $request)
	{
		$this->_request = $request;
		$this->_queries = [];
	}
	
	public function __get($name)
	{
		if(isset($this->{"_$name"}))
			return $this->{"_$name"};
	}
	
	public function log($qstr)
	{
		if(!is_string($qstr))
			throw new \Exception("Expected string");
		
		$this->_queries []= $qstr;
	}
}