<?php
$input = file_get_contents('inputs/6a.txt', FILE_IGNORE_NEW_LINES);
$answer = array_sum(
	array_map(
		function($item){
			return strlen(count_chars(preg_replace("/\s+/", "", $item),3));
		},
		explode(PHP_EOL . PHP_EOL, $input),
	)
);
echo $answer;
return;