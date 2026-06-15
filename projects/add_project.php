<?php

session_start();

if(!isset($_SESSION['admin']))
{
    header("Location:view_projects.php");
    exit();
}

include("../includes/db.php");
include("../includes/header.php");

if(isset($_POST['add_project']))
{
    $client_id = $_POST['client_id'];
    $project_name = $_POST['project_name'];
    $project_type = $_POST['project_type'];
    $budget = $_POST['budget'];
    $payment_status = $_POST['payment_status'];
    $project_status = $_POST['project_status'];
    $start_date = $_POST['start_date'];
    $deadline = $_POST['deadline'];
    $notes = $_POST['notes'];

    $sql = "INSERT INTO projects
    (
        client_id,
        project_name,
        project_type,
        budget,
        payment_status,
        project_status,
        start_date,
        deadline,
        notes
    )
    VALUES
    (
        '$client_id',
        '$project_name',
        '$project_type',
        '$budget',
        '$payment_status',
        '$project_status',
        '$start_date',
        '$deadline',
        '$notes'
    )";

    mysqli_query($conn,$sql);

    header("Location:view_projects.php");
}

$clients = mysqli_query(
    $conn,
    "SELECT * FROM clients"
);

?>

<h2>Add Project</h2>

<form method="POST">

<label>Client</label>

<select
name="client_id"
class="form-control mb-3"
required>

<option value="">
Select Client
</option>

<?php
while($client = mysqli_fetch_assoc($clients))
{
?>
<option
value="<?php echo $client['client_id']; ?>">
<?php echo $client['client_name']; ?>
</option>
<?php
}
?>

</select>

<input
type="text"
name="project_name"
class="form-control mb-3"
placeholder="Project Name"
required>

<input
type="text"
name="project_type"
class="form-control mb-3"
placeholder="Project Type">

<input
type="number"
name="budget"
class="form-control mb-3"
placeholder="Budget">

<label>Payment Status</label>

<select
name="payment_status"
class="form-control mb-3">

<option>Pending</option>
<option>Partial</option>
<option>Paid</option>

</select>

<label>Project Status</label>

<select
name="project_status"
class="form-control mb-3">

<option>Not Started</option>
<option>In Progress</option>
<option>On Hold</option>
<option>Completed</option>

</select>

<label>Start Date</label>

<input
type="date"
name="start_date"
class="form-control mb-3">

<label>Deadline</label>

<input
type="date"
name="deadline"
class="form-control mb-3">

<textarea
name="notes"
class="form-control mb-3"
placeholder="Notes"></textarea>

<button
type="submit"
name="add_project"
class="btn btn-success">

Add Project

</button>

</form>

<?php
include("../includes/footer.php");
?>