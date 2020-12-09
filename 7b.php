<?php
$input = file('inputs/7a.txt', FILE_IGNORE_NEW_LINES);
$count = 0;

foreach(recursiveCount('shiny gold', transformInput($input), 1) as $val){
	$count = $count < $val ? $val : $count;
}
echo $count;
return;

function transformInput($input){
	foreach($input as $line){
		$match = preg_split('/ bags contain |(bag|bags). | (bag,|bags,) | (bag|bags).$/', $line, -1, PREG_SPLIT_NO_EMPTY);
		$parent = array_shift($match);
		foreach($match as $m){
			if(is_numeric($times = substr($m,0,1))){
				$returnArray[$parent][] = [substr($m,2), $times];
			}
		}
	}
	return $returnArray;
}

function recursiveCount($search, $childrenArray, $times){
	static $count = 0;
	if(!isset($childrenArray[$search])) {
		yield $count;
		return;
	}

	foreach ($childrenArray[$search] as $child){
		$count += ($child[1] * $times);
		yield from recursiveCount($child[0], $childrenArray, $child[1] * $times);
	}
}
