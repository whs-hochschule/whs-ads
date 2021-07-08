<?php

$request = json_decode(stripslashes(file_get_contents('php://input')), JSON_OBJECT_AS_ARRAY);
$data = $request['data'];

//$implodedData = implode(',', $data[1]);

//var_dump($data);
echo shell_exec('python3 heapsort.py --zeile1 '.$data);