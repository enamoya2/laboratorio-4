<?php
$mysqli =mysqli_connect("mysql.hostinger.es","u875296919_root","rootena","u875296919_usu") or die(mysql_error()); //hostinger
//$mysqli = mysqli_connect("localhost", "root", "", "quiz");  //local
if (!$mysqli) {
  echo "Fallo al conectar a MySQL: " . $mysqli->connect_error;
  exit;
}
$usuarios = mysqli_query($mysqli, "select * from usuario");
echo '<table border=1> <tr> <th> NOMBRE </th> <th> EMAIL </th> <th> TELEFONO </th> <th> ESPECIALIDAD </th> <th> INTERESES </th> <th> FOTO </th></tr>';
while ($row = mysqli_fetch_array( $usuarios )) {
  echo '<tr><td>' . $row['Nombre'] .'</td><td>' . $row['Email'] . '</td> <td>' . $row['Telefono'] . '</td> <td>' . $row['Especialidad'] . '</td><td>' . $row['Intereses'] . '</td> <td>' . '<img id="output" width="150px" src="' . $row['Foto'] . '"/>' . '</td></tr>';
}
echo '</table>';
$usuarios->close();
mysqli_close($mysqli);
?>
