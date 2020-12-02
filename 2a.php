<?php
$input = file('inputs/2a.txt');
$count = 0;

foreach($input as $line){
	list($minMax, $letter, $pass) = explode(' ', $line);
	list($min, $max) = explode('-', $minMax);
	$occurrences = substr_count($pass, $letter[0]);
	if($occurrences >= $min && $occurrences <= $max){
		$count++;
	}
}
echo $count;
return;
