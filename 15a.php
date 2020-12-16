<?php
$input = array_reverse([6, 19, 0, 5, 7, 13, 1]);

while(count($input) != 2020){
	$lastDigit = array_shift($input);
	if(!in_array($lastDigit, $input)){
		array_unshift($input, 0,$lastDigit);
	}else{
		$stepsback = array_search($lastDigit,$input);
		array_unshift($input, $lastDigit);
		array_unshift($input, $stepsback+1);
	}
}
echo $input[0];
return;