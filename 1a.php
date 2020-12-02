<?php
$input = file('inputs/1a.txt');

foreach($input as $index1 => $line1){
	foreach($input as $index2 => $line2){
        if($index1 !== $index2){
            if(2020 == (int)$line1 + (int)$line2){
                echo (int)$line1 * (int)$line2;
                return;
            }
        }
    }
}
