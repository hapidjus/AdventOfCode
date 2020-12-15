<?php
$input = file('inputs/14a.txt', FILE_IGNORE_NEW_LINES);
$mem = [];
$mask = '';

array_walk($input, function($instruction) use (&$mem, &$mask){
	if(substr($instruction, 0,4) == 'mask'){
		$mask = str_replace('mask = ', '', $instruction);
		return;
	}
	preg_match('/mem\[([^]]*)] = (\d+)/', $instruction, $output_array);
	$mem[$output_array[1]] = bindec(
		mask(
			array_filter(str_split($mask), fn($item) => $item !== 'X'),
			str_pad(decbin($output_array[2]),36, '0', STR_PAD_LEFT)
		)
	);
});

echo array_sum($mem);
return;

function mask($mask, $value){
	foreach($mask as $maskKey => $maskVal){
		$value[$maskKey] = $maskVal;
	}
	return $value;
}
