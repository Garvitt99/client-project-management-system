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

$project_query = mysqli_query(
    $conn,
    "SELECT * FROM projects
     WHERE project_id=$id"
);

$project = mysqli_fetch_assoc($project_query);

$clients = mysqli_query(
    $conn,
    "SELECT * FROM clients"
);

if(isset($_POST['update_project']))
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

    mysqli_query(
        $conn,
        "UPDATE projects SET

        client_id='$client_id',
        project_name='$project_name',
        project_type='$project_type',
        budget='$budget',
        payment_status='$payment_status',
        project_status='$project_status',
        start_date='$start_date',
        deadline='$deadline',
        notes='$notes'

        WHERE project_id=$id"
    );

    header("Location:view_projects.php");
    exit();
}

?>

<h2>Edit Project</h2>

<form method="POST">

<label>Client</label>

<select
name="client_id"
class="form-control mb-3">

<?php

while($client = mysqli_fetch_assoc($clients))
{
?>

<option
value="<?php echo $client['client_id']; ?>"

<?php
if($project['client_id']
== $client['client_id'])
{
    echo "selected";
}
?>

>

<?php
echo $client['client_name'];
?>

</option>

<?php
}
?>

</select>

<input
type="text"
name="project_name"
class="form-control mb-3"
value="<?php echo $project['project_name']; ?>">

<input
type="text"
name="project_type"
class="form-control mb-3"
value="<?php echo $project['project_type']; ?>">

<input
type="number"
name="budget"
class="form-control mb-3"
value="<?php echo $project['budget']; ?>">

<label>Payment Status</label>

<select
name="payment_status"
class="form-control mb-3">

<option <?php if($project['payment_status']=="Pending") echo "selected"; ?>>
Pending
</option>

<option <?php if($project['payment_status']=="Partial") echo "selected"; ?>>
Partial
</option>

<option <?php if($project['payment_status']=="Paid") echo "selected"; ?>>
Paid
</option>

</select>

<label>Project Status</label>

<select
name="project_status"
class="form-control mb-3">

<option <?php if($project['project_status']=="Not Started") echo "selected"; ?>>
Not Started
</option>

<option <?php if($project['project_status']=="In Progress") echo "selected"; ?>>
In Progress
</option>

<option <?php if($project['project_status']=="On Hold") echo "selected"; ?>>
On Hold
</option>

<option <?php if($project['project_status']=="Completed") echo "selected"; ?>>
Completed
</option>

</select>

<label>Start Date</label>

<input
type="date"
name="start_date"
class="form-control mb-3"
value="<?php echo $project['start_date']; ?>">

<label>Deadline</label>

<input
type="date"
name="deadline"
class="form-control mb-3"
value="<?php echo $project['deadline']; ?>">

<textarea
name="notes"
class="form-control mb-3"><?php echo $project['notes']; ?></textarea>

<button
type="submit"
name="update_project"
class="btn btn-primary">

Update Project

</button>

</form>

<?php
include("../includes/footer.php");
?>