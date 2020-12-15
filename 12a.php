<?php
$input = file('inputs/12a.txt', FILE_IGNORE_NEW_LINES);
$direction = 'E';
$y = 0;
$x = 0;

array_walk($input, function($item) use(&$direction, &$x, &$y){
	$value = substr($item,1);
	if('F' == $instruction = substr($item,0,1)){
		$instruction = $direction;
	}
	if(in_array($instruction ,['F','N','S','W','E'])){
		$x += moveInDirection($instruction, $value)[0];
		$y += moveInDirection($instruction, $value)[1];
		return;
	}
	$direction = turnDirection($direction, $instruction, $value);
});

echo abs($y) + abs($x);
return;

function turnDirection($currentDirection, $leftOrRight, $degrees){
	$turnLookup['L'] = ['N', 'W', 'S', 'E'];
	$turnLookup['R'] = array_reverse($turnLookup['L']);

	return $turnLookup[$leftOrRight][
		(array_search($currentDirection, $turnLookup[$leftOrRight]) + $degrees / 90)
		% count($turnLookup['L'])
	];
}

function moveInDirection($direction, $val){
	$lookupArray = ['N' => '$y=-', 'S' => '$y=', 'W' => '$x=-', 'E' => '$x='];
	eval($lookupArray[$direction] . $val . ';');
	return array($x ?? 0, $y ?? 0);
}
