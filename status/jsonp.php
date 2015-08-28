<?php
function array_merge_recursive_unique($array1, $array2) {
  if (empty($array1)) return $array2; //optimize the base case

  foreach ($array2 as $key => $value) {
    if (is_array($value) && is_array(@$array1[$key])) {
      $value = array_merge_recursive_unique($array1[$key], $value);
    }
    $array1[$key] = $value;
  }
  return $array1;
}

$ctx = stream_context_create(array('http'=>
	array(
		'timeout' => 1
	)
));

$report = $_GET['report']; 
$host = $_GET['host'];

$web_url = $host . $report;
$hosts = ["http://eu.p2pool.pl:9332", "http://eu.p2pool.pl:7903", "http://ru.p2pool.pl:7903", "http://eu.p2pool.pl:9171", 
		  "http://ru.p2pool.pl:7903", "http://eu.p2pool.pl:9171", "http://ru.p2pool.pl:9171", "http://eu.p2pool.pl:19327", 
		  "http://ru.p2pool.pl:19327"];
	
if(!in_array($_GET['host'], $hosts)) die("Wrong host.");		
if (!isset($_GET['report']) || !isset($_GET['host'])) die("Invalid Request.");
if (file_exists($web_url))	die("Access Denied.");
if (!filter_var($web_url, FILTER_VALIDATE_URL))	die("Invalid Host1.");
	
$port = explode(":", $_GET['host']);
$json = file_get_contents($web_url);
if($port[2] == 7903){
	$a = file_get_contents("http://us.p2pool.pl:7903".$report, false, $ctx);
	if(!empty($a)){
		if((stristr($report, '/web/graph_data/local_hash_rate') !== FALSE) || stristr($report, '/web/graph_data/local_dead_hash_rate') !== FALSE){
			$arr1 = json_decode($a, true);
			$arr2 = json_decode($json, true);
			$arr3 = array();
			foreach ($arr1 as $key => $value) {
				array_push($arr3, [$value[0], $value[1] + $arr2[$key][1], $value[2] + $arr2[$key][2], $value[3] + $arr2[$key][3]]);
			}
			$json = json_encode($arr3);
		}
		if($report == '/local_stats'){
			$json = json_encode(array_merge_recursive_unique(json_decode($a, true), json_decode($json, true)));
		}
	}
}

if($report == '/local_stats'){
	$arr = json_decode($json, true);
	arsort($arr["miner_hash_rates"]);
	$json = json_encode($arr);
}
	
echo sprintf('%s(%s);', $_GET['callback'], $json);
