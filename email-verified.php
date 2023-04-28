<?php
$host = 'localhost';
$dbname = 'php_registration';
$user = 'root';
$password = '';

$conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


$id = $_POST['id'];
$verify = $_POST['verify'];

// prepare the query
$stmt = $conn->prepare("SELECT * FROM users WHERE user_id=$id");

// execute the query
$stmt->execute();

// fetch all the results as an array of associative arrays
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
foreach ($results as $row) {
    if ($row['code'] == $verify) {
        $stmt1 = $conn->prepare("UPDATE users SET verified = :verified where user_id = :id");

        $v = 1;
        // bind the parameters
        $stmt1->bindParam(':id', $id);
        $stmt1->bindParam(':verified', $v);

        // execute the query
        $stmt1->execute();
?>
        <script>
            alert('Email verified successfully');
            window.location.href = 'registration.php';
        </script>
    <?php
    } else {
    ?>
        <script>
            alert('Invalid Verification code');
            window.location.href = 'verify.php?id='+<?php echo $id ?>;
        </script>
<?php
    }
}

?>