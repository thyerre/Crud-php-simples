<div>
           <table  class='table'>
            <tr>
           <!-- <th style='background-color: #dddddd;' >ID</thstyle> -->
           <th style='background-color: #dddddd;' >Nome</th>
           <th style='background-color: #dddddd;' >Email</th>
           <th style='background-color: #dddddd;' >Situação</th>
           <th style='background-color: #dddddd;' >Ação</th>
           
            </tr>
          
           <?php 
           foreach($user->getUsuarios() as $user){
               
			   ?>
                 <tr>
                
                <!-- <td style='border:2px #CCC solid'></td>           -->
                <td style='border:2px #CCC solid'><?=$user->nome?></td>
                <td style='border:2px #CCC solid'><?=$user->email?></td>
                <td style='border:2px #CCC solid'><?=$util->ativoInativo($user->bo_ativo)?></td>
                <td style='border:2px #CCC solid'><a href='?acao=update&id=<?=$user->id?>'><button type='submit' name='bnt-editar'class='btn btn-warning' style='margin-left:22%' >Editar</button></a> 
                <a href='?acao=delete&id=<?=$user->id?>'<button type='submit' style='margin-left:0%'  name='bntExcluir' class='btn btn-danger'>Excluir</button></a>
                <?php if($user->bo_ativo){?>
                    <a href='?acao=disable&id=<?=$user->id?>'<button type='submit' style='margin-left:1%'  name='bntDisable' class='btn btn-outline-secondary'>Desabilitar</button></a></td>

                <?php }else{ ?>

                <a href='?acao=enable&id=<?=$user->id?>'<button type='submit' style='margin-left:1%'  name='bntEnable' class='btn btn-outline-success'>Abilitar</button></a></td>

                <?php } ?>             
                 </tr>         
            <?php
             
        }
		?>
        </table>
</div>