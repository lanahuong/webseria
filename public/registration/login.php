<?php include('server.php') ?>
<!DOCTYPE html>
<head>
    <meta charset="utf-8" />
    <title>Créer un compte</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Se connecter</h1>
    <form method="post" action="login.php">
    <div>
      <label for="mail">Adresse Em@il</label>
      <input type="email" name="mail"/>
    </div>
    <div>
      <label for="passwd">Mot de passe</label>
      <input type="password" name="passwd"/>
    </div>
        <button type="submit" name="log_user">Se connecter</button>
        <button type="reset">Annuler</button>
    </form>
    <div>
    <br/>
      Vous n'avez pas de compte ?
      <a href=register.php><button type="button">En créer un</a>
    </div>
</body>
</html>