<?php
/**
  * Use an HTML form to edit an entry in the
  * users table.
  *
  */
require "../config.php";
require "../common.php";
if (isset($_POST['submit'])) {
  try {
    $connection = new PDO($dsn, $username, $password, $options);
    $user =[
      "id"        => $_POST['id'],
      "vfirstname" => $_POST['vfirstname'],
      "vlastname"  => $_POST['vlastname'],
      "email"     => $_POST['email'],
      "meetinglocation"       => $_POST['meetinglocation'],
      "meetingtime"  => $_POST['meetingtime'],
      "sponsorid"    => $_POST['sponsorid'],
      "vdate"	=> $_POST['vdate'],
    ];

    $sql = "UPDATE visitor
            SET id = :id,
              vfirstname = :vfirstname,
              vlastname = :vlastname,
              email = :email,
              meetinglocation = :meetinglocation,
	      vdate = :vdate,
              meetingtime = :meetingtime
            WHERE id = :id";

  $statement = $connection->prepare($sql);
  $statement->execute($user);
  } catch(PDOException $error) {
      echo $sql . "<br>" . $error->getMessage();
  }
}

if (isset($_GET['id'])) {
  try {
    $connection = new PDO($dsn, $username, $password, $options);
    $id = $_GET['id'];
    $sql = "SELECT * FROM visitor WHERE id = :id";
    $statement = $connection->prepare($sql);
    $statement->bindValue(':id', $id);
    $statement->execute();

    $user = $statement->fetch(PDO::FETCH_ASSOC);
  } catch(PDOException $error) {
      echo $sql . "<br>" . $error->getMessage();
  }
} else {
    echo "Something went wrong!";
    exit;
}
?>

<?php require "templates/header.php"; ?>

<?php if (isset($_POST['submit']) && $statement) : ?>
  <?php echo escape($_POST['vlastname']); ?> successfully updated.
<?php endif; ?>

<h2>Edit a Visit</h2>

<form method="post">
    <?php foreach ($user as $key => $value) : ?>
      <label for="<?php echo $key; ?>"><?php echo ucfirst($key); ?></label><br>
      <input type="text" name="<?php echo $key; ?>" id="<?php echo $key; ?>" value="<?php echo escape($value); ?>" <?php echo ($key === 'id' ? 'readonly' : null); ?>><br>
    <?php endforeach; ?><br>
    <input type="submit" name="submit" value="Submit">
</form>

<a href="index.php">Back to home</a>

<?php require "templates/footer.php"; ?>
