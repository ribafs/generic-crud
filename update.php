<?php
require_once('header.php');
$crud = new Crud($pdo, 'clientes');

$id=$_GET['id'];

$sth = $crud->pdo->prepare("SELECT id, nome,email from clientes WHERE id = :id");
$sth->bindValue(':id', $id, PDO::PARAM_STR); // No select e no delete basta um bindValue
$sth->execute();

$reg = $sth->fetch(PDO::FETCH_ASSOC);
$nome = $reg['nome'];
$email = $reg['email'];

?>

<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading text-center"><h3><b>CRUD <br>Atualizar</h3></b></div>
        <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <form method="post" action="">
                <table class="table table-bordered table-responsive table-hover">
                <tr><td><b>Nome</td><td><input type="text" name="nome" value="<?=$nome?>"></td></tr>
                <tr><td><b>E-mail</td><td><input type="text" name="email" value="<?=$email?>"></td></tr>
                <input name="id" type="hidden" value="<?=$id?>">
                <tr><td></td><td><input name="enviar" class="btn btn-primary" type="submit" value="Editar">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input name="enviar" class="btn btn-warning" type="button" onclick="location='index.php'" value="Voltar"></td></tr>
                </table>
            </form>
            <?php require_once('footer.php'); ?>
        </div>
    <div>
</div>

<?php

if(isset($_POST['enviar'])){
   $params = ['nome' => $_POST['nome'], 'email' => $_POST['email']];
   if($crud->update($params, "id = $id")){
        print "<script>alert('Registro alterado com sucesso!');location='index.php';</script>";
    }else{
        print "Erro ao alterar o registro!<br><br>";
        exit();
    }
}
?>

