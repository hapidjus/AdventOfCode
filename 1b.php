<?php
$input = file('inputs/1a.txt');

foreach($input as $index1 => $line1){
	foreach($input as $index2 => $line2){
		foreach($input as $index3 => $line3){
			if(2020 == (int)$line1 + (int)$line2 + (int)$line3){
				echo (int)$line1 * (int)$line2 * (int)$line3;
				return;
			}
        }
    }
}
