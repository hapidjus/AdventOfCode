<?php
$input = file('inputs/3a.txt', FILE_IGNORE_NEW_LINES);
$movePatterns = [[1, 1], [3, 1], [5, 1], [7, 1], [1, 2]];

$answer = array_reduce($movePatterns, function ($carry, $moves) use ($input) {
	$iteration = 0;
	return $carry *= count(array_filter($input, function ($line) use (&$iteration, $moves) {
		if ($iteration++ % $moves[1] !== 0) {
			return false;
		}
		return $line[((($iteration - 1) * $moves[0]) / $moves[1]) % strlen($line)] == '#';
	}));
}, 1);

echo $answer;
return;
