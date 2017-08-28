<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <title>login</title>

</head>
<body>

<div class="form-login">

    <form method="post" action="verifica_usuario.php?acao=login">

        <input type="text"     name="nome" placeholder="digite seu nome">
        <br />
        <input type="text"     name="login" placeholder="digite seu login ">
        <br />
        <input type="password" name="senha" placeholder="digite sua senha ">
        <br />
        <input type="submit"   name="login_form" value="acessar">

    </form>

</div>

</body>
</html>