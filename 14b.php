<?php
$input = file('inputs/14a.txt', FILE_IGNORE_NEW_LINES);

array_walk($input, function($instruction) use (&$mem, &$mask){
	if(substr($instruction, 0,4) == 'mask'){
		$mask = str_replace('mask = ', '', $instruction);
		return;
	}

	preg_match('/mem\[([^]]*)] = (\d+)/', $instruction, $output_array);
	[,$address,$value] = $output_array;
	$address = str_pad(decbin($address), 36,'0',STR_PAD_LEFT );
	$maskedAddress = mask(array_filter(str_split($mask), fn($item) => $item !== '0'), $address);
	foreach(expandMaskedAddress($maskedAddress) as $expandedAddress){
		$mem[$expandedAddress] = $value;
	}

});
echo array_sum($mem);
return;

function expandMaskedAddress($address){
	if(false === $xpos = strpos($address,'X')){
		yield bindec($address);
		return;
	}
	yield from expandMaskedAddress(substr_replace($address,1, $xpos, 1));
	yield from expandMaskedAddress(substr_replace($address,0, $xpos, 1));
}

function mask($mask, $value){
	foreach ($mask as $maskKey => $maskVal){
		$value[$maskKey] = $maskVal;
	}
	return $value;
}
