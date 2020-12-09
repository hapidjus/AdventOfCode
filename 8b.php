<?php
$input = file('inputs/8a.txt', FILE_IGNORE_NEW_LINES);
$i = 0;

while(!$val = processInstruction(0,$input, 0, [], $i, 0)){
	$i++;
}
echo $val;
return;

function processInstruction($instruction, $input, $counter, $visited, $switchNo, $switchCount){
	if(!isset($input[$instruction])){
		return $counter;
	}

	if(in_array($instruction, $visited)){
		return false;
	}

	$visited[] = $instruction;
	list($type, $value) = explode(' ',$input[$instruction]);

	if(in_array($type, ['nop', 'jmp'])){
		if($switchNo == $switchCount){
			$type = $type == 'nop' ? 'jmp' : 'nop';
		}
		$switchCount++;
	}

	switch($type){
		case 'acc':
			$counter += $value;
		case 'nop':
			return processInstruction($instruction + 1, $input, $counter, $visited, $switchNo, $switchCount);
		case 'jmp':
			return processInstruction($instruction + $value, $input, $counter, $visited, $switchNo, $switchCount);
	}
}