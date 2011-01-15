<?php

    namespace App\Mapper;
    
    class Venda extends Core
    {
        protected $table = 'vendas';
        
        public function findAll()
        {
            return $this->adapter
                                    ->query( 'SELECT v.*, f.nome as funcionario, f.matricula, t.descricao as tipo
                                                    FROM vendas AS v
                                                        LEFT JOIN funcionarios AS  f ON f.id = v.funcionario_id
                                                        LEFT JOIN tipos AS  t ON t.id = v.tipo_id' )
                                    ->fetchAll( self::FETCH_OBJ );
        }
        
        public function getLivrosVendidosByFuncionario( $funcionario_id )
        {
            return $this->adapter
                                    ->query( 'SELECT sum(v.quantidade) as quantidade
                                                    FROM vendas AS v
                                                        LEFT JOIN funcionarios AS  f ON f.id = v.funcionario_id
                                                        LEFT JOIN tipos AS  t ON t.id = v.tipo_id
                                                    WHERE v.tipo_id = 1 and v.funcionario_id = ' . $funcionario_id )
                                    ->fetch( self::FETCH_OBJ );
        }
        
        public function findQuantidadeVendas()
        {
            return $this->adapter
                                    ->query( 'SELECT t.descricao as tipo, sum(v.quantidade) as quantidade
                                                    FROM tipos as t
                                                        LEFT JOIN vendas AS v ON v.tipo_id = t.id
                                                    GROUP BY t.id;' )
                                    ->fetchAll( self::FETCH_OBJ );
        }
        
        public function getMediaPreco()
        {
            $vendas = $this->findAll();
            
            $_totalPrecos = 0;
            $_totalVendas = count($vendas);
            
            foreach( $vendas as $venda )
            {
                $_totalPrecos += $venda->preco;
            }
            
            return ( $_totalPrecos / $_totalVendas );
        }
    }

?>