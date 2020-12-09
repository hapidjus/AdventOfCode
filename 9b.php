<?php
$input = file('inputs/9a.txt', FILE_IGNORE_NEW_LINES);
$i = 0;
while(!$answer = testConsecutiveNumbers('731031916', $i, $input)){
	$i++;
}
echo $answer;
return;

function testConsecutiveNumbers($searchFor, $offset, $input){
	$sum = 0;
	while($sum < $searchFor){
		$sum += $products[] = $input[$offset++];
	}
	if($sum == $searchFor){
		return min($products) + max($products);
	}
}
