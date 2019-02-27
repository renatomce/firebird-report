<?php

require_once("config/config.php");

$dhInicial = new DateTime($_GET['dhInicial']);
$dhFinal = new DateTime($_GET['dhFinal']);
$moduloVenda = $_GET['modulo'];
$sql2 = "";
$sql3 = "";
$sql4 = " AND A.cancelado = 'N' AND B.cancelado = 'N' AND B.fechado = 'S' GROUP BY A.id_produto, C.nome;";

if($moduloVenda === 'mesas' || $moduloVenda === 'delivery') {
	$campoDataEmissao = "dt_emissao";
} else {
	$campoDataEmissao = "dh_emissao";
}

if($moduloVenda === 'balcao') {
	$sql1 = "SELECT C.nome, SUM(A.qtdade), SUM(A.vlr_total) FROM res_vendas_itens A
	INNER JOIN est_produtos C ON A.id_produto = C.id
	INNER JOIN res_vendas B ON A.id_venda = B.id ";
} else if($moduloVenda === 'comandas') {
	$sql1 = "SELECT C.nome, SUM(A.qtdade), SUM(A.vlr_total) FROM res_comandas_itens A
    INNER JOIN est_produtos C ON A.id_produto = C.id
    INNER JOIN res_comandas_movtos B ON A.id_movto = B.id ";
} else if($moduloVenda === 'mesas') {
	$sql1 = "SELECT C.nome, SUM(A.qtdade), SUM(A.vlr_total) FROM res_mesas_itens A
    INNER JOIN est_produtos C ON A.id_produto = C.id
	INNER JOIN res_mesas_movtos B ON A.id_movto = B.id ";
} else if($moduloVenda === 'delivery') {
	$sql1 = "SELECT C.nome, SUM(A.qtdade), SUM(A.vlr_total) FROM del_pedidos_itens A
    INNER JOIN est_produtos C ON A.id_produto = C.id
	INNER JOIN del_pedidos B ON A.id_pedido = B.id ";
}

function contaDias($dhInicial, $dhFinal) {
    $dias = $dhInicial->diff($dhFinal);
    return $dias->format('%a');
}

function geraSQL($sql2, $sql3, $campoDataEmissao) {

    $dhInicial = new DateTime($_GET['dhInicial']);
    $dhFinal = new DateTime($_GET['dhFinal']);
    $result1 = $dhInicial->format('d.m.Y');
    $result3 = $dhInicial->format('H:i');
    $result2 = $dhFinal->format('H:i');
    $sql2 = "WHERE A.".$campoDataEmissao." >= '".$result1." ".$result3."' AND A.".$campoDataEmissao." <= '".$result1." ".$result2."' ";
    $controle = contaDias($dhInicial, $dhFinal);

    while($controle != 0) {
        $dhInicial->add(new DateInterval('P1D'));
        $result1 = $dhInicial->format('d.m.Y');
        $dhFinal->add(new DateInterval('P1D'));
        $result2 = $dhFinal->format('H:i');
        $sql3 .= " OR A.".$campoDataEmissao." >= '".$result1." ".$result3."' AND A.".$campoDataEmissao." <= '".$result1." ".$result2."'";
        $controle--;
    }
	return $sql2.$sql3;
}

function interbase_sql_exec ($query) { 
	
	include('config/config.php');
    $dataArr = array();
    $connection = ibase_connect($database, $username, $password, 'ISO8859_1', '100', '1');
    $rid = @ibase_query ($connection, $query); 
    if ($rid===false) errorHandle(ibase_errmsg(),$query); 
    $coln = ibase_num_fields($rid);
    $blobFields = array();
    for ($i=0; $i < $coln; $i++) { 
        $col_info = ibase_field_info($rid, $i); 
        if ($col_info["type"]=="BLOB") $blobFields[$i] = $col_info["name"]; 
    } 
    while ($row = ibase_fetch_row ($rid)) { 
        foreach ($blobFields as $field_num=>$field_name) {
            $blobid = ibase_blob_open($row[$field_num]); 
            $row[$field_num] = ibase_blob_get($blobid,102400); 
            ibase_blob_close($blobid); 
        } 
        $dataArr[] = $row;
    }
    ibase_close ($connection); 
    return $dataArr; 
}


$sql3 = geraSQL($sql2, $sql3, $campoDataEmissao);
$query = $sql1.$sql3.$sql4;
$retornoQuery = interbase_sql_exec($query);

array_walk($retornoQuery, function (&$item) {
	$item['NOME DO PRODUTO'] = $item['0'];
	unset($item['0']);
 });

array_walk($retornoQuery, function (&$item) {
	$item['QUANTIDADE'] = $item['1'];
	unset($item['1']);
 });

array_walk($retornoQuery, function (&$item) {
	$item['VALOR TOTAL'] = $item['2'];
	unset($item['2']);
 });

?>