<?php
// (A) MUTE NOTICES
error_reporting(E_ALL & ~E_NOTICE);

// (B) DATABASE SETTINGS - CHANGE THESE TO YOUR OWN
define('DB_HOST', 'localhost');
define('DB_NAME', 'haccsec');
define('DB_CHARSET', 'utf8');
define('DB_USER', 'root');
define('DB_PASSWORD', 'Il0v35auza!@34');

// (C) CONNECT TO DATABASE
try {
  $pdo = new PDO(
    "mysql:host=" . DB_HOST . ";charset=" . DB_CHARSET . ";dbname=" . DB_NAME,
    DB_USER, DB_PASSWORD, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, PDO::ATTR_EMULATE_PREPARES => false]
  );
} catch (Exception $ex) {
  print_r($ex);
  die();
}

// (D) START SESSION
session_start();
[root@uhsecurity hacc]# cat 2b-login.php
<?php
// (A) LET'S SAY THE LOGIN FORM POST TO THIS SCRIPT
$_POST = [
  "email" => "john@doe.com",
  "password" => "123456"
];

// (B) WE FETCH THE USER FROM DATABASE & VERIFY THE PASSWORD
require "2a-core.php";
$stmt = $pdo->prepare("SELECT * FROM `users` LEFT JOIN `roles` USING (`role_id`) WHERE `user_email`=?");
$stmt->execute([$_POST['email']]);
$user = $stmt->fetchAll();
$pass = count($user)>0;
if ($pass) {
  $pass = $user[0]['user_password'] == $_POST['password'];
}

// (C) IF VERIFIED - WE PUT THE USER & PERMISSIONS INTO THE SESSION
if ($pass) {
  $_SESSION['user'] = $user[0];
  $_SESSION['user']['permissions'] = [];
  unset($_SESSION['user']['user_password']); // Security...
  $stmt = $pdo->prepare("SELECT * FROM `roles_permissions` WHERE `role_id`=?");
  $stmt->execute([$user[0]['role_id']]);
  while ($row = $stmt->fetch(PDO::FETCH_NAMED)) {
    if (!isset($_SESSION['user']['permissions'][$row['perm_mod']])) {
      $_SESSION['user']['permissions'][$row['perm_mod']] = [];
    }
    $_SESSION['user']['permissions'][$row['perm_mod']][] = $row['perm_id'];
  }
}

// (D) DONE!
echo $pass ? "OK" : "Invalid email/password" ;
echo "<br><br>SESSION DUMP<br>";
print_r($_SESSION);
