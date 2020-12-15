<?php
$input = file('inputs/12a.txt', FILE_IGNORE_NEW_LINES);
$x = $y = 0;
$wX = 10;
$wY = -1;

array_walk($input, function($item) use (&$x, &$y, &$wX, &$wY){
	$value = substr($item,1);
	if('F' == $instruction = substr($item,0,1)){
		$x += $wX * $value;
		$y += $wY * $value;
	}elseif(in_array($instruction, ['N', 'S', 'W', 'E'])) {
		$wX += moveWaypoint($instruction, $value)[0];
		$wY += moveWaypoint($instruction, $value)[1];
	}else{
		list($wX, $wY) = turnWaypointBy($wX, $wY, $instruction, $value);
	}
});

echo abs($y) + abs($x);
return;

function turnWaypointBy($x, $y, $direction, $degrees){
	do{
		if($direction == 'R'){
			list($y,$x) = [$x, $y * -1];
		}else{
			list($x,$y) = [$y, $x * -1];
		}
	}while($degrees -= 90);

	return [$x, $y];
}

function moveWaypoint($direction, $val){
	$lookupArray = ['N' => '$y=-', 'S' => '$y=', 'W' => '$x=-', 'E' => '$x='];
	eval($lookupArray[$direction] . $val . ';');
	return array($x ?? 0, $y ?? 0);
}
