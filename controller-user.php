<?php
$acao = $_GET["acao"];
switch ($acao) {
    case 'insert':
  
        require_once("view/insert.php");
        break;
    case 'update':
       
        require_once("view/update.php");
        break;
    case 'list-active':
        
        require_once("view/list.php");
        break;
    case 'delete':
        
        require_once("view/delete.php");
        break;
    case 'disable':
        
        require_once("view/disable.php");
        break;
    case 'list-all':
        
        require_once("view/list-all.php");
        break;
    case 'enable':
        
        require_once("view/enable.php");
        break;
    case 'login':
        
        require_once("view/login.php");
        break;
    default:
        
        break;
}