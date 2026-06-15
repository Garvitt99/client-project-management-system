<?php

session_start();

if(!isset($_SESSION['admin']))
{
    header("Location: ../login.php");
    exit();
}

include("../includes/db.php");
include("../includes/header.php");

if(isset($_POST['add_client']))
{
    $name = $_POST['client_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $company = $_POST['company_name'];
    $industry = $_POST['industry'];
    $address = $_POST['address'];

    $sql = "INSERT INTO clients
    (
        client_name,
        email,
        phone,
        company_name,
        industry,
        address
    )
    VALUES
    (
        '$name',
        '$email',
        '$phone',
        '$company',
        '$industry',
        '$address'
    )";

    mysqli_query($conn,$sql);

    header("Location:view_clients.php");
}

?>



<title>Add Client</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
rel="stylesheet">


<div class="container mt-5">

<h2>Add Client</h2>

<form method="POST">

<input
type="text"
name="client_name"
class="form-control mb-3"
placeholder="Client Name"
required>

<input
type="email"
name="email"
class="form-control mb-3"
placeholder="Email"
required>

<input
type="text"
name="phone"
class="form-control mb-3"
placeholder="Phone">

<input
type="text"
name="company_name"
class="form-control mb-3"
placeholder="Company Name">

<input
type="text"
name="industry"
class="form-control mb-3"
placeholder="Industry">

<textarea
name="address"
class="form-control mb-3"
placeholder="Address"></textarea>

<button
type="submit"
name="add_client"
class="btn btn-success">

Add Client

</button>

<a
href="view_clients.php"
class="btn btn-secondary">

View Clients

</a>

</form>

</div>

<?php
include("../includes/footer.php");
?>