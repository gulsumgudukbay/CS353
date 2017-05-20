<?php
  header('Content-Type: text/html; charset=utf-8');
  define('DB_SERVER', 'dijkstra2.ug.bcc.bilkent.edu.tr');
  define('DB_USERNAME', 'gulsum.gudukbay');
  define('DB_PASSWORD', 'ibdb8y1ir');
  define('DB_DATABASE', 'test');
  $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
?>
