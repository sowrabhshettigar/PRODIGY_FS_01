<?php
session_start(); 

if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit;
}

include 'db.php';

$sql = "SELECT id, email FROM users";
$result = $conn->query($sql);

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $deleteSql = "DELETE FROM users WHERE id='$id'";
    if ($conn->query($deleteSql) === TRUE) {
        echo "<script>alert('User deleted successfully');</script>";
        header("Location: dashboard.php");
        exit;
    } else {
        echo "<script>alert('Error deleting user: " . $conn->error . "');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('back.jpg'); 
            background-size: cover;
            background-position: center;
            margin: 0;
            display: flex;
        }
        .navbar {
            background-color: rgba(0, 123, 255, 0.9); 
            padding: 20px;
            width: 230px;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .navbar h1 {
            color: white;
            margin-bottom: 20px;
        }
        .navbar a {
            color: white;
            text-decoration: none;
            margin: 15px 0;
            display: flex;
            align-items: center;
        }
        .navbar a i {
            margin-right: 10px;
        }
        .container {
            padding: 20px;
            margin-left: 270px; 
            flex-grow: 1;
            align-items: flex-start; 
            display: flex;
            flex-direction: column;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background: linear-gradient(to bottom, #fff, #f2f2f2);
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #007BFF;
            color: white;
        }
        .action-buttons a {
            margin-right: 10px;
            text-decoration: none;
            color: #007BFF;
        }
        .action-buttons a:hover {
            text-decoration: underline;
        }
        .action-buttons i {
            margin-right: 5px;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <h1>Admin Dashboard</h1>
        <a href="dashboard.php"><i class="fas fa-home"></i> Home</a>
        <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </div>

    <div class="container">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['id']}</td>
                                <td>{$row['email']}</td>
                                <td class='action-buttons'>
                                    <a href='dashboard.php?delete={$row['id']}'><i class='fas fa-trash-alt'></i> Delete</a>
                                </td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='3'>No users found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>

<?php
$conn->close(); 
?>
