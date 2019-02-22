function somaQtde() {
	var tds = document.getElementById("tabela").getElementsByTagName("td");
	var sum = 0;
	for (var i = 0; i < tds.length; i++) {
		if (tds[i].className == "qtde") {
			sum += isNaN(tds[i].innerHTML) ? 0 : parseFloat(tds[i].innerHTML);
		}
	}
	document.getElementById("quantidade").innerHTML += "PRODUTOS VENDIDOS: <strong>" + sum + "</strong>";
}