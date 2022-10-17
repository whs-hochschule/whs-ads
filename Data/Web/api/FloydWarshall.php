<?php
$request = json_decode(stripslashes(file_get_contents('php://input')), JSON_OBJECT_AS_ARRAY);
$data = $request['data'];

$zeile1 = implode(',', $data[0]);
$zeile2 = implode(',', $data[1]);
$zeile3 = implode(',', $data[2]);
$zeile4 = implode(',', $data[3]);

echo shell_exec('python3 ../../Python/FloydWarshall.py --zeile1 x,' . $zeile1 . ' --zeile2 x,' . $zeile2 . ' --zeile3 x,' . $zeile3 . ' --zeile4 x,' . $zeile4 . '');