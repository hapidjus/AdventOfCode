<?php
const EMPTY_SEAT = 'L';
const TAKEN_SEAT = '#';
$input = file('inputs/11b.txt', FILE_IGNORE_NEW_LINES);
$board = array_map('str_split', $input);

while($board != $newBoard = processBoard($board)){
	$board = $newBoard;
}

echo substr_count(json_encode($board), TAKEN_SEAT);
return;

function processBoard($board){
	$newBoard = $board;
	foreach($board as $x => $line){
		foreach($line as $y => $char){
			if($char == EMPTY_SEAT && countTakenAdjacentSeats($x, $y, $board) == 0){
				$newBoard[$x][$y] = TAKEN_SEAT;
			}elseif($char == TAKEN_SEAT && countTakenAdjacentSeats($x, $y, $board) > 4){
				$newBoard[$x][$y] = EMPTY_SEAT;
			}
		}
	}
	return $newBoard;
}

function countTakenAdjacentSeats($x, $y, $board){
	$count = 0;
	$seats = [[0, 1], [1, 0], [1, 1], [-1, 0], [0, -1], [-1, -1], [1, -1], [-1, 1]];
	foreach($seats as $seat){
		$distance = 1;
		while(isset($board[$x + $seat[0] * $distance][$y + $seat[1] * $distance])) {
			if($board[$x + $seat[0] * $distance][$y + $seat[1] * $distance] == EMPTY_SEAT){
				break;
			}
			if($board[$x + $seat[0] * $distance][$y + $seat[1] * $distance] == TAKEN_SEAT){
				$count++;
				break;
			}
			$distance++;
		}
	}
	return $count;
}
