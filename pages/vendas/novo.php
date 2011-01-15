<?php
    
    if( !empty( $_POST['nome'] )
	&& !empty( $_POST['tipo'] )
	&& !empty( $_POST['quantidade'] )
	&& !empty( $_POST['preco'] )
	&& !empty( $_POST['matricula'] ) )
    {
	$funcionarios = new App\Mapper\Funcionario;
	$funcionario = $funcionarios->findByMatricula( $_POST['matricula'] );
	
	if( $funcionario )
	{
	    $vendas = new App\Mapper\Venda;
	    
	    $dados = array( 'nome' => $_POST['nome']
					, 'tipo_id' => $_POST['tipo']
					, 'quantidade' => $_POST['quantidade']
					, 'preco' => strtr( strtr( $_POST['preco'], array( '.' => '' ) ), array( ',' => '.' ) )
					, 'funcionario_id' => $funcionario->id );
	    
	    if( $vendas->save($dados) != false )
		echo 'Dados cadastrados!';
	    else
		echo 'Erro ao cadastrar.';
	} else
	    echo 'Funcionário não encontrado.';
    }

    $tipo = new App\Mapper\Tipo;
    $tipos = $tipo->findAll();
?>
<h1>Vendas DSK</h1>
<br />
<br />
<h2>Vendas</h2>
<br />
<a href="./index.php">&laquo; voltar</a> |
<a href="./index.php?vendas">Listar Vendas</a>
<br />
<br />
<form method="post" action="">
    <label for="nome">Nome:</label>
    <input type="text" name="nome" id="nome" />
    <br />
    <label for="tipo">Tipo:</label>
    <select name="tipo" id="tipo">
	<?php foreach( $tipos as $_tipo ): ?>
	<option value="<?php echo $_tipo->id; ?>"><?php echo $_tipo->descricao; ?></option>
	<?php endforeach; ?>
    </select>
    <br />
    <label for="quantidade">Quantidade:</label>
    <input type="text" name="quantidade" id="quantidade" />
    <br />
    <label for="preco">Preço:</label>
    <input type="text" name="preco" id="preco" />
    <br />
    <label for="matricula">Matrícula Funcionário:</label>
    <input type="text" name="matricula" id="matricula" />
    <br />
    <button type="submit">Cadastrar</button>
</form>