<?php

/**
 * Function to query information based on 
 * a parameter: in this case, location.
 *
 */

if (isset($_POST['submit'])) {
    try  {
        
        require "../config.php";
        require "../common.php";

        $connection = new PDO($dsn, $username, $password, $options);

        $sql = "SELECT * 
                        FROM visitor
                        WHERE vlastname = :vlastname";

        $vlastname = $_POST['vlastname'];

        $statement = $connection->prepare($sql);
        $statement->bindParam(':vlastname', $vlastname, PDO::PARAM_STR);
        $statement->execute();

        $result = $statement->fetchAll();
    } catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}
?>
<?php require "templates/header.php"; ?>
        
<?php  
if (isset($_POST['submit'])) {
    if ($result && $statement->rowCount() > 0) { ?>
        <h2>Results</h2>

        <table>
            <thead>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email Address</th>
                    <th>Meeting Location</th>
		    <th>Meeting Date</th>
                    <th>Meeting Time</th>
                </tr>
            </thead>
            <tbody>
        <?php foreach ($result as $row) { ?>
            <tr>
                <td><?php echo escape($row["vfirstname"]); ?></td>
                <td><?php echo escape($row["vlastname"]); ?></td>
                <td><?php echo escape($row["email"]); ?></td>
                <td><?php echo escape($row["meetinglocation"]); ?></td>
                <td><?php echo escape($row["vdate"]); ?></td>
		<td><?php echo escape($row["meetingtime"]); ?></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
    <?php } else { ?>
        <blockquote>No results found for <?php echo escape($_POST['vlastname']); ?>.</blockquote>
    <?php } 
} ?> 

<h2>Find Visitors by Last Name</h2>

<form method="post">
    <label for="vlastname">Visitor Last Name</label>
    <input type="text" id="vlastname" name="vlastname">
    <input type="submit" name="submit" value="View Results">
</form>

<a href="index.php">Back to home</a>

<?php require "templates/footer.php"; ?>
