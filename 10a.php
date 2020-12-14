<?php
$input = file('inputs/10a.txt', FILE_IGNORE_NEW_LINES);
$oneJump = 0;
$threeJump = 1;
$last = 0;
sort($input);

while($input){
	if($input[0] - $last == 3){
		$threeJump++;
	}else{
		$oneJump++;
	}
	$last = array_shift($input);
}
echo $threeJump * $oneJump;
return;
