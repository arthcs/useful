Querys importantes

#1.1.0.0.0.0.0.0.1, 1.1.0.0.0.0.0.0.2 e 1.1.0.0.0.0.0.0.3.
#Relação - Contrato - Nome - Valor Contribuição
SELECT
	relacao, id_contrato, beneficiarios2.nome, valor
FROM
	lancamentos_geral
LEFT JOIN beneficiarios2 on (beneficiarios2.codigo_beneficiario = lancamentos_geral.id_beneficiario)
WHERE
	(
		data_lancamento BETWEEN '2018-01-01'
		AND '2018-02-01'
	)
AND codigo_plano_contas in ('1.1.0.0.0.0.0.0.1', '1.1.0.0.0.0.0.0.2', '1.1.0.0.0.0.0.0.3')
AND conta_bancaria_contabilizar = '2'
AND excluido is NULL
ORDER BY lancamentos_geral.id_contrato

####################################################################################################

#1.4.0.0.0.0.0.0.4, 1.4.0.0.0.0.0.0.1, 1.4.0.0.0.0.0.0.5 e 1.4.0.0.0.0.0.0.2
#Relação - Contrato - Nome - Valor Coparticipação 
SELECT
	relacao, id_contrato, beneficiarios2.nome, valor
FROM
	lancamentos_geral
LEFT JOIN beneficiarios2 on (beneficiarios2.codigo_beneficiario = lancamentos_geral.id_beneficiario)
WHERE
	(
		data_lancamento BETWEEN '2018-01-01'
		AND '2018-02-01'
	)
AND codigo_plano_contas in ('1.4.0.0.0.0.0.0.4', '1.4.0.0.0.0.0.0.1', '1.4.0.0.0.0.0.0.5', '1.4.0.0.0.0.0.0.2')
AND conta_bancaria_contabilizar = '2'
AND excluido is NULL
ORDER BY lancamentos_geral.id_contrato