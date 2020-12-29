<?php
$input = file_get_contents('inputs/16a.txt');
[$validation,$myTicket, $tickets] = explode(PHP_EOL.PHP_EOL, $input);
$tickets = explode(PHP_EOL,$tickets);
array_shift($tickets);
$invalidSum = 0;

foreach(explode(PHP_EOL, $validation) as $rule){
	preg_match('/.+: ([\d]+)-([\d]+) or ([\d]+)-([\d]+)/', $rule, $rules[]);
}

foreach($tickets as $ticket){
	foreach(explode(',',$ticket) as $field){
		foreach($rules as $value) {
			if(($field >= $value[1] && $field <= $value[2]) || ($field >= $value[3] && $field <= $value[4])){
				continue 2;
			}
		}
		$invalidSum+= $field;
	}
}
echo $invalidSum;
return;
