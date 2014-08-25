<?php
$id = $_POST['id'];
$sql = mysql_query("SELECT vagas FROM alojamentos WHERE id = '$id'");
$res = mysql_fetch_array($sql);
echo $res['vagas'];