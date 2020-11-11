<?php

/**
 * Use an HTML form to create a new entry in the
 * users table.
 *
 */


if (isset($_POST['submit'])) {
    require "../config.php";
    require "../common.php";

    try  {
        $connection = new PDO($dsn, $username, $password, $options);
        
        $new_user = array(
            "vfirstname" => $_POST['vfirstname'],
            "vlastname"  => $_POST['vlastname'],
            "email"     => $_POST['email'],
            "meetinglocation"       => $_POST['meetinglocation'],
            "meetingtime"  => $_POST['meetingtime'],
	    "vdate" 	=> $_POST['vdate']
        );

        $sql = sprintf(
                "INSERT INTO %s (%s) values (%s)",
                "visitor",
                implode(", ", array_keys($new_user)),
                ":" . implode(", :", array_keys($new_user))
        );
        
        $statement = $connection->prepare($sql);
        $statement->execute($new_user);
    } catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}
?>

<?php require "templates/header.php"; ?>

<?php if (isset($_POST['submit']) && $statement) { ?>
    <blockquote>Visit for <?php echo $_POST['vfirstname']; ?> successfully added.</blockquote>
<?php } ?>

<h5>Add a Visit</h5>

<form method="post">
    <label for="vfirstname">First Name:</label><br>
    <input type="text" name="vfirstname" id="vfirstname"><br>
    <label for="vlastname">Last Name:</label><br>
    <input type="text" name="vlastname" id="vlastname"><br>
    <label for="email">Email Address:</label><br>
    <input type="text" name="email" id="email"><br>
    <label for="meetinglocation">Meeting Location: (Room Number)</label><br>
    <input type="text" name="meetinglocation" id="meetinglocation"><br>
    <label for="meetingtime">Meeting Time: (HH:mm 24-Hour Format)</label><br>
    <input type="text" name="meetingtime" id="meetingtime"><br>
    <label for="vdate">Meeting Date: (YYYY-MM-DD)</label><br>
    <input type="text" name="vdate" id="vdate"><br><br>
    <input type="submit" name="submit" value="Submit">
</form>

<a href="index.php">Back to home</a>

<?php require "templates/footer.php"; ?>
