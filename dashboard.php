<?php

session_start();

if(!isset($_SESSION['admin']))
{
    header("Location: login.php");
    exit();
}

include("includes/db.php");
include("includes/header.php");


$notStarted = mysqli_num_rows(
    mysqli_query(
        $conn,
        "SELECT * FROM projects
         WHERE project_status='Not Started'"
    )
);

$inProgress = mysqli_num_rows(
    mysqli_query(
        $conn,
        "SELECT * FROM projects
         WHERE project_status='In Progress'"
    )
);

$onHold = mysqli_num_rows(
    mysqli_query(
        $conn,
        "SELECT * FROM projects
         WHERE project_status='On Hold'"
    )
);

$completed = mysqli_num_rows(
    mysqli_query(
        $conn,
        "SELECT * FROM projects
         WHERE project_status='Completed'"
    )
);

$totalClients = mysqli_num_rows(
    mysqli_query($conn,
    "SELECT * FROM clients")
);

$totalProjects = mysqli_num_rows(
    mysqli_query($conn,
    "SELECT * FROM projects")
);

$completedProjects = mysqli_num_rows(
    mysqli_query(
        $conn,
        "SELECT * FROM projects
         WHERE project_status='Completed'"
    )
);

$pendingProjects = mysqli_num_rows(
    mysqli_query(
        $conn,
        "SELECT * FROM projects
         WHERE project_status!='Completed'"
    )
);

$paidProjects = mysqli_num_rows(
    mysqli_query(
        $conn,
        "SELECT * FROM projects
         WHERE payment_status='Paid'"
    )
);

$pendingPayments = mysqli_num_rows(
    mysqli_query(
        $conn,
        "SELECT * FROM projects
         WHERE payment_status='Pending'"
    )
);

$budgetQuery = mysqli_query(
    $conn,
    "SELECT SUM(budget) AS total_budget
     FROM projects"
);

$budgetRow = mysqli_fetch_assoc($budgetQuery);

$totalBudget = $budgetRow['total_budget'];

$revenueQuery = mysqli_query(
$conn,
"
SELECT
clients.client_name,
SUM(projects.budget) AS revenue

FROM projects

INNER JOIN clients
ON projects.client_id =
clients.client_id

GROUP BY clients.client_name
"
);

$clientNames = [];
$revenues = [];

while($row =
mysqli_fetch_assoc($revenueQuery))
{
    $clientNames[] =
    $row['client_name'];

    $revenues[] =
    $row['revenue'];
}

?>



<div class="container mt-5">

<h2>
Welcome,
<?php echo $_SESSION['admin']; ?>
</h2>

<hr>

<div class="row">

<div class="col-md-4 mb-3">
<div class="card shadow p-3">
<h5>Total Clients</h5>
<h2><?php echo $totalClients; ?></h2>
</div>
</div>

<div class="col-md-4 mb-3">
<div class="card shadow p-3">
<h5>Total Projects</h5>
<h2><?php echo $totalProjects; ?></h2>
</div>
</div>

<div class="col-md-4 mb-3">
<div class="card shadow p-3">
<h5>Completed Projects</h5>
<h2><?php echo $completedProjects; ?></h2>
</div>
</div>

<div class="col-md-4 mb-3">
<div class="card shadow p-3">
<h5>Pending Projects</h5>
<h2><?php echo $pendingProjects; ?></h2>
</div>
</div>

<div class="col-md-4 mb-3">
<div class="card shadow p-3">
<h5>Paid Projects</h5>
<h2><?php echo $paidProjects; ?></h2>
</div>
</div>

<div class="col-md-4 mb-3">
<div class="card shadow p-3">
<h5>Pending Payments</h5>
<h2><?php echo $pendingPayments; ?></h2>
</div>
</div>

<div class="col-md-12 mb-3">
<div class="card shadow p-3">
<h5>Total Project Value</h5>
<h2>₹<?php echo $totalBudget; ?></h2>
</div>
</div>

</div>


<hr>

<h3>Recent Projects</h3>

<table class="table table-bordered">

<tr>
<th>Client</th>
<th>Project</th>
<th>Status</th>
<th>Budget</th>
</tr>

<?php

$recent = mysqli_query(
$conn,
"SELECT projects.*,
clients.client_name

FROM projects

INNER JOIN clients
ON projects.client_id =
clients.client_id

ORDER BY project_id DESC
LIMIT 5"
);

while($row = mysqli_fetch_assoc($recent))
{

?>

<tr>

<td>
<?php echo $row['client_name']; ?>
</td>

<td>
<?php echo $row['project_name']; ?>
</td>

<td>
<?php echo $row['project_status']; ?>
</td>

<td>
₹<?php echo $row['budget']; ?>
</td>

</tr>

<?php
}
?>

</table>

<hr>

<div class="card shadow p-4 mb-4">

<h3 class="text-center">
Project Status Distribution
</h3>

<div style="width:450px; margin:auto;">
    <canvas id="statusChart"></canvas>
</div>

</div>

<hr>

<div class="card shadow p-4 mb-4">

<h3 class="text-center">
Revenue By Client
</h3>

<div style="width:800px; margin:auto;">
    <canvas id="revenueChart"></canvas>
</div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

const ctx =
document.getElementById('statusChart');

new Chart(ctx, {

type: 'pie',

data: {

labels: [
'Not Started',
'In Progress',
'On Hold',
'Completed'
],

datasets: [{

data: [
<?php echo $notStarted; ?>,
<?php echo $inProgress; ?>,
<?php echo $onHold; ?>,
<?php echo $completed; ?>
]

}]

}

});

</script>

<script>

const revenueCtx =
document.getElementById('revenueChart');

new Chart(revenueCtx, {

type: 'bar',

data: {

labels:
<?php echo json_encode($clientNames); ?>,

datasets: [{

label: 'Revenue',

data:
<?php echo json_encode($revenues); ?>

}]

}

});

</script>

</div>

<?php include("includes/footer.php"); ?>

