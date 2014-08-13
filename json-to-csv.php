<?php

if (empty($argv[1])) die("The json file name or URL is missed\n");
$jsonFilename = $argv[1];
 
$json = file_get_contents($jsonFilename);
$array = json_decode($json, true);
$f = fopen('php://output', 'w');
 
$firstLineKeys = false;
foreach ($array as $line)
{
	if (empty($firstLineKeys))
	{
		$firstLineKeys = array_keys($line);
		fputcsv($f, $firstLineKeys);
		$firstLineKeys = array_flip($firstLineKeys);
	}
	// Using array_merge is important to maintain the order of keys acording to the first element
	fputcsv($f, array_merge($firstLineKeys, $line));
}


