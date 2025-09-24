<?php
session_start();
include "db_config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Save entered values for repopulation
    $_SESSION['old'] = $_POST;

    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);

    if (empty($username) || empty($password)) {
        header("Location: ../index.php?error=All fields are required");
        exit();
    }

    $stmt = $conn->prepare("SELECT user_id, name, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 1) {
        $stmt->bind_result($user_id, $name, $hashedPassword);
        $stmt->fetch();

        if (password_verify($password, $hashedPassword)) {
            // Successful login → clear old inputs
            unset($_SESSION['old']);

            $_SESSION["user_id"] = $user_id;
            $_SESSION["name"] = $name;

            header("Location: ../landing.php?success=Welcome back!");
            exit();
        } else {
            header("Location: ../index.php?error=Invalid password");
            exit();
        }
    } else {
        header("Location: ../index.php?error=No user found with this username");
        exit();
    }
}
