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

$clientQuery = mysqli_query(
    $conn,
    "SELECT * FROM clients
     WHERE client_id=$id"
);

$client = mysqli_fetch_assoc($clientQuery);

$projectQuery = mysqli_query(
    $conn,
    "SELECT * FROM projects
     WHERE client_id=$id"
);

$revenueQuery = mysqli_query(
    $conn,
    "SELECT SUM(budget) AS total
     FROM projects
     WHERE client_id=$id"
);

$revenue = mysqli_fetch_assoc($revenueQuery);

?>

<h2>Client Details</h2>

<div class="card p-4 mb-4">

<h4><?php echo $client['client_name']; ?></h4>

<p>
<strong>Email:</strong>
<?php echo $client['email']; ?>
</p>

<p>
<strong>Phone:</strong>
<?php echo $client['phone']; ?>
</p>

<p>
<strong>Company:</strong>
<?php echo $client['company_name']; ?>
</p>

<p>
<strong>Industry:</strong>
<?php echo $client['industry']; ?>
</p>

<p>
<strong>Address:</strong>
<?php echo $client['address']; ?>
</p>

</div>

<div class="card p-4">

<h4>Projects</h4>

<table class="table">

<tr>
<th>Project</th>
<th>Status</th>
<th>Budget</th>
</tr>

<?php

while($project =
mysqli_fetch_assoc($projectQuery))
{

?>

<tr>

<td>
<?php echo $project['project_name']; ?>
</td>

<td>
<?php echo $project['project_status']; ?>
</td>

<td>
₹<?php echo $project['budget']; ?>
</td>

</tr>

<?php
}
?>

</table>

<h4 class="mt-3">
Total Revenue:
₹<?php echo $revenue['total']; ?>
</h4>

</div>

<?php
include("../includes/footer.php");
?>