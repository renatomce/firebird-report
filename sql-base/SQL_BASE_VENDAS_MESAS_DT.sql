SELECT A.nome_produto, SUM(A.qtdade) AS QUANTIDADE, SUM(A.vlr_total) AS TOTAL FROM res_mesas_itens A
    INNER JOIN res_mesas_movtos B ON A.id_movto = B.id
    WHERE A.dt_emissao > '05.01.2019 10:00' AND A.dt_emissao <  '05.01.2019 23:00' AND
    AND A.cancelado = 'N' AND B.cancelado = 'N' AND B.fechado = 'S' GROUP BY nome_produto;
