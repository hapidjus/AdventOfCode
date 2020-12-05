<?php
$input = file_get_contents('inputs/4a.txt', FILE_IGNORE_NEW_LINES);
$fields = ['byr', 'iyr', 'eyr', 'hgt', 'hcl', 'ecl', 'pid'];
$regex = '/(?=.*' . implode(':)(?=.*', $fields) . ':)/';

$answer = array_reduce(
	explode(PHP_EOL . PHP_EOL, $input),
	function($carry, $line) use ($regex) {
		return $carry += null !== preg_filter(
				$regex,
				'',
				str_replace(PHP_EOL, '', $line)
			);
	}
);

echo $answer;
return;
