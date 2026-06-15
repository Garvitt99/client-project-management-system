<?php

session_start();

include("includes/db.php");
include("includes/header.php");
include("includes/footer.php");

$error = "";

if(isset($_POST['login']))
{
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM admin
              WHERE username='$username'";

    $result = mysqli_query($conn,$query);

    if(mysqli_num_rows($result)==1)
    {
        $admin = mysqli_fetch_assoc($result);

        if(password_verify(
            $password,
            $admin['password']
        ))
        {
            $_SESSION['admin']
            = $admin['username'];

            header("Location: dashboard.php");
            exit();
        }
        else
        {
            $error = "Invalid Password";
        }
    }
    else
    {
        $error = "Invalid Username";
    }
}

?>

<!DOCTYPE html>
<html>

<head>

<title>Login</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
rel="stylesheet">

</head>

<body class="bg-light">

<div class="container">

<div class="row justify-content-center">

<div class="col-md-4">

<div class="card mt-5 shadow">

<div class="card-header">

<h3 class="text-center">
Admin Login
</h3>

</div>

<div class="card-body">

<?php

if($error!="")
{
    echo "<div class='alert alert-danger'>
            $error
          </div>";
}

?>

<form method="POST">

<div class="mb-3">

<label>Username</label>

<input
type="text"
name="username"
class="form-control"
required>

</div>

<div class="mb-3">

<label>Password</label>

<input
type="password"
name="password"
class="form-control"
required>

</div>

<button
type="submit"
name="login"
class="btn btn-primary w-100">

Login

</button>

</form>

</div>

</div>

</div>

</div>

</div>

</body>

</html>