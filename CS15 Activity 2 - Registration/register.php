<?php
session_start();
$old = $_SESSION['old'] ?? []; // Get previously inputted info to repopulate after error
unset($_SESSION['old']); // Clear after use
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <title>Registration Form</title>
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
      <form id="registerForm" action="actions/db_register.php" method="POST">
        <h1>Register</h1>

        <label>Full Name</label>
        <input type="text" name="fullname" id="fullname"
          value="<?php echo htmlspecialchars($old['fullname'] ?? ''); ?>" required />

        <label>Email Address</label>
        <input type="email" name="email" id="email"
          value="<?php echo htmlspecialchars($old['email'] ?? ''); ?>" required />

        <label>Username</label>
        <input type="text" name="username" id="username"
          value="<?php echo htmlspecialchars($old['username'] ?? ''); ?>" required />

        <label>Password</label>
        <div class="password-container">
          <input type="password" name="password" id="register_password"
            value="<?php echo htmlspecialchars($old['password'] ?? ''); ?>" required />
          <i class="fa fa-eye" id="toggleRegisterPassword"></i>
        </div>

        <label>Confirm Password</label>
        <div class="password-container">
          <input type="password" name="confirm_password" id="confirm_password"
            value="<?php echo htmlspecialchars($old['confirm_password'] ?? ''); ?>" required />
          <i class="fa fa-eye" id="toggleConfirmPassword"></i>
        </div>

        <div class="formSection">
          <label>Gender</label>
          <input type="radio" name="gender" value="Male"
            <?php echo (isset($old['gender']) && $old['gender'] === 'Male') ? 'checked' : ''; ?> /> Male

          <input type="radio" name="gender" value="Female"
            <?php echo (isset($old['gender']) && $old['gender'] === 'Female') ? 'checked' : ''; ?> /> Female
        </div>

        <div class="formSection">
          <label>Hobbies</label>
          <input type="checkbox" name="hobbies[]" value="Reading"
            <?php echo (!empty($old['hobbies']) && in_array('Reading', $old['hobbies'])) ? 'checked' : ''; ?> /> Reading

          <input type="checkbox" name="hobbies[]" value="Sports"
            <?php echo (!empty($old['hobbies']) && in_array('Sports', $old['hobbies'])) ? 'checked' : ''; ?> /> Sports

          <input type="checkbox" name="hobbies[]" value="Music"
            <?php echo (!empty($old['hobbies']) && in_array('Music', $old['hobbies'])) ? 'checked' : ''; ?> /> Music
        </div>

        <div class="formSection">
          <label>Country</label>
          <select name="country" required>
            <option value="">-- Select --</option>
            <option value="USA" <?php echo (!empty($old['country']) && $old['country'] === 'USA') ? 'selected' : ''; ?>>USA</option>
            <option value="Philippines" <?php echo (!empty($old['country']) && $old['country'] === 'Philippines') ? 'selected' : ''; ?>>Philippines</option>
            <option value="UK" <?php echo (!empty($old['country']) && $old['country'] === 'UK') ? 'selected' : ''; ?>>UK</option>
          </select>
        </div>

        <button type="submit">Register</button>
        <p id="error"></p>
      </form>

      <p>Already have an account?&nbsp<a href="index.php">Login</a></p>
    </div>
  </section>

  <!-- ERROR MODAL -->
  <div id="errorModal" class="modal">
    <div class="modal-content">
      <!-- <span class="close">&times;</span> -->
      <p id="modalMessage">!</p>
    </div>
  </div>

  <p id="serverError" style="display: none">
    <?php echo isset($_GET['error']) ? htmlspecialchars($_GET['error']) : ''; ?>
  </p>
</body>

<!-- PASSWORD VALIDATION -->
<script>
  document
    .getElementById("registerForm")
    .addEventListener("submit", function(e) {
      let password = document.getElementById("password").value;
      let confirm = document.getElementById("confirm_password").value;
      let error = document.getElementById("error");

      if (password !== confirm) {
        e.preventDefault();
        error.textContent = "Passwords do not match!";
        error.style.color = "red";
      }
    });
</script>

<script src="modal.js"></script>
<script src="scripts.js"></script>

</html>