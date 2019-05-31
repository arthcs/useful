SELECT
	cli.nome,
	SEC_TO_TIME(sum(TIME_TO_SEC(TIMEDIFF(ses.hora_inicial,ses.hora_final)))) as utilizado
FROM
	`tb_sessao` as ses
LEFT JOIN tb_solicitacao as sol on sol.id = ses.id_solicitacao
LEFT JOIN tb_clientes as cli on cli.id = sol.id_cliente
WHERE
	ses.id is not NULL
GROUP BY sol.id_cliente