<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Registration Form</title>
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
    // prepare the query
    $stmt = $conn->prepare("SELECT * FROM users");

    // execute the query
    $stmt->execute();

    // fetch all the results as an array of associative arrays
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);


    ?>
    <div class="registration">
        <h1>Registration Form</h1>
        <form method="post" action="register.php">
            <input type="text" name="username" placeholder="Username" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="tel" name="phone" placeholder="Phone" required>
            <button type="submit">Register</button>
        </form>
    </div>



    <div style="width: 90%; margin:0 auto 30px auto">
        <h2>All Users</h2>
        <table>

            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Verified</th>
                <th>Action</th>
            </tr>
            <?php
            // loop through the results and output them
            foreach ($results as $row) {
            ?>
                <tr>
                <td><?php echo $row['name']?></td>
                    <td><?php echo $row['email']?></td>
                    <td><?php echo $row['mobile']?></td>
                    <td><?php echo $row['verified'] == 1 ? 'Verified' : 'Not verified'?></td>

                    <?php
                    if($row['verified'] == 0){
                    ?>
                    <td><a href="verify.php?id=<?php echo $row['user_id']?>" style=" display: block;
    width: 100%;
    background: #4CAF50;
    color: #fff;
    border: none;
    text-align:center;
    border-radius: 5px;
    text-decoration:none;
    cursor: pointer;">Verify</a></td>
    <?php
    }else{
     echo "<td style='text-align:center; font-weight:bold'>Verified</td>";   
    }?>
                </tr><?php
                    }
                        ?>
        </table>
    </div>

</body>

</html>