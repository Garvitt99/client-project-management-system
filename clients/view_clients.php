<?php

session_start();

if(!isset($_SESSION['admin']))
{
    header("Location: ../login.php");
    exit();
}

include("../includes/db.php");
include("../includes/header.php");

$search = "";

if(isset($_GET['search']))
{
    $search = $_GET['search'];

    $query =
    "SELECT * FROM clients
    WHERE client_name LIKE '%$search%'
    OR company_name LIKE '%$search%'
    OR email LIKE '%$search%'";
}
else
{
    $query = "SELECT * FROM clients";
}

$result = mysqli_query($conn,$query);

?>


<div class="container mt-5">

<h2>Clients</h2>

<form method="GET">

<div class="row">

<div class="col-md-10">

<input
type="text"
name="search"
class="form-control"
placeholder="Search Client">

</div>

<div class="col-md-2">

<button
class="btn btn-primary w-100">

Search

</button>

</div>

</div>

</form>

<br>

<a
href="add_client.php"
class="btn btn-success">

Add New Client

</a>

<br><br>

<table class="table table-bordered">

<tr>

<th>ID</th>
<th>Name</th>
<th>Email</th>
<th>Phone</th>
<th>Company</th>
<th>Industry</th>
<th>Action</th>

</tr>

<?php

while($row = mysqli_fetch_assoc($result))
{

?>

<tr>

<td><?php echo $row['client_id']; ?></td>

<td><?php echo $row['client_name']; ?></td>

<td><?php echo $row['email']; ?></td>

<td><?php echo $row['phone']; ?></td>

<td><?php echo $row['company_name']; ?></td>

<td><?php echo $row['industry']; ?></td>

<td>

<a
href="client_details.php?id=<?php echo $row['client_id']; ?>"
class="btn btn-info btn-sm">

View

</a>

<a
href="edit_client.php?id=<?php echo $row['client_id']; ?>"
class="btn btn-warning btn-sm">

Edit

</a>

<a
href="delete_client.php?id=<?php echo $row['client_id']; ?>"
class="btn btn-danger btn-sm">

Delete

</a>

</td>

</tr>

<?php

}

?>

</table>

</div>

<?php
include("../includes/footer.php");
?>