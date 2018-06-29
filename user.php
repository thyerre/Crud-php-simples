<?php
// require_once("util/util.class.php");

class User extends Crud{
    var $table = 'usuario';


    public function getUsuarios(){
        $where = array();
        $join = array();
        return Crud::select($this->table,$join,$where);
    }

    public function getUsuario(){
        return Crud::find($this->table,$_GET['id']);
    }

    public function insert(){
        Crud::insert($this->table,$this->dados());
    }

    public function delete(){
        $ar ["id"] = $_GET['id'];
        
        Crud::delete($this->table,$ar);

    }
    public function desabilitar(){
        $ar ["id"] = $_GET['id'];
        $ar ["bo_ativo"] = "0";
        
        Crud::update($this->table,$ar);
        
        
    }
    public function update(){
                
        Crud::update($this->table,$this->dados());
                
    }

    public function abilitar(){

        $ar ["id"] = $_GET['id'];
        $ar ["bo_ativo"] = TRUE;

        Crud::update($this->table,$ar);
    }

    public function getUsuarioEmail($email){

        $sql = "SELECT * FROM usuario WHERE email = '$email'";
        $stmt = DB::prepare($sql);
        $stmt->execute();   
        $user = $stmt->fetch();

        return $user;

    }


    


    public function login(){
        
        $email = addslashes($_POST['email']);
        $senha = addslashes($_POST['senha']);
       
        $sql = "SELECT * FROM usuario WHERE email = '$email'";
                $stmt = DB::prepare($sql);
                $stmt->execute();
                $user = $stmt->fetch();
                
        if(password_verify($senha,$user->senha)){
            if($user->bo_ativo){

                

                $_SESSION['login'] = "<div class='alert alert-success' style='text-align:center;width:50%' role='alert'>
                Bem Vindo Sr(a) $user->nome   
            </div>";
            header('Location: cookie.php?acao=list-all');
            
            }else{ 
                echo '<div class="alert alert-danger" style="text-align:center;width:50%" role="alert">
            Você não tem permição   
        </div>';
                
            }
        }else{
           echo '<div class="alert alert-danger" style="text-align:center;width:50%" role="alert">
                Email ou senha incorretos!   
            </div>'; 
        }
    }

    public function dados(){
        $ar = $_POST;
        $ar['bo_ativo']=true;
        return $ar;
    }
    

}
