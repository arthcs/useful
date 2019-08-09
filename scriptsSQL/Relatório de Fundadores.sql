SELECT
	c.id as CONTRATO,
	v.id as VINCULO,
	v.codigo_beneficiario as CODIGO,
	b.nome as NOME,
	date_format(c.inicio_contrato, '%d/%m/%Y') as DATA_INGRESSO,
	cbe.funcao as ENTIDADE,
	#c.entidade as ENTIDADE,
	cargo.funcao as CARGO
	#c.cargo as CARGO,
FROM
	`contratos_beneficiarios` as c
LEFT JOIN vinculo_beneficiarios as v ON (c.id = v.id_contrato)
LEFT JOIN beneficiarios2 as b on (v.codigo_beneficiario = b.codigo_beneficiario)
LEFT JOIN contratos_beneficiarios_entidades as cbe on (cbe.id = c.entidade)
LEFT JOIN cargos as cargo on (c.cargo = cargo.cargo)
WHERE
v.grau_parentesco = 'Titular'
and	(c.data_cancelamento = '0000-00-00' or c.data_cancelamento > NOW())
and c.inicio_contrato like '1994%'