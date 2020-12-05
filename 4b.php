<?php
$input = file_get_contents('inputs/4a.txt', FILE_IGNORE_NEW_LINES);
$count = 0;
$fields = ['byr', 'iyr', 'eyr', 'hgt', 'hcl', 'ecl', 'pid'];
$regex = '/(?=.*' . implode(':)(?=.*', $fields) . ':)/';

foreach (explode(PHP_EOL . PHP_EOL, $input) as $passport) {
	if (null === preg_filter(
			$regex,
			'',
			str_replace(PHP_EOL, '', $passport)
		)) {
		continue;
	}
	foreach (preg_split("/[\s,]+/", $passport) as $foundField) {
		if (in_array(substr($foundField, 0, 3), $fields)) {
			if (!call_user_func('validate' . ucfirst(substr($foundField, 0, 3)), substr($foundField, 4))) {
				continue 2;
			}
		}
	}
	$count++;

}
echo $count;

function validateByr($i)
{
	return $i >= 1920 && $i <= 2002;
}

function validateIyr($i)
{
	return $i >= 2010 && $i <= 2020;
}

function validateEyr($i)
{
	return $i >= 2020 && $i <= 2030;
}

function validateHgt($i)
{
	return (
		strpos($i, 'in') !== false &&
			(
				str_replace('in', '', $i) >= 59 &&
				str_replace('in', '', $i) <= 76
			)
		) || (
		strpos($i, 'cm') !== false &&
			(
				str_replace('cm', '', $i) >= 150 &&
				str_replace('cm', '', $i) <= 193
			)
		);
}

function validateHcl($i)
{
	return preg_match('/^#[a-f0-9]{6}/', ($i));
}

function validateEcl($i)
{
	return in_array($i, ['amb', 'blu', 'brn', 'gry', 'grn', 'hzl', 'oth']);
}

function validatePid($i)
{
	return preg_match('/^[0-9]{9}$/', $i);
}
