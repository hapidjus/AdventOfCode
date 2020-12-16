<?php
$input = [6,19,0,5,7,13,1];
$lastDigit = $input[count($input)-1];
foreach ($input as $key => $in){
	$lastPos[$in] = $key;
}
$cache = [end($input), count($input) - 1];
array_pop($lastPos);
while(30000000 != $i = count($input)){
	if(isset($lastPos[$lastDigit])){
		$input[] = $lastDigit = $i - $lastPos[$lastDigit] - 1;
	}else{
		$input[] = $lastDigit = 0;
	}
	$lastPos[$cache[0]] = $cache[1];
	$cache = [$lastDigit, $i];
}

echo array_pop($input);
return;
