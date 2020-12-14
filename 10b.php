<?php
$input = file('inputs/10a.txt', FILE_IGNORE_NEW_LINES);
$map = array_fill_keys($input, 0);
ksort($map);
$map[0] = 1;

array_walk($map, function (&$item, $key) use (&$map) {
	$item = ($map[$key - 1] ?? 0)
		+ ($map[$key - 2] ?? 0)
		+ ($map[$key - 3] ?? 0);
});
echo max($map);
return;
