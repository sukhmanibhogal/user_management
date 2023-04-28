<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Verification Form</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <?php
    $host = 'localhost';
    $dbname = 'php_registration';
    $user = 'root';
    $password = '';

    $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_GET['id']) {

        $id = $_GET['id'];
        // prepare the query
        $stmt = $conn->prepare("SELECT * FROM users where user_id=$id");

        // execute the query
        $stmt->execute();

        // fetch all the results as an array of associative arrays
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($results as $row) {

    ?>
            <div class="registration">
                <h1>Verification Form</h1>
                <form method="post" action="email-verified.php" >
                    <input type="text" readonly value="<?php echo $row['email'] ?>">
                    <input type="hidden" readonly value="<?php echo $row['user_id'] ?>" name="id">
                    <input type="text" name="verify" placeholder="Code" required>
                    <button type="submit" name="submit">Verify</button>
                </form>
            </div>
            <?php
        }

    }

    ?>
</body>

</html>