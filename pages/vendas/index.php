<h1>Vendas DSK</h1>
<br />
<br />
<h2>Vendas</h2>
<br />
<a href="./index.php">&laquo; voltar</a> |
<a href="./index.php?vendas/novo">Nova Venda</a>
<br />
<?php
    $venda = new App\Mapper\Venda;
?>
Média Preço: <?php echo number_format( $venda->getMediaPreco(), 2, ',', '.' ); ?>
<br />
<br />
<h3>Vendas</h3>
<table border="1">
    <thead>
	<tr>
	    <td>Item</td>
	    <td>Tipo</td>
	    <td>Quantidade</td>
	    <td>Preço</td>
	    <td>Funcionário</td>
	</tr>
    </thead>
    <tbody>
	<?php
	    $vendas = $venda->findAll();
	    
	    foreach( $vendas as $_venda ):
	?>
	<tr>
	    <td>
		<?php echo $_venda->nome; ?>
	    </td>
	    <td>
		<?php echo $_venda->tipo; ?>
	    </td>
	    <td>
		<?php echo $_venda->quantidade; ?>
	    </td>
	    <td>
		<?php echo number_format($_venda->preco, 2, ',', '.' ); ?>
	    </td>
	    <td>
		<?php echo $_venda->matricula; ?> / <?php echo $_venda->funcionario; ?>
	    </td>
	</tr>
	<?php endforeach; ?>
    </tbody>
</table>
<br />
<h3>Quantidade de Itens vendidos</h3>
<table border="1">
    <thead>
	<tr>
	    <td>Tipo</td>
	    <td>Quantidade</td>
	</tr>
    </thead>
    <tbody>
	<?php
	    $quantidadeVendas = $venda->findQuantidadeVendas();
	    
	    foreach( $quantidadeVendas as $_venda ):
	?>
	<tr>
	    <td>
		<?php echo $_venda->tipo; ?>
	    </td>
	    <td>
		<?php echo (int)$_venda->quantidade; ?>
	    </td>
	</tr>
	<?php endforeach; ?>
    </tbody>
</table>