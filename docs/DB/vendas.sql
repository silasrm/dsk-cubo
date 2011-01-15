/*
Script gerado por Aqua Data Studio 7.5.11 em Jan-14-2011 12:44:51 PM
Banco de Dados: null
Esquema: <Todos os Esquemas>
*/

ALTER TABLE 'funcionarios'
	DROP FOREIGN KEY 'fk_cargos_funcionarios';
ALTER TABLE 'vendas'
	DROP FOREIGN KEY 'fk_funcionarios_vendas';
ALTER TABLE 'vendas'
	DROP FOREIGN KEY 'fk_tipos_vendas';
ALTER TABLE 'funcionarios'
	DROP FOREIGN KEY 'fk_unidades_trabalho_funcionarios';
DROP TABLE 'cargos';
DROP TABLE 'funcionarios';
DROP TABLE 'tipos';
DROP TABLE 'unidades_trabalho';
DROP TABLE 'vendas';
CREATE TABLE 'cargos' ( 
	'id'       	int(15) NULL,
	'descricao'	varchar(100) NULL 
	);
CREATE TABLE 'funcionarios' ( 
	'id'                 	int(15) NULL,
	'nome'               	varchar(200) NULL,
	'matricula'          	int(15) NULL,
	'salario'            	double(10,0) NULL,
	'telefone'           	varchar(15) NULL,
	'endereco'           	varchar(250) NULL,
	'cep'                	int(15) NULL,
	'estado'             	varchar(2) NULL,
	'data_nascimento'    	date NULL,
	'cargo_id'           	int(15) NULL,
	'unidade_trabalho_id'	int(15) NULL 
	);
CREATE TABLE 'tipos' ( 
	'id'       	int(15) NULL,
	'descricao'	varchar(100) NULL 
	);
CREATE TABLE 'unidades_trabalho' ( 
	'id'       	int(15) NULL,
	'descricao'	varchar(100) NULL 
	);
CREATE TABLE 'vendas' ( 
	'id'            	int(15) NULL,
	'nome'          	varchar(150) NULL,
	'quantidade'    	int(15) NULL,
	'preco'         	double(10,0) NULL,
	'funcionario_id'	int(15) NULL,
	'tipo_id'       	int(15) NULL 
	);
ALTER TABLE 'funcionarios'
	ADD CONSTRAINT 'fk_cargos_funcionarios'
	FOREIGN KEY('cargo_id')
	REFERENCES 'cargos'('id');
ALTER TABLE 'vendas'
	ADD CONSTRAINT 'fk_funcionarios_vendas'
	FOREIGN KEY('funcionario_id')
	REFERENCES 'funcionarios'('id');
ALTER TABLE 'vendas'
	ADD CONSTRAINT 'fk_tipos_vendas'
	FOREIGN KEY('tipo_id')
	REFERENCES 'tipos'('id');
ALTER TABLE 'funcionarios'
	ADD CONSTRAINT 'fk_unidades_trabalho_funcionarios'
	FOREIGN KEY('unidade_trabalho_id')
	REFERENCES 'unidades_trabalho'('id');
