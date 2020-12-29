<?php
$input = file_get_contents('inputs/16a.txt');
[$validation,$myTicket, $tickets] = explode(PHP_EOL.PHP_EOL, $input);
$answer = [];
$myTicket = explode(',', substr($myTicket, 14));
$tickets = explode(PHP_EOL,$tickets);
array_shift($tickets);

foreach(explode(PHP_EOL, $validation) as $rule){
	preg_match('/.+: ([\d]+)-([\d]+) or ([\d]+)-([\d]+)/', $rule, $rules[]);
}

foreach($tickets as $key => $ticket){
	foreach(explode(',',$ticket) as $field){
		foreach($rules as $value) {
			if(($field >= $value[1] && $field <= $value[2]) || ($field >= $value[3] && $field <= $value[4])){
				continue 2;
			}
		}
		unset($tickets[$key]);
	}
}

$fieldPermutations = array_fill(0, count($rules), array_fill(0, count($rules), 'O'));

foreach($rules as $ruleKey => $rule){
	foreach($rules as $fieldKey => $field){
		foreach($tickets as $ticketKey => $ticket){
			$testField = explode(',',$ticket)[$fieldKey];
			if(!($testField >= $rule[1] && $testField <= $rule[2]) && !($testField >= $rule[3] && $testField <= $rule[4])) {
				$fieldPermutations[$ruleKey][$fieldKey] = 'X';
				continue 2;
			}
		}
	}
}
while(true){
	foreach($fieldPermutations as $ruleKey => $fieldKeys){
		$fieldKeys = implode($fieldKeys);
		if(substr_count($fieldKeys, 'O') == 1){
			$position = strpos($fieldKeys, 'O');
			if($ruleKey < 6){
				$answer[$ruleKey] = $position;
			}
			foreach($fieldPermutations as &$fieldPermutation){
				$fieldPermutation[$position] = 'X';
			}
		}
	}
	if(count($answer) == 6){
		break;
	}
}

echo $myTicket[$answer[0]]
	* $myTicket[$answer[1]]
	* $myTicket[$answer[2]]
	* $myTicket[$answer[3]]
	* $myTicket[$answer[4]]
	* $myTicket[$answer[5]];
return;