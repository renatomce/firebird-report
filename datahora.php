<!DOCTYPE html5>
	<html>
    <title>Relatorio de Vendas por Horario</title>
    <div style="overflow-x:auto;">
    <head>
	<link rel="stylesheet" href="styles.css">
	<div class="topo">
	<p class="topo">Exportar: <button class="button" id="pdf">PDF</button>
			<a download="Vendas - Total por Produto-Hora.csv" class="button" href ="#" 
			onclick="return ExcellentExport.csv(this, 'tabela');">CSV</a>
			<a download="Vendas - Total por Produto-Hora.xls" class="button" href ="#" 
			onclick="return ExcellentExport.excel(this, 'tabela','Vendas - Total por Produto-Hora');">EXCEL</a>
			<a href="index.php" class="button return">Retornar</a>
	</p>
    <p class="topo">Ordenar: <button class="button" onclick="sortTableAlfa()">Nome</button>
        <button class="button" onclick="sortTableQtde()">Quantidade</button>
		<button class="button" onclick="sortTableValor()">Valor Total</button>
		
    </p>
    </div>
    </head>
    <body>

<?php

require_once("config/config.php");
require_once("geradores/query-datahora.php");

function geraTabela($array) { 
	
    $dhInicial = new DateTime($_GET['dhInicial']);
	$dhFinal = new DateTime($_GET['dhFinal']);
	$html = '';
    $html .= '<table id="tabela">';
    $html .= '<th colspan="3" class="cab">VENDAS - TOTAL POR PRODUTO/HORA | ENTRE OS DIAS '.$dhInicial->format('d/m/Y').' 
    E '.$dhFinal->format('d/m/Y').', DAS
    '.$dhInicial->format('H:i').'hrs AS '.$dhFinal->format('H:i').'hrs</th>';
    
    $html .= '<tr>';
    foreach($array[0] as $key=>$value) {
        $html .= '<th>' .$key. '</th>';
    }
    $html .= '</tr>';

    foreach($array as $key=>$value) {
        $html .= '<tr>';
        foreach($value as $key2=>$value2) {
            if($key2 === 'NOME DO PRODUTO') {
                $html .= '<td class="name">' .$value2.'</td>';
            } else if($key2 === 'QUANTIDADE') {
                $html .= '<td class="qtde">' .$value2.'</td>';
            } else if($key2 === 'VALOR TOTAL') {
                $html .= '<td class="vlr">'.$value2.'</td>';
            }
        }
	}
    $html .= '</tr>
    <tr id="total">
    <td>TOTAIS</td>
    <td id="quantidade"></td>
    <td id="valortotal"></td>
    </tr>
	</table>
	</div>
	</body>
	</html>';

    return $html;
}

$pagina = geraTabela($retornoQuery);
echo $pagina;

?>
<footer><p class="rodape" style="float: left;">Relatorios Gerenciais</p>
<p class="rodape" style="float: right;">Easy Sistemas</p>

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.22/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
<script type="text/javascript" src="scripts/geraPDF.js"></script>
<script type="text/javascript" src="scripts/excellentexport.js"></script>
<!--<script type="text/javascript" src="scripts/geraCSV.js"></script>-->
<script type="text/javascript" src="scripts/somaQtde.js"></script>
<script type="text/javascript" src="scripts/somaVlr.js"></script>
<script type="text/javascript" src="scripts/sortTableAlfa.js"></script>
<script type="text/javascript" src="scripts/sortTableQtde.js"></script>
<script type="text/javascript" src="scripts/sortTableValor.js"></script>
<script>
	window.onLoad = somaQtde();
	window.onLoad = somaVlr();
</script>