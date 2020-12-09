<?php
$input = file('inputs/8a.txt', FILE_IGNORE_NEW_LINES);
echo processInstruction(0, $input, 0, []);
return;

function processInstruction($instruction, $input){
	static $visited = [];
	static $counter = 0;
	if (in_array($instruction, $visited)) {
		return $counter;
	}

	$visited[] = $instruction;
	list($type, $value) = explode(' ', $input[$instruction]);

	switch ($type) {
		case 'acc':
			$counter += $value;
		case 'nop':
			return processInstruction($instruction + 1, $input);
		case 'jmp':
			return processInstruction($instruction + $value, $input);

	}
}
