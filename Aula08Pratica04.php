<?php

$salario1 = 1000; 
$salario2 = 2000;

$salario2 = $salario1;
$salario2++;

$salario1 *= 1.1;

$i = 1;
while($i < 100){
    $i++;
    $salario1++;
    if ($i == 50){
        break;
    }
}

if ($salario1 < $salario2){
    print("O valor do salario1 é ".$salario1);
}
?>