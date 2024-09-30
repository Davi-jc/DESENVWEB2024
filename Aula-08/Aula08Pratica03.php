<?php

$salario1 = 1000; 
$salario2 = 2000;

$salario2 = $salario1;
$salario2++;

$salario1 *= 1.1;

if ($salario1 > $salario2){
    print("O Salario1 = ".$salario1." é maior que o salario2 = ".$salario2);
}
else if($salario2 > $salario1){
    print("O Salario2 = ".$salario2." é maior que o salario1 = ".$salario1);
}
else {
   print("O Salario1 = ".$salario1." é igual ao valor  do salario2 = ".$salario2);
}

?>
