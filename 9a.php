<?php
include "helpers.php";
$input = file('inputs/9a.txt', FILE_IGNORE_NEW_LINES);
$preamble = array_splice($input, 0, 25);

while(canBeSumOfTwoTerms(current($input), $preamble)){
	array_shift($preamble);
	$preamble[] = array_shift($input);
}
echo current($input);
return;

function canBeSumOfTwoTerms($sum, $terms){
	$total = array_fill_keys($terms, true);
	foreach ($terms as $term) {
		if (isset($total[$sum - $term])) {
			return true;
		}
	}
	return false;
}
