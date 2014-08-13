<?php
/*
 * Converts CSV to JSON.
 * From https://gist.github.com/bunchjesse/4532891
 * Who forked from https://gist.github.com/robflaherty/1185299
 * Usage:
 * php -f csv-to-json.php mcc_codes.csv mcc_codes.small.json
 */

// Set your CSV input and output.
$input = $argv[1];
$output = $argv[2];

if (empty($input)) exit('You must supply an input file');
if (empty($output)) exit('You must supply an output file');

if (!file_exists($input)) exit("Your input file doesn't exist");

// Arrays we'll use later.
$keys = array();
$newArray = array();

// Function to convert CSV into associative array.
// Probably from php.net
function csvToArray($file, $delimiter) {
  if (($handle = fopen($file, 'r')) !== FALSE) {
    $i = 0;
    while (($lineArray = fgetcsv($handle, 4000, $delimiter, '"')) !== FALSE) {
      for ($j = 0; $j < count($lineArray); $j++) {
        $arr[$i][$j] = $lineArray[$j];
      }
      $i++;
    }
    fclose($handle);
  }
  return $arr;
}

// Do it.
$data = csvToArray($input, ',');

// Set number of elements (minus 1 because we shift off the first row).
$count = count($data) - 1;

//Use first row for names.
$labels = array_shift($data);

foreach ($labels as $label) {
  $keys[] = $label;
}

// Add Ids, just in case we want them later.
$keys[] = 'id';

for ($i = 0; $i < $count; $i++) {
  $data[$i][] = $i;
}

// Bring it all together.
for ($j = 0; $j < $count; $j++) {
  $d = array_combine($keys, $data[$j]);
  $newArray[$j] = $d;
}

// Print it out as JSON.
file_put_contents($output, json_encode($newArray));
