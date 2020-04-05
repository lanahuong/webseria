<?php
//sudo systemctl start postgresql

use User\UserRepository;

include '../../src/User.php';
include '../../src/UserRepository.php';
include '../../src/Factory/DbAdaperFactory.php';

session_start();

// initializing variables
$username = "";
$email    = "";
$errors = array(); 

// connect to the database (attention, db est un dbAdapter)
$db = (new DbAdaperFactory())->createService();


// REGISTER USER
if (isset($_POST['reg_user'])) {
  // receive all input values from the form
  $username =  $_POST['username'];
  $email = $_POST['email'];
  $password_1 = $_POST['passwd'];
  $password_2 = $_POST['confpasswd'];

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($username)) { array_push($errors, "Nom d'utilisateur nécessaire"); }
  if (empty($email)) { array_push($errors, "Email requis"); }
  if (empty($password_1)) { array_push($errors, "Mot de passe requis"); }
  if ($password_1 != $password_2) {
	array_push($errors, "Les deux mots de passe ne concordent pas");
  }

  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM user WHERE username='$username' OR email='$email' LIMIT 1";
  $result = $db->query($user_check_query);
  $user = $result->fetchAll();
  
  if ($user) { // if user exists
    if ($user['username'] === $username) {
      array_push($errors, "Cet utilisateur existe déjà !");
    }

    if ($user['email'] === $email) {
      array_push($errors, "Cet email est déjà utilisé !");
    }
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
  	$password = md5($password_1);//encrypt the password before saving in the database

  	$query = "INSERT INTO user (username, email, pwd) 
  			  VALUES('$username', '$email', '$password')";
  	$db->query($query);
  	$_SESSION['userName'] = $username;
  	$_SESSION['success'] = "Vous êtes connectés !";
  	header('location: index.php');
  }
}


// LOGIN USER
if (isset($_POST['log_user'])) {
    $username = $_POST['username'];
    $password = $_POST['passwd'];
  
    if (empty($username)) {
        array_push($errors, "Nom d'utilisateur requis (sinon on ne peut pas savoir qui vous êtes !)");
    }
    if (empty($password)) {
        array_push($errors, "Mot de passe requis");
    }
  
    if (count($errors) == 0) {
        $password = md5($password);
        $query = "SELECT * FROM user WHERE username='$username' AND pwd='$password'";
        $results = $query->query($query);
        $nbRow = $results->rowCount();
        if ($nbRow == 1) {
          $_SESSION['username'] = $username;
          $_SESSION['success'] = "Vous êtes connecté !";
          header('location: index.php');
        }else {
            array_push($errors, "Le mot de passe ne correspond pas à l'utilisateur.");
        }
    }
  }
  
  ?>