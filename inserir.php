<?php
    require_once($_SERVER['DOCUMENT_ROOT'] . 'Aula06/DAO/usuariosDAO.php');
    
    if(isset($_POST['f_mail']) and isset($_POST['f_senha']) and isset($_POST['f_nome']) and isset($_POST['f_perfil']))
    {
        $myuser = new usuarios();
        $myuser->setNome($_POST['f_nome']);
        $myuser->setEmail($_POST['f_mail']);
        $myuser->setSenha(md5($_POST['f_senha']));
        $myuser->setId_perfis(intval($_POST['f_perfil']));
        $myuserdao = new usuariosDAO($myuser);
        $resultado = $myuserdao->insert();
        $pagina = "Location:cadastro.php";
        Header($pagina);

    }

    function fc_guarda_id($valor){
        session_start();
        $_SESSION['val_id'] = $valor;
    }
?>
