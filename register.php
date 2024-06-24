<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Register</title>
<link rel="stylesheet" href="style.css">
<style>
  body {
    background-image: url('back.jpg');
    background-size: cover;
    background-position: center;
    font-family: Arial, sans-serif;
    margin-right: 20px;
    margin-bottom: 30px;
  }
  .container {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
  }
  .auth-form {
    background: rgba(255, 255, 255, 0.8); 
    padding: 20px;
    border-radius: 160px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    width: 300px;
  }
  .form-group {
    margin-bottom: 15px;
  }
  .form-group label {
    display: block;
    margin-bottom: 5px;
  }
  .form-group input {
    width: 100%;
    padding: 8px;
    box-sizing: border-box;
  }
  .form-toggle {
    text-align: center;
    margin-top: 10px;
  }
  .form-toggle a {
    color: #007BFF;
    text-decoration: none;
  }
  .form-toggle a:hover {
    text-decoration: underline;
  }
  .button-container {
    text-align: center;
  }
  #submitBtn {
    width: 50%;
    padding: 10px;
    background-color: #007BFF;
    border: none;
    color: white;
    cursor: pointer;
    border-radius: 20px;
  }
  #submitBtn:hover {
    background-color: #0056b3;
  }
</style>
</head>
<body>

<div class="container">
  <form id="authForm" class="auth-form" action="register.php" method="POST">
    <br>
    <center><h2 id="formTitle">Register</h2></center>
    <div class="form-group">
      <input type="email" id="email" name="email" placeholder="Enter Email" required>
    </div>
    <div class="form-group">
      <input type="password" id="password" name="password" placeholder="Enter Password" required>
    </div>
    <div class="button-container">
      <button type="submit" id="submitBtn">Register</button>
    </div>
    <div class="form-toggle">
      <a href="login.php" style="font-size:12px;">Already have an Account? Sign In</a> 
    </div>
    <br>
  </form>
</div>

<script src="script.js"></script>

<?php

include 'db.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = $_POST['email'];
    $password = $_POST['password'];
    

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Invalid email format');</script>";
        exit; 
    }

 
    if (strlen($password) < 8) {
        echo "<script>alert('Password must be at least 8 characters long');</script>";
        exit; 
    }

   
    $plainPassword = $password;

  
    $sql = "INSERT INTO users (email, password) VALUES ('$email', '$plainPassword')";
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('User registered successfully');</script>";

        header("Location: dashboard.php");
        exit;
    } else {
        echo "<script>alert('Error: " . $sql . "<br>" . $conn->error . "');</script>";
    }

    $conn->close(); 
}
?>
</body>
</html>
