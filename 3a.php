<?php
$input = file('inputs/3a.txt', FILE_IGNORE_NEW_LINES);
$iteration = 0;

$answer = count(array_filter($input, function($line) use (&$iteration){
	return ($line[($iteration++ * 3) % strlen($line)] == '#');
}));

echo $answer;
return;