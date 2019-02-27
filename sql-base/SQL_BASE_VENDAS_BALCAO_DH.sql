SELECT A.nome_produto, SUM(A.qtdade) AS QUANTIDADE, SUM(A.vlr_total) AS TOTAL FROM res_vendas_itens A
    INNER JOIN res_vendas B ON A.id_venda = B.id
    WHERE A.dh_emissao > '05.01.2019 10:00' AND A.dh_emissao <  '05.01.2019 23:00'
AND A.cancelado = 'N' AND B.cancelado = 'N' AND B.fechado = 'S' GROUP BY nome_produto;
