<?php
$input = file_get_contents('inputs/5a.txt', FILE_IGNORE_NEW_LINES);

$emptySeats = array_diff(
	range(0, 913),
	array_map(
		function($line) {
			return getSeatId($line);
		},
		explode(PHP_EOL, $input)
	)
);

$answer = current(
	array_filter(
		$emptySeats,
		function($seat) use ($emptySeats) {
			return !isset($emptySeats[$seat + 1]) && !isset($emptySeats[$seat - 1]);
		}
	)
);
echo $answer;
return;

function getSeatId($input)
{
	return bsp(substr($input, 0, 7), 0, 127) * 8
		+ bsp(substr($input, 7, 3), 0, 7);
}

function bsp($input, $min, $max)
{
	if (!strlen($input) || $min === $max) {
		return $min;
	}
	if ($input[0] == 'F' || $input[0] == 'L') {
		$max = intval($max - (($max - $min) / 2));
	} else {
		$min = intval($min + (($max - $min) / 2) + 0.5);
	}
	return bsp(substr($input, 1), $min, $max);
}
