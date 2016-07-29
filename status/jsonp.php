<?php
	$hosts = ["http://eu.p2pool.ovh:9332", "http://eu.p2pool.ovh:7903", "http://eu.p2pool.ovh:9171", "http://eu.p2pool.ovh:19327"];
	if (!isset($_GET['report']) || !isset($_GET['host'])) die("Invalid Request.");

	$report = $_GET['report']; 
	$host = $_GET['host'];
	$web_url = $host . $report;
	
	if(!in_array($_GET['host'], $hosts)) die("Wrong host.");	
	if (file_exists($web_url))	die("Access Denied.");
	if (!filter_var($web_url, FILTER_VALIDATE_URL))	die("Invalid Host.");

	$json = file_get_contents($web_url);
	echo sprintf('%s(%s);', $_GET['callback'], $json);  
?>
