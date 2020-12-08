<?php
$input = file('inputs/7a.txt', FILE_IGNORE_NEW_LINES);

foreach($parentArray = transformInput($input) as $parent => $children){
	foreach(childrenContains('shiny gold', $children, $parentArray, $parent) as $val){
		$answer[$val] = true;
	}
}
echo count($answer);

function childrenContains($searchFor, $searchArray, $allItems, $parent){
	foreach($searchArray as $item){
		if($item == $searchFor){
			yield $parent;
		}
		if(isset($allItems[$item])){
			yield from childrenContains($searchFor, $allItems[$item], $allItems, $parent);
		}
	}
}

function transformInput($input){
	foreach($input as $line){
		$match = preg_split('/ bags contain |(bag|bags). | (bag,|bags,) | (bag|bags).$/', $line, -1, PREG_SPLIT_NO_EMPTY);
		$parent = array_shift($match);
		foreach($match as $m){
			$returnArray[$parent][] = substr($m,2);
		}
	}
	return $returnArray;
}
