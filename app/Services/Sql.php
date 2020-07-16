<?php

$sql = new mysqli("localhost", "root");

if ($sql->connect_errno) {
  echo "Failed to connect to MySQL: ".$mysqli->connect_error;
  exit();
}

return $sql;

?>
