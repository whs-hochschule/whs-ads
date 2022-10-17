<?php
$request = json_decode(stripslashes(file_get_contents('php://input')), JSON_OBJECT_AS_ARRAY);
$wege = $request['wege'];

$valuesToArray = explode(' ', $wege);

$edges = [];
$knoten = [];

foreach ($valuesToArray as $value) {
    $row = substr($value, 0, 1);
    $col = substr($value, 1, 1);
    $zahl = substr($value, 3, 10);

    $edges[] = "g.add_edge('" . $row . "', '" . $col . "', " . $zahl . ")";
    $knoten[] = $row;
    $knoten[] = $col;
}

$knoten = array_unique($knoten);
sort($knoten);

foreach ($knoten as $knot) {
    echo "g.add_vertex('{$knot}')".PHP_EOL;
}

echo PHP_EOL;
echo PHP_EOL;
echo PHP_EOL;

foreach ($edges as $edge) {
    echo $edge.PHP_EOL;
}