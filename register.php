<?php
include("./components/navbar.php");
require_once './helpers/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $name = $_POST['name'];

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $role = isset($_POST['role']) ? $_POST['role'] : 'user';
    $mobile = $_POST['mobile'];
    $email = $_POST['email'];
    $address = $_POST['address'];

    $stmt = $pdo->prepare("INSERT INTO users (username, password, role, mobile, email, address ,name) VALUES (:username, :password, :role, :mobile, :email, :address, :name)");
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $hashedPassword);
    $stmt->bindParam(':name', $name);


    $stmt->bindParam(':role', $role);
    $stmt->bindParam(':mobile', $mobile);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':address', $address);
    $stmt->execute();

    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Register</title>
    <style>
        body {
            font-family: "Open Sans", sans-serif;
            font-size: 20px;
        }
    </style>
    <link rel="stylesheet" href="./styles/auth.css">

</head>
<style>
    #usernameMessage {
        display: none;
        /* เริ่มต้นซ่อนกล่องแสดงผล */
    }
</style>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var usernameInput = document.getElementById("username");
        var usernameMessage = document.getElementById("usernameMessage");

        usernameInput.addEventListener("blur", function() {
            var username = usernameInput.value;

            var xhr = new XMLHttpRequest();
            xhr.open("POST", "check_username.php", true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    var response = xhr.responseText;

                    // ตรวจสอบค่า response และแสดงหรือซ่อนกล่องตามเงื่อนไข
                    if (response.trim() !== "") {
                        usernameMessage.innerHTML = response;
                        usernameMessage.style.display = "block"; // แสดงกล่อง
                    } else {
                        usernameMessage.innerHTML = "";
                        usernameMessage.style.display = "none"; // ซ่อนกล่อง
                    }
                }
            };
            xhr.send("username=" + username);
        });
    });
</script>


<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        Register
                    </div>
                    <div class="card-body">
                        <form method="post">
                            <div id="usernameMessage" class="alert alert-danger"></div>
                            <div class="mb-3">
                                <label for="username" class="form-label">Username:</label>
                                <input type="text" class="form-control" id="username" name="username" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password:</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <div class="mb-3">
                                <label for="confirm_password" class="form-label">Confirm Password:</label>
                                <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                            </div>
                            <div class="mb-3">
                                <label for="mobile" class="form-label">Name:</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="mobile" class="form-label">Mobile:</label>
                                <input type="text" class="form-control" id="mobile" name="mobile" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email:</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="address" class="form-label">Address:</label>
                                <input type="text" class="form-control" id="address" name="address" required>
                            </div>

                            <div class="d-flex justify-content-between">
                                <button type="submit" class="btn btn-primary">Register</button>
                                <p>Already have an account? <a href="login.php">Login here</a>.</p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap JS -->
</body>

</html>