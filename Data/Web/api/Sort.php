<?php
$request = json_decode(stripslashes(file_get_contents('php://input')), JSON_OBJECT_AS_ARRAY);
$data = $request['data'];
$methode = $request['methode'];

$sortiertArray = explode(',', $data);
sort($sortiertArray);
$sortiertString = implode(',', $sortiertArray);

echo shell_exec('python3 ../../Python/Sort.py --methode '. $methode .' --unsortiert '. $data .' --sortiert ' . $sortiertString);