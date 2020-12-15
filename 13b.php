<?php
$input = file('inputs/13a.txt', FILE_IGNORE_NEW_LINES);
$factors = explode(',', $input[1]);
$timestamp = 0;
$add = 1;
$step = 0;

while(true){
	if($factors[$step] == 'x'){
		$step++;
		continue;
	}
	if(($timestamp + $step) % $factors[$step] == 0){
		$add *= $factors[$step];
		$step++;
	}
	if($step == count($factors)){
		break;
	}
	$timestamp+= $add;
}

echo $timestamp;
return;
