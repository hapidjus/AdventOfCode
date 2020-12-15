<?php
$input = file('inputs/13a.txt', FILE_IGNORE_NEW_LINES);
$target = $input[0];

$bussMap = array_map(function($item) use ($target){
	return $item - $target % $item;
}, array_combine(
	$busses = array_filter(
		explode(',', $input[1]),
		fn($item) => $item !== 'x'
	),
	$busses)
);

echo min($bussMap) * array_search(min($bussMap),$bussMap);
return;