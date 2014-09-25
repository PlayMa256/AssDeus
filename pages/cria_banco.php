<?php
include "../conf/config.php";
$sql = mysql_query("CREATE TABLE disposicao_membro_alojamento(
    	id int AUTO_INCREMENT PRIMARY KEY,
    	id_alojament int,
    	id_membro int,
    FOREIGN KEY (id_alojamento) REFERENCES alojamentos(id),
    FOREIGN KEY (id_membro) REFERENCES membros(id)

    ") or die(mysql_error());
