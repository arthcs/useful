SELECT
	c.id as CONTRATO,
	v.id as VINCULO,
	v.codigo_beneficiario as CODIGO,
	b.nome as NOME,
	cbe.funcao as ENTIDADE,
	#c.entidade as ENTIDADE,
	cargo.funcao as CARGO,
	#c.cargo as CARGO,
	c.inicio_contrato as DATA_INGRESSO
FROM
	`contratos_beneficiarios` as c
LEFT JOIN vinculo_beneficiarios as v ON (c.id = v.id_contrato)
LEFT JOIN beneficiarios2 as b on (v.codigo_beneficiario = b.codigo_beneficiario)
LEFT JOIN contratos_beneficiarios_entidades as cbe on (cbe.id = c.entidade)
LEFT JOIN cargos as cargo on (c.cargo = cargo.cargo)
WHERE
	c.entidade = 1 and c.cargo = 5
and v.grau_parentesco = 'Titular'
and	(c.data_cancelamento = '0000-00-00' or c.data_cancelamento > NOW())