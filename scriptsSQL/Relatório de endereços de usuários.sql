#Relatório com dados de endereços de todos vínculos de uma uma determinada relação de cálculo. 
SELECT
	vb.data_cancelamento as vinculo_cancelamento,
	cb.data_cancelamento as contratao_cancelamento,
	cal.relacao as relacao,
	cal.id_contrato AS contrato,
	cal.id_vinculo AS vinculo,
	cal.codigo_beneficiario AS codigo,
	cal.nome_beneficiario AS nome,
	IF(ISNULL(gp.grau), 'Titular', gp.grau) as parentesco,
	op.nome,
	ben.endereco1,
	ben.numero1,
	ben.complemento1,
	ben.bairro1,
	ben.municipio1,
	ben.uf1,
	ben.cep1
FROM
	`calculo` as cal
LEFT JOIN grau_parentesco as gp on gp.codigo = cal.parentesco
LEFT JOIN vinculo_beneficiarios as vb on vb.id = cal.id_vinculo
LEFT JOIN contratos_beneficiarios as cb on cal.id_contrato = cb.id
LEFT JOIN operadores as op on op.id = cb.responsavel_contrato
LEFT JOIN beneficiarios2 as ben on ben.codigo_beneficiario = cal.codigo_beneficiario
WHERE
	cal.id is not null
	#and (vb.data_cancelamento = '0000-00-00' or vb.data_cancelamento > NOW())
	and relacao = '01/2019'
	#and (cb.data_cancelamento = '0000-00-00' or cb.data_cancelamento > NOW())
GROUP BY vb.id