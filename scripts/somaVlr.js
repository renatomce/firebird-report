function somaVlr() {
	var tds = document.getElementById("tabela").getElementsByTagName("td");
	var sum = 0;
	for (var i = 0; i < tds.length; i++) {
		if (tds[i].className == "vlr") {
			sum += isNaN(tds[i].innerHTML) ? 0 : parseFloat(tds[i].innerHTML);
		}
	}
	document.getElementById("valortotal").innerHTML += "RECEITA BRUTA: <strong>R$ " + sum + "</strong>";
}