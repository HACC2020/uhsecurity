<?php
session_start();
switch ($_POST['req']) {
  // (A) INVALID REQUEST
  default:
    echo json_encode([
      "status" => 0,
      "msg" => "Invalid request"
    ]);
    break;

  // (B) SIGN IN
  case "in":
    // (B1) ALREADY SIGNED IN
    if (isset($_SESSION['user'])) {
      echo json_encode([
        "status" => 1,
        "msg" => "Already signed in"
      ]);
      die();
    }

    // (B2) CONNECT DATABASE
    // ! CHANGE THESE TO YOUR OWN !
    $dbhost = "localhost";
    $dbchar = "utf8";
    $dbname = "haccsec";
    $dbuser = "root";
    $dbpass = "Il0v35auza!@34";
    try {
      $pdo = new PDO(
        "mysql:host=".$dbhost.";charset=".$dbchar.";dbname=".$dbname,
        $dbuser, $dbpass, [
          PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
          PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
          PDO::ATTR_EMULATE_PREPARES => false
        ]);
    } catch (Exception $ex) {
      echo json_encode([
        "status" => 0,
        "msg" => $ex->getMessage()
      ]);
      die();
    }

    // (B3) GET USER
    $stmt = $pdo->prepare("SELECT * FROM `users` WHERE `user_email`=?");
    $stmt->execute([$_POST['email']]);
    $user = $stmt->fetch();
    if (!is_array($user)) {
      echo json_encode([
        "status" => 0,
        "msg" => "Invalid email/password"
      ]);
      die();
    }

    // (B4) CHECK PASSWORD & VERIFY
    // !! HIGHLY RECOMMENDED - ENCRYPT YOUR PASSWORDS !!
    // https://code-boxx.com/password-encrypt-decrypt-php/
    if ($user['user_password'] == $_POST['password']) {
      $_SESSION['user'] = [
        "name" => $user['user_name'],
        "email" => $user['user_email']
      ];
      echo json_encode([
        "status" => 1,
        "msg" => "OK"
      ]);
    } else {
      echo json_encode([
        "status" => 0,
        "msg" => "Invalid email/password"
      ]);
    }
    die();
    break;

  // (C) SIGN OUT
  case "out":
    unset ($_SESSION['user']);
    echo json_encode([
      "status" => 1,
      "msg" => "OK"
    ]);
    break;
}
