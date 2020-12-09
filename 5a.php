<?php
$input = file_get_contents('inputs/5a.txt', FILE_IGNORE_NEW_LINES);
$answer = max(
	array_map(
		function ($line) {
			return getSeatId(($line));
		},
		explode(PHP_EOL, $input)
	)
);
echo $answer;
return;

function getSeatId($input){
	return bsp(substr($input, 0, 7), 0, 127) * 8
		+ bsp(substr($input, 7, 3), 0, 7);
}

function bsp($input, $min, $max){
	if(!strlen($input) || $min === $max) {
		return $min;
	}
	$middle = ($max - $min) / 2;
	if(in_array($input[0], ['F', 'L'])) {
		$max -= floor($middle);
	} else {
		$min += ceil($middle);
	}
	return bsp(substr($input, 1), $min, $max);
}

