<?php
function format_data($data){

	$explode = explode("-", $data);
	$dia = $explode[0];
	$mes = $explode[1];
	$ano = $explode[2];

	$newData = "$ano-$mes-$dia";
	
	return $newData;
}


function format_data_Normal($data){
		$explode = explode("-", $data);
	$dia = $explode[2];
	$mes = $explode[1];
	$ano = $explode[0];

	$newData = "$dia-$mes-$ano";
	
	return $newData;

}