<?php
session_start();
$old = $_SESSION['old'] ?? []; // Get previously inputted username to repopulate after error
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <title>Login Form</title>
  <link rel="stylesheet" href="style.css" />
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
</head>

<body>
  <section class="leftSection">
    <img src="assets/login.png" alt="login" />
  </section>
  <section class="rightSection">
    <div class="container">
      <form id="loginForm" action="actions/db_login.php" method="POST">
        <h1>Log In</h1>

        <label>Username</label>
        <input type="text" name="username" id="login_username" value="<?php echo htmlspecialchars($old['username'] ?? '') ?>" required />

        <label>Password</label>
        <div class="password-container">
          <input type="password" name="password" id="login_password" required />
          <i class="fa fa-eye" id="toggleLoginPassword"></i>
        </div>

        <button type="submit" class="confirmTrigger">Login</button>
        <p id="loginError"></p>
      </form>

      <p>Don't have an account?&nbsp<a href="register.php">Register</a></p>
    </div>
  </section>

  <!-- ERROR MODAL -->
  <div id="errorModal" class="modal">
    <div class="modal-content">
      <!-- <span class="close">&times;</span> -->
      <p id="modalMessage">
      </p>
    </div>
  </div>

  <p id="serverError" style="display: none">
    <?php echo isset($_GET['error']) ? htmlspecialchars($_GET['error']) : ''; ?>
  </p>
</body>

<script src="scripts.js"></script>

</html>