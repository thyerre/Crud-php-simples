<?php
require_once("util/DB.php");
class Crud extends DB
{
    var $table;
    // read, update and delete
    public function select($table = null, $join, $where)
    {
        if (count($join))
            $innerJoin = implode(" ", $join);
        if (count($where) > 0)
            $w = " where " . implode(" ", $where);

        $sql = "SELECT * FROM " . $this->table . " " . $innerJoin . $w;
        $stmt = DB::prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    // find
    public function find($table, $id_pk, $join)
    {

        if (count($join))
            $innerJoin = implode(" ", $join);

        $pk = $this->getPk($table);

        $where = " where $pk = " . $id_pk;

        $sql = "SELECT * FROM " . $this->table . " " . $innerJoin . $where;
        $stmt = DB::prepare($sql);
        $stmt->execute();
        return $stmt->fetch();
    }

    // Create
    public function insert($table, array $dados)
    {
        try {
            $sql = "INSERT INTO $table ({$this->colunas($table)->select}) VALUES ({$this->colunas($table)->indiceInsert})";
            $stmt = DB::prepare($sql);

            if($this->verify_insert($dados)){
                echo "AQUI";
                foreach ($dados as $key => $value) {
                    
                    //criptografia da senha
                if($key == 'senha'){
                        $value = $this->crip($value);
                    }
                    
                        
                    if ($typeArray) {
                        $stmt->bindValue(":$key", $value, $typeArray[$key]);
                    } else {
                        if (is_int($value))
                            $param = PDO::PARAM_INT;
                        elseif (is_bool($value))
                            $param = PDO::PARAM_BOOL;
                        elseif (is_null($value))
                            $param = PDO::PARAM_NULL;
                        elseif (is_string($value))
                            $param = PDO::PARAM_STR;
                        else
                            $param = false;

                            if ($param)
                            $stmt->bindValue(":$key", $value, $param);
                        }
                        
                    }
                    if ($stmt->execute()) {
                        $cd = DB::getInstance()->lastInsertId();
                        //echo $stmt->rowCount();
                        return $cd;
                    } else {
                        echo "Erro ao Inserir!";
                        return false;
                    }
            }
        } catch (PDOException $e) {
            $ret = array('erro' => 'Error: ' . $e->getMessage());
            echo $e->getMessage();
                
        }
            
        }
        //update
    public function update($table, array $dados)
    {
        $dados = $this->processar($table, $dados);

        $up = $this->montarCrud($table, $dados, 'update');

        $stmt = DB::prepare($up);

        foreach ($dados as $key => $v) {
            $stmt->bindValue(':' . $key, $v);
        }
        // print'<pre>';
        // $stmt->debugDumpParams();
        // print'</pre>';

        if ($stmt->execute()) {
            echo "alterado  com sucesso";
            return true;
        } else {
            echo json_encode("Erro ao Alterar!");
            return false;
        }


    }

    // delete
     public function delete($table, $dados)
     {
         $del =$this->montarCrud($table, $dados, "deleta");
         
         $stmt = DB::prepare($del);

         foreach ($dados as $key => $v) {
                
             $stmt->bindValue(':' . $key, $v);
         }
        // print'<pre>';
        // $stmt->debugDumpParams();
        // print'</pre>';
        
        
        if ($stmt->execute()) {
            return true;
        } else {
            echo json_encode("Erro ao Alterar!");
            return false;
        }
     }
     //verificação de prencimento
     private function verify_insert(array $dados){
        foreach ($dados as $key => $value) {
            if(empty($value) || !isset($value)){
                return FALSE;
                die();
            }
            addslashes($value);  
        }
        return TRUE;
        

     }

    //criptografia da senha
    private function crip($value){      

            $value = password_hash($value,PASSWORD_DEFAULT);
            return $value;
        
    }
   

    //Processamento de dados 
    private function processar($table, array $ar_dados)
    {
        $columns = $this->getColumns($table);


        foreach ($ar_dados as $key => $value) {

            if (in_array($key, $columns)) {
                if (isset($value) && $value != null) {
                    $dados[$key] = $value;
                }
            }
        }
        return $dados;
    }

     

    // pegando inforamções da tabela
    private function getPk($table)
    {
        $stmt = DB::prepare("DESCRIBE $table");
        $stmt->execute();
        // percorrendo as colunas da tabela
        foreach ($stmt->fetchAll() as $key => $c) {

            if (!empty($c->Key)) {
                return $c->Field;
            }
        };
    }

    //pegando colunas
    private function getColumns($table)
    {
        $stmt = DB::prepare("DESCRIBE $table");
        $stmt->execute();
        // percorrendo as colunas da tabela
        foreach ($stmt->fetchAll() as $key => $c) {
            $colunas[$c->Field] = $c->Field;
        };
        return $colunas;
    }


    //Monta A query de execução
    private function montarCrud($table, $dados, $tipo)
    {
        $pk = $this->getPk($table);

        switch ($tipo) {
            case 'update':
                foreach ($dados as $key => $value) {
                    if ($key == $pk) {
                        $where = " WHERE $key = :$key";
                    } else {
                        $set[] = " $key = :$key ";
                    }
                }
                return "UPDATE ".$table." SET " . implode(",", $set) . $where;
                break;
            case 'deleta':
                foreach ($dados as $key => $value) {
                    if ($key == $pk) {
                        $where = " WHERE $key = :$key";
                    }
                }
                return (" DELETE FROM " . $table . $where);
                break;

            default:
                # code...
                break;
        }
    }

    public function colunas($table, $primaryNoInsert = null, $campo = null)
    {
        // $obj = new stdObject ();

        $Query = DB::prepare("SHOW COLUMNS FROM " . $table);
        $Query->execute();

        while ($e = $Query->fetch(PDO::FETCH_ASSOC)) {
            $cln[] = $e['Field'];
            $obj->colunas[] = '<td>' . $e['Field'] . '</td>';
            $indice[] = ':' . $e['Field'];
            $indiceUpdate[] = $e['Field'] . '=:' . $e['Field'];
            if ($campo != null) {
                if ($e['Field'] == $campo) {
                    $busca = $e['Field'];
                }
            }
        }

        unset($indiceUpdate[0]);
        $arSelecao = $cln;
        $arInsert = $indice;
        if ($primaryNoInsert == null) {
            unset($arSelecao[0]);
            unset($arInsert[0]);
        }
        $obj->primeiroRegistro = $cln[0];
        @$obj->busca = $busca;
        $obj->select = implode(",", $arSelecao);
        $obj->indiceInsert = implode(",", $arInsert);
        $obj->indiceUp = implode(",", $indiceUpdate);
        return $obj;
        // return implode(",",$colunas);
    }

}
  