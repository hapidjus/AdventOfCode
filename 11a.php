<?php
include "helpers.php";
CONST EMPTY_SEAT = 'L';
CONST TAKEN_SEAT = '#';
$input = file('inputs/11a.txt', FILE_IGNORE_NEW_LINES);
$board = array_map('str_split', $input);

while($board != $newBoard = processBoard($board)){
	$board = $newBoard;
}

echo substr_count(json_encode($board), TAKEN_SEAT);
return;

function processBoard($board){
	$newBoard = $board;
	foreach ($board as $x => $line){
		foreach ($line as $y => $char){
			if($char == EMPTY_SEAT && countTakenAdjacentSeats($x, $y, $board) == 0){
				$newBoard[$x][$y] = TAKEN_SEAT;
			}elseif($char == TAKEN_SEAT && countTakenAdjacentSeats($x, $y, $board) > 3){
				$newBoard[$x][$y] = EMPTY_SEAT;
			}
		}
	}
	return $newBoard;
}

function countTakenAdjacentSeats($x, $y, $board){
	$count = 0;
	$seats = [[0,1],[1,0],[1,1],[-1,0],[0,-1],[-1,-1],[1,-1],[-1,1]];
	foreach ($seats as $seat){
		$count += isset($board[$x + $seat[0]][$y + $seat[1]]) ? $board[$x + $seat[0]][$y + $seat[1]] == TAKEN_SEAT : 0;
	}
	return $count;
}
