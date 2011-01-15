<?php

    namespace App\Mapper;
    
    class Funcionario extends Core
    {
        protected $table = 'funcionarios';
        
        public function findByMatricula( $matricula )
        {
            return $this->adapter
                                    ->query( 'SELECT * FROM ' . $this->table . ' WHERE matricula=' . $matricula )
                                    ->fetch( self::FETCH_OBJ );
        }
        
        public function findAll()
        {
            return $this->adapter
                                    ->query( 'SELECT f.*, c.descricao as cargo, u.descricao as unidade
                                                    FROM funcionarios AS f
                                                        LEFT JOIN cargos AS  c ON c.id = f.cargo_id 
                                                        LEFT JOIN unidades_trabalho AS  u ON u.id = f.unidade_trabalho_id' )
                                    ->fetchAll( self::FETCH_OBJ );
        }
        
        public function findAgrupadoPorCargo()
        {
            return $this->adapter
                                    ->query( 'SELECT f.*, c.descricao as cargo, u.descricao as unidade
                                                    FROM funcionarios AS f
                                                        LEFT JOIN cargos AS  c ON c.id = f.cargo_id 
                                                        LEFT JOIN unidades_trabalho AS  u ON u.id = f.unidade_trabalho_id
                                                    GROUP BY f.cargo_id, f.id' )
                                    ->fetchAll( self::FETCH_OBJ );
        }
        
        public function findByUnidade( $unidade_id )
        {
            return $this->adapter
                                    ->query( 'SELECT f.nome, f.matricula
                                                    FROM funcionarios AS f
                                                        LEFT JOIN cargos AS  c ON c.id = f.cargo_id 
                                                        LEFT JOIN unidades_trabalho AS  u ON u.id = f.unidade_trabalho_id
                                                    WHERE f.unidade_trabalho_id = ' . $unidade_id )
                                    ->fetchAll( self::FETCH_OBJ );
        }
        
        public function findIdadeAcimaDe( $idade )
        {
            $ano = date('Y') - $idade;
            $data = date('m-d');
            $dataBusca = $ano . '-' . $data;
            
            return $this->adapter
                                    ->query( 'SELECT f.nome, f.matricula, f.data_nascimento
                                                    FROM funcionarios AS f
                                                        LEFT JOIN cargos AS  c ON c.id = f.cargo_id 
                                                        LEFT JOIN unidades_trabalho AS  u ON u.id = f.unidade_trabalho_id
                                                    WHERE f.data_nascimento < \'' . $dataBusca . '\'' )
                                    ->fetchAll( self::FETCH_OBJ );
        }
        
        public function findSalarioMaiorQue( $salario )
        {
            return $this->adapter
                                    ->query( 'SELECT f.*, c.descricao as cargo, u.descricao as unidade
                                                    FROM funcionarios AS f
                                                        LEFT JOIN cargos AS  c ON c.id = f.cargo_id 
                                                        LEFT JOIN unidades_trabalho AS  u ON u.id = f.unidade_trabalho_id
                                                    WHERE f.salario > ' . $salario )
                                    ->fetchAll( self::FETCH_OBJ );
        }
        
        public function findVendedores()
        {
            return $this->adapter
                                    ->query( 'SELECT f.*, c.descricao as cargo, u.descricao as unidade
                                                    FROM funcionarios AS f
                                                        LEFT JOIN cargos AS  c ON c.id = f.cargo_id 
                                                        LEFT JOIN unidades_trabalho AS  u ON u.id = f.unidade_trabalho_id
                                                    WHERE f.cargo_id = 1' )
                                    ->fetchAll( self::FETCH_OBJ );
        }
        
        public function getMediaSalarialVendedor()
        {
            $funcionarios = $this->findVendedores();
            
            $_totalSalarios = 0;
            $_totalFuncionarios = count($funcionarios);
            
            foreach( $funcionarios as $funcionario )
            {
                $_totalSalarios += $funcionario->salario;
            }
            
            return ( $_totalSalarios / $_totalFuncionarios );
        }
    }

?>