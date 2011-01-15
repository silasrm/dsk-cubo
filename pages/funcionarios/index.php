<h1>Vendas DSK</h1>
<br />
<br />
<h2>Funcionários</h2>
<br />
<a href="./index.php">&laquo; voltar</a> |
<a href="./index.php?funcionarios/novo">Novo Funcionário</a>
<br />
<br />
<?php
    $venda = new App\Mapper\Venda;
    $funcionario = new App\Mapper\Funcionario;
?>
Total de Funcionários: <?php echo $funcionario->count(); ?>
<br />
Média Salárial Vendedores: <?php echo number_format( $funcionario->getMediaSalarialVendedor(), 2, ',', '.' ); ?>
<br />
<br />
<h3>Funcionários Por Cargo</h3>
<table border="1">
    <thead>
	<tr>
	    <td>Matrícula</td>
	    <td>Nome</td>
	    <td>Cargo</td>
	    <td>Unidade de Trabalho</td>
	    <td>Data de Nascimento</td>
	    <td>Salário</td>
	    <td>Livros Vendidos</td>
	</tr>
    </thead>
    <tbody>
	<?php
	    $funcionariosPorCargo = $funcionario->findAgrupadoPorCargo();
	    
	    foreach( $funcionariosPorCargo as $_funcionario ):
	?>
	<tr>
	    <td>
		<?php echo $_funcionario->matricula; ?>
	    </td>
	    <td>
		<?php echo $_funcionario->nome; ?>
	    </td>
	    <td>
		<?php echo $_funcionario->cargo; ?>
	    </td>
	    <td>
		<?php echo $_funcionario->unidade; ?>
	    </td>
	    <td>
		<?php echo implode( '/', array_reverse( explode( '-', $_funcionario->data_nascimento ) ) ); ?>
	    </td>
	    <td>
		<?php echo number_format( $_funcionario->salario, 2, ',', '.' ); ?>
	    </td>
	    <td>
		<?php
		    $quantidade = $venda->getLivrosVendidosByFuncionario( $_funcionario->id );
		    echo $quantidade->quantidade;
		?>
	    </td>
	</tr>
	<?php endforeach; ?>
    </tbody>
</table>
<br />
<br />
<h3>Funcionários com salário maior que R$2.000,00</h3>
<table border="1">
    <thead>
	<tr>
	    <td>Matrícula</td>
	    <td>Nome</td>
	    <td>Cargo</td>
	    <td>Unidade de Trabalho</td>
	    <td>Data de Nascimento</td>
	    <td>Salário</td>
	    <td>Livros Vendidos</td>
	</tr>
    </thead>
    <tbody>
	<?php
	    $funcionariosSalarioMaiorQue2000 = $funcionario->findSalarioMaiorQue( 2000 );
	    
	    foreach( $funcionariosSalarioMaiorQue2000 as $_funcionario ):
	?>
	<tr>
	    <td>
		<?php echo $_funcionario->matricula; ?>
	    </td>
	    <td>
		<?php echo $_funcionario->nome; ?>
	    </td>
	    <td>
		<?php echo $_funcionario->cargo; ?>
	    </td>
	    <td>
		<?php echo $_funcionario->unidade; ?>
	    </td>
	    <td>
		<?php echo implode( '/', array_reverse( explode( '-', $_funcionario->data_nascimento ) ) ); ?>
	    </td>
	    <td>
		<?php echo number_format( $_funcionario->salario, 2, ',', '.' ); ?>
	    </td>
	    <td>
		<?php
		    $quantidade = $venda->getLivrosVendidosByFuncionario( $_funcionario->id );
		    echo $quantidade->quantidade;
		?>
	    </td>
	</tr>
	<?php endforeach; ?>
    </tbody>
</table>
<br />
<h3>Funcionários da unidade Loja Centro</h3>
<table border="1">
    <thead>
	<tr>
	    <td>Matrícula</td>
	    <td>Nome</td>
	</tr>
    </thead>
    <tbody>
	<?php
	    $funcionariosPorUnidade = $funcionario->findByUnidade( 1 );
	    
	    foreach( $funcionariosPorUnidade as $_funcionario ):
	?>
	<tr>
	    <td>
		<?php echo $_funcionario->matricula; ?>
	    </td>
	    <td>
		<?php echo $_funcionario->nome; ?>
	    </td>
	</tr>
	<?php endforeach; ?>
    </tbody>
</table>
<br />
<h3>Funcionários com idade acima de 40 anos</h3>
<table border="1">
    <thead>
	<tr>
	    <td>Matrícula</td>
	    <td>Nome</td>
	    <td>Data de Nsacimento</td>
	</tr>
    </thead>
    <tbody>
	<?php
	    $funcionariosAcima40Anos = $funcionario->findIdadeAcimaDe( 40 );
	    
	    foreach( $funcionariosAcima40Anos as $_funcionario ):
	?>
	<tr>
	    <td>
		<?php echo $_funcionario->matricula; ?>
	    </td>
	    <td>
		<?php echo $_funcionario->nome; ?>
	    </td>
	    <td>
		<?php echo implode( '/', array_reverse( explode( '-', $_funcionario->data_nascimento ) ) ); ?>
	    </td>
	</tr>
	<?php endforeach; ?>
    </tbody>
</table>