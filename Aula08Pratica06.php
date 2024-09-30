<?php

$matriz = array(array('Matematica','5','8.5'), array('Portugues','2','9'), array('Geografia','10','6'), array('Educação fisica','2','8'));

?>
<html>
<table border="1 px">
  <tr>
    <th>Diciplina</throw>
    <th>Faltas</th>
    <th>Media</th>
  </tr>
  <tr>
    <td><?php print($matriz[0][0]) ?></td>
    <td><?php print($matriz[0][1]) ?></td>
    <td><?php print($matriz[0][2]) ?></td>
  </tr>
  <tr>
    <td><?php print($matriz[1][0]) ?></td>
    <td><?php print($matriz[1][1]) ?></td>
    <td><?php print($matriz[1][2]) ?></td>
  </tr>
  <tr>
    <td><?php print($matriz[2][0]) ?></td>
    <td><?php print($matriz[2][1]) ?></td>
    <td><?php print($matriz[2][2]) ?></td>
  </tr>
  <tr>
    <td><?php print($matriz[3][0]) ?></td>
    <td><?php print($matriz[3][1]) ?></td>
    <td><?php print($matriz[3][2]) ?></td>
  </tr>
</table>
</html>


