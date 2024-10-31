<?php

namespace PerryRylance\WordPress\RestQueryMonitor;

use WP_REST_Server;
use WP_REST_Request;

class Monitor
{
	private $_entries;
	private $_currentEntry;
	
	public function __construct()
	{
		$this->entries = [];
		
		add_action('rest_api_init', [$this, 'onRestApiInit']);
	}
	
	public function __get($name)
	{
		if(isset($this->{"_$name"}))
			return $this->{"_$name"};
	}
	
	private function createRequestEntry(WP_REST_Request $request)
	{
		$entry = new Entry($request);
		$this->entries []= $entry;
		
		return $entry;
	}
	
	public function getRequestEntry(WP_REST_Request $request)
	{
		foreach($this->entries as $entry)
			if($entry->request === $request)
				return $entry;
		
		return $this->createRequestEntry($request);
	}
	
	public function onRestApiInit()
	{
		$post_types = get_post_types();
		
		add_filter('rest_pre_dispatch', [$this, 'onRestPreDispatch'], 10, 3);
		add_filter('query', [$this, 'onQuery']);
	}
	
	public function onRestPreDispatch($result, WP_REST_Server $server, WP_REST_Request $request)
	{
		$this->currentEntry = $this->createRequestEntry($request);
		return $result;
	}
	
	public function onQuery($qstr)
	{
		$this->currentEntry->log($qstr);
		
		return $qstr;
	}
}