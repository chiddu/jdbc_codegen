<?php

require_once('util.php');

$ini_list = parse_ini_file($argv[1]);

$dbh = new PDO('mysql:host=localhost;dbname='.$ini_list['dbname'], $ini_list['dbuser'],$ini_list['dbpwd'], array( PDO::ATTR_PERSISTENT => false));

d4($dbh);
$query = "desc ".$argv[2];
d4($query);
$stmt = $dbh->query("desc ".$argv[2]);


$rowlist = $stmt->fetchAll();
d3($rowlist);

