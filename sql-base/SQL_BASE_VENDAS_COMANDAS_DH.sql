SELECT C.nome, SUM(A.qtdade) AS QUANTIDADE, SUM(A.vlr_total) AS TOTAL FROM res_comandas_itens A
    INNER JOIN est_produtos C ON A.id_produto = C.id
    INNER JOIN res_comandas_movtos B ON A.id_movto = B.id
    WHERE A.dh_emissao >= '01.01.2019 10:00' AND A.dh_emissao <=  '30.01.2019 23:00'
    AND A.cancelado = 'N' AND B.cancelado = 'N' AND B.fechado = 'S' GROUP BY A.id_produto, C.nome, D.nome;
