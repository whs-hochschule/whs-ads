<?php
$request = json_decode(stripslashes(file_get_contents('php://input')), JSON_OBJECT_AS_ARRAY);
$data = $request['data'];
$reihenfolge = $request['reihenfolge'];
$seite = $request['seite'];

echo shell_exec('python3 ../../Python/HeapsortTD.py --reihenfolge '. $reihenfolge .' --seite '. $seite .' --zeile1 '.$data);