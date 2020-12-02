<?php
$input = file('inputs/2a.txt');
$count = 0;

foreach($input as $line){
	list($positions, $letter, $password) = explode(' ', $line);
	list($position_one, $position_two) = explode('-', $positions);
	if($password[$position_one-1] == $letter[0] xor $password[$position_two-1] == $letter[0]){
		$count++;
	}
}
echo $count;
return;
