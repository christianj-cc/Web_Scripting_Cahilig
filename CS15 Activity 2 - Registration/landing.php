<?php
session_start();
if (!isset($_SESSION["user_id"])) {
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Registration Form</title>
    <link rel="stylesheet" href="style.css" />
</head>

<body class="landing-body">
    <section class="leftSection">
        <div class="container full-container">
            <h1>Hello, <?php echo htmlspecialchars($_SESSION["name"]); ?>!</h1>
            <p>Welcome to the landing page.</p>
            <br><br>
            <form id="logoutForm" action="actions/db_logout.php" method="post">
                <button type="submit" class="confirmTrigger">
                    Logout
                </button>
            </form>
        </div>
    </section>
    <section class="rightSection">
        <img src="assets/login.png" alt="login" />
    </section>
</body>

</html>