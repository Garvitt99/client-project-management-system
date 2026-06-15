<?php

session_start();

if(!isset($_SESSION['admin']))
{
    header("Location: ../login.php");
    exit();
}

include("../includes/db.php");
include("../includes/header.php");

$query = "
SELECT
    projects.*,
    clients.client_name
FROM projects
INNER JOIN clients
ON projects.client_id = clients.client_id
ORDER BY project_id DESC
";

$result = mysqli_query($conn,$query);

?>

<h2>Project List</h2>

<a
href="add_project.php"
class="btn btn-success mb-3">

Add New Project

</a>

<table class="table table-bordered table-striped">

<tr>

<th>ID</th>
<th>Client</th>
<th>Project</th>
<th>Type</th>
<th>Budget</th>
<th>Payment</th>
<th>Status</th>
<th>Deadline</th>
<th>Actions</th>

</tr>

<?php

while($row = mysqli_fetch_assoc($result))
{
?>

<tr>

<td>
<?php echo $row['project_id']; ?>
</td>

<td>
<?php echo $row['client_name']; ?>
</td>

<td>
<?php echo $row['project_name']; ?>
</td>

<td>
<?php echo $row['project_type']; ?>
</td>

<td>
₹<?php echo $row['budget']; ?>
</td>

<td>
<?php echo $row['payment_status']; ?>
</td>

<td>
<?php echo $row['project_status']; ?>
</td>

<td>
<?php echo $row['deadline']; ?>
</td>

<td>

<a
href="edit_project.php?id=<?php echo $row['project_id']; ?>"
class="btn btn-warning btn-sm">

Edit

</a>

<a
href="delete_project.php?id=<?php echo $row['project_id']; ?>"
class="btn btn-danger btn-sm">

Delete

</a>

</td>

</tr>

<?php
}
?>

</table>

<?php
include("../includes/footer.php");
?>