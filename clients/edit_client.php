<?php

session_start();

if(!isset($_SESSION['admin']))
{
    header("Location: ../login.php");
    exit();
}

include("../includes/db.php");
include("../includes/header.php");

$id = $_GET['id'];

$result = mysqli_query(
$conn,
"SELECT * FROM clients
WHERE client_id=$id"
);

$client = mysqli_fetch_assoc($result);

if(isset($_POST['update_client']))
{
    $name = $_POST['client_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $company = $_POST['company_name'];
    $industry = $_POST['industry'];
    $address = $_POST['address'];

    mysqli_query(
    $conn,
    "UPDATE clients
    SET
    client_name='$name',
    email='$email',
    phone='$phone',
    company_name='$company',
    industry='$industry',
    address='$address'
    WHERE client_id=$id"
    );

    header("Location:view_clients.php");
}

?>


<title>Edit Client</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
rel="stylesheet">

<div class="container mt-5">

<h2>Edit Client</h2>

<form method="POST">

<input
type="text"
name="client_name"
value="<?php echo $client['client_name']; ?>"
class="form-control mb-3">

<input
type="email"
name="email"
value="<?php echo $client['email']; ?>"
class="form-control mb-3">

<input
type="text"
name="phone"
value="<?php echo $client['phone']; ?>"
class="form-control mb-3">

<input
type="text"
name="company_name"
value="<?php echo $client['company_name']; ?>"
class="form-control mb-3">

<input
type="text"
name="industry"
value="<?php echo $client['industry']; ?>"
class="form-control mb-3">

<textarea
name="address"
class="form-control mb-3"><?php echo $client['address']; ?></textarea>

<button
type="submit"
name="update_client"
class="btn btn-primary">

Update Client

</button>

</form>

</div>

<?php
include("../includes/footer.php");
?>