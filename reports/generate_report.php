<?php

session_start();

if(!isset($_SESSION['admin']))
{
    header("Location: ../login.php");
    exit();
}

$excelOutput = shell_exec("python ../python/report.py");
$csvOutput = shell_exec("python ../python/report_csv.py");

?>

<!DOCTYPE html>
<html>
<head>

<title>Reports</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
rel="stylesheet">

</head>

<body>

<div class="container mt-5">

<h2>Report Center</h2>

<div class="alert alert-success">

<?php echo $excelOutput; ?>

<br>

<?php echo $csvOutput; ?>

</div>

<a
href="/client-manager/reports/client_report.xlsx"
class="btn btn-success me-2"
download>

Download Excel Report

</a>

<a
href="/client-manager/reports/client_report.csv"
class="btn btn-primary"
download>

Download CSV Report

</a>

</div>

</body>

</html>