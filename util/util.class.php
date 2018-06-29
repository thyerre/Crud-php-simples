<?php
    
class Util{
  
    
    //função para pular linha
    public function ln($v){
        for($i=0;$i<$v;$i++){
            echo "<br />";
        }
    }
    //função para debugar com var_dump
    public function debug($ar){
        print '<pre>';
        var_dump($ar);
        print '</pre>';
    }
    
    public function ativoInativo($situacao){
        $st = '
        <div class="alert alert-danger" style="text-align:center" role="alert">
            Inativo
        </div>';
        
        if($situacao){
            $st = '
            <div class="alert alert-success" style="text-align:center" role="alert">
                Ativo
            </div>
            ';
            
        }
        return $st;
    }
    public function notify($text,$type){
        ?>

            <script>
                
                $.notify("<?=$text?>", "<?=$type?>");
            </script>
      
        <?php
    }
    public function alerta($text,$type){
        echo "<div class='alert alert-$type' style='text-align:center' role='alert'>
        $text
    </div>'";
    }    
}