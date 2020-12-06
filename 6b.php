<?php
$input = file_get_contents('inputs/6a.txt', FILE_IGNORE_NEW_LINES);
$answer = array_sum(
	array_map(
		function($group){
			return count(
				array_intersect(
					range(ord('a'), ord('z')),
					...array_map(
						function($person){
							return array_keys(
								count_chars(
									preg_replace("/\s+/", "", $person),
								1)
							);
						}, explode(PHP_EOL, $group)
					)
				)
			);
		},
		explode(PHP_EOL . PHP_EOL, $input)
	)
);
echo $answer;
return;