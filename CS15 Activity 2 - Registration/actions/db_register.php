<?php
session_start();
include "db_config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Save current POST into session for repopulation
    $_SESSION['old'] = $_POST;

    $name     = trim($_POST["fullname"]);
    $email    = trim($_POST["email"]);
    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);
    $confirm  = trim($_POST["confirm_password"]);
    $gender   = $_POST["gender"] ?? '';
    $hobbies  = isset($_POST["hobbies"]) ? $_POST["hobbies"] : []; // keep as array for session
    $country  = $_POST["country"];

    // Prevent duplicate email
    $check = $conn->prepare("SELECT user_id FROM users WHERE email = ?");
    $check->bind_param("s", $email);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {
        header("Location: ../register.php?error=Email already taken");
        exit();
    }

    // Prevent duplicate username
    $check = $conn->prepare("SELECT user_id FROM users WHERE username = ?");
    $check->bind_param("s", $username);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {
        header("Location: ../register.php?error=Username already taken");
        exit();
    }

    // Match password
    if (empty($name) || empty($email) || empty($username) || empty($password) || empty($confirm) || empty($gender) || empty($country)) {
        header("Location: ../register.php?error=All fields are required");
        exit();
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../register.php?error=Invalid email format");
        exit();
    }

    if ($password !== $confirm) {
        header("Location: ../register.php?error=Passwords do not match");
        exit();
    }

    // Hash password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Convert hobbies array to string for DB
    $hobbiesStr = implode(", ", $hobbies);

    // Insert into DB
    $stmt = $conn->prepare("INSERT INTO users (name, email, username, password, gender, hobbies, country) 
                            VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $name, $email, $username, $hashedPassword, $gender, $hobbiesStr, $country);

    if ($stmt->execute()) {
        unset($_SESSION['old']); // clear old input on success

        $_SESSION['user_id'] = $stmt->insert_id;
        $_SESSION['username'] = $username;
        $_SESSION['name'] = $name;

        header("Location: ../landing.php?success=Registration successful!");
        exit();
    } else {
        header("Location: ../register.php?error=Registration unsuccessful");
        exit();
    }
}
