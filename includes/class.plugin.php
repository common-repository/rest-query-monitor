<?php

namespace PerryRylance\WordPress\RestQueryMonitor;

use WP_REST_Server;
use WP_REST_Request;

class Plugin
{
	private $monitor;
	
	public function __construct()
	{
		$this->monitor = new Monitor();
		
		add_filter('rest_pre_echo_response', [$this, 'onRestPreEchoResponse'], 10, 3);
	}
	
	public function onRestPreEchoResponse($result, WP_REST_Server $server, WP_REST_Request $request)
	{
		foreach($this->monitor->entries as $entry)
			foreach($entry->queries as $qstr)
			{
				// Newlines not allowed in header
				$qstr = preg_replace("/[\r\n]/", " ", $qstr);
				
				header("X-REST-Query-Monitor-log-entry: $qstr", false);
			}
		
		return $result;
	}
}