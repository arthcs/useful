SELECT
	sol.data_abertura,
	sol.hora,
	sol.estimativa,
	prioridade.descricao as prioridade,
	usu_sol.nome as responsavel,
	cli.nome as cliente,
	sis.descricao as sistema,
	-- cli.descricao as tipo_cliente,
	emp.nome as empresa,
	sol.entregue,
	
	SEC_TO_TIME(sum(TIME_TO_SEC(TIMEDIFF(hora_inicial,hora_final)))) as temp_da_sessao,
	
	usu_ses.nome as trabalhou,
	sts_ses.descricao as status,
	ses.data_realizacao,
	ses.hora_inicial,
	ses.hora_final
FROM
	`tb_sessao` as ses
LEFT JOIN tb_solicitacao as sol on ses.id_solicitacao = sol.id
LEFT JOIN tb_dom_tipo_prioridade as prioridade on sol.prioridade = prioridade.id
LEFT JOIN tb_usuarios as usu_ses on ses.id_programador = usu_ses.id
LEFT JOIN tb_usuarios as usu_sol on sol.id_responsavel = usu_sol.id
LEFT JOIN tb_sistemas as sis on sol.id_sistema = sis.id
-- LEFT JOIN tb_dom_tipo_cliente as tipo_cli on sol.id_cliente = cli.id
LEFT JOIN tb_empresas as emp on sol.id_empresa = emp.id
LEFT JOIN tb_dom_sessao_status as sts_ses on ses.id_sessao_status = sts_ses.id
LEFT JOIN tb_clientes as cli on sol.id_cliente = cli.id
WHERE
	sol.id_cliente = '1' AND
	sol.id_responsavel = '2' AND
	sol.id_sistema = '1' AND
	sol.data_abertura BETWEEN '2019-05-01' AND '2019-05-30';


#	versão 2

SELECT
	sol.data_abertura,
	sol.hora,
	sol.estimativa,
	prioridade.descricao as prioridade,
	usu_sol.nome as responsavel,
	cli.nome as cliente,
	sis.descricao as sistema,
	emp.nome as empresa,
	sol.entregue,
	usu_ses.nome as trabalhou,
	sts_ses.descricao as status,
	ses.data_realizacao,
	ses.hora_inicial,
	ses.hora_final,
	sol.id
FROM
	`tb_sessao` as ses
LEFT JOIN tb_solicitacao as sol on ses.id_solicitacao = sol.id
LEFT JOIN tb_dom_tipo_prioridade as prioridade on sol.prioridade = prioridade.id
LEFT JOIN tb_usuarios as usu_ses on ses.id_programador = usu_ses.id
LEFT JOIN tb_usuarios as usu_sol on sol.id_responsavel = usu_sol.id
LEFT JOIN tb_sistemas as sis on sol.id_sistema = sis.id
LEFT JOIN tb_empresas as emp on sol.id_empresa = emp.id
LEFT JOIN tb_dom_sessao_status as sts_ses on ses.id_sessao_status = sts_ses.id
LEFT JOIN tb_clientes as cli on sol.id_cliente = cli.id
WHERE
	sol.data_abertura BETWEEN '2019-05-01' AND '2019-05-30';