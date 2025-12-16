<?php session_start(); include 'db.php'; ?>
<!DOCTYPE html>
<html>
<head>
<title>Admin Login</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container d-flex justify-content-center align-items-center vh-100">
  <div class="card shadow p-4" style="width: 350px;">
    <h4 class="text-center mb-3">Admin Login</h4>

    <form method="post">
      <div class="mb-3">
        <input type="text" name="username" class="form-control" placeholder="Username" required>
      </div>
      <div class="mb-3">
        <input type="password" name="password" class="form-control" placeholder="Password" required>
      </div>
      <button type="submit" name="login" class="btn btn-primary w-100">Login</button>
    </form>

    <?php
    if (isset($_POST['login'])) {
        $u = $_POST['username'];
        $p = md5($_POST['password']);
        $q = mysqli_query($conn, "SELECT * FROM admin WHERE username='$u' AND password='$p'");
        if (mysqli_num_rows($q) == 1) {
            $_SESSION['admin'] = $u;
            header("Location: dashboard.php");
        } else {
            echo "<div class='alert alert-danger mt-3'>Invalid credentials</div>";
        }
    }
    ?>
  </div>
</div>

</body>
</html>