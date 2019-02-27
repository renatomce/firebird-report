SELECT A.nome_produto, SUM(A.qtdade) AS QUANTIDADE, SUM(A.vlr_total) AS TOTAL FROM del_pedidos_itens A
    INNER JOIN del_pedidos B ON A.id_pedido = B.id
    WHERE B.dt_emissao > '05.01.2019 10:00' AND B.dt_emissao <  '05.01.2019 23:00' AND
    AND A.cancelado = 'N' AND B.cancelado = 'N' AND B.fechado = 'S' GROUP BY nome_produto;
