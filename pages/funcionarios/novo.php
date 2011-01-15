<?php
    
    if( !empty( $_POST['nome'] )
	&& !empty( $_POST['data_nascimento'] )
	&& !empty( $_POST['matricula'] )
	&& !empty( $_POST['cargo'] )
	&& !empty( $_POST['unidade_trabalho'] )
	&& !empty( $_POST['salario'] )
	&& !empty( $_POST['telefone'] )
	&& !empty( $_POST['endereco'] )
	&& !empty( $_POST['cep'] )
	&& !empty( $_POST['estado'] ) )
    {
	$funcionarios = new App\Mapper\Funcionario;
	
	if( !$funcionarios->findByMatricula($_POST['matricula']) )
	{
	    $dados = array( 'nome' => $_POST['nome']
					, 'data_nascimento' => implode( '-', array_reverse( explode( '/', $_POST['data_nascimento'] ) ) )
					, 'matricula' => $_POST['matricula']
					, 'cargo_id' => $_POST['cargo']
					, 'unidade_trabalho_id' => $_POST['unidade_trabalho']
					, 'salario' => strtr( strtr( $_POST['salario'], array( '.' => '' ) ), array( ',' => '.' ) )
					, 'telefone' => $_POST['telefone']
					, 'endereco' => $_POST['endereco']
					, 'cep' => $_POST['cep']
					, 'estado' => $_POST['estado'] );
	    
	    if( $funcionarios->save($dados) != false )
		echo 'Dados cadastrados!';
	    else
		echo 'Erro ao cadastrar.';
	} else
	    echo 'Matrícula já existe!';
    }

    $cargo = new App\Mapper\Cargo;
    $cargos = $cargo->findAll();
    
    $unidadeTrabalho = new App\Mapper\UnidadeTrabalho;
    $unidades = $unidadeTrabalho->findAll();
?>
<h1>Vendas DSK</h1>
<br />
<br />
<h2>Funcionários</h2>
<br />
<a href="./index.php">&laquo; voltar</a> |
<a href="./index.php?funcionarios">Listar Funcionários</a>
<br />
<br />
<form method="post" action="">
    <label for="nome">Nome:</label>
    <input type="text" name="nome" id="nome" />
    <br />
    <label for="data_nascimento">Data de Nascimento:</label>
    <input type="text" name="data_nascimento" id="data_nascimento" />
    <br />
    <label for="matricula">Matrícula:</label>
    <input type="text" name="matricula" id="matricula" />
    <br />
    <label for="cargo">Cargo:</label>
    <select name="cargo" id="cargo">
	<?php foreach( $cargos as $_cargo ): ?>
	<option value="<?php echo $_cargo->id; ?>"><?php echo $_cargo->descricao; ?></option>
	<?php endforeach; ?>
    </select>
    <br />
    <label for="unidade_trabalho">Unidade de Trabalho:</label>
    <select name="unidade_trabalho" id="unidade_trabalho">
	<?php foreach( $unidades as $_unidade ): ?>
	<option value="<?php echo $_unidade->id; ?>"><?php echo $_unidade->descricao; ?></option>
	<?php endforeach; ?>
    </select>
    <br />
    <label for="salario">Salário:</label>
    <input type="text" name="salario" id="salario" />
    <br />
    <label for="telefone">Telefone:</label>
    <input type="text" name="telefone" id="telefone" />
    <br />
    <label for="endereco">Endereço:</label>
    <input type="text" name="endereco" id="endereco" />
    <br />
    <label for="cep">CEP:</label>
    <input type="text" name="cep" id="cep" />
    <br />
    <label for="estado">Estado:</label>
    <input type="text" name="estado" id="estado" />
    <br />
    <button type="submit">Cadastrar</button>
</form>