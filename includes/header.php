<?php
if(session_status() == PHP_SESSION_NONE)
{
    session_start();
}
?>

<!DOCTYPE html>
<html>
<head>

<title>Client Manager</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
rel="stylesheet">

</head>

<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">

<div class="container">

<a class="navbar-brand"
href="/client-manager/dashboard.php">

Client Manager

</a>

<button
class="navbar-toggler"
type="button"
data-bs-toggle="collapse"
data-bs-target="#navbarNav">

<span class="navbar-toggler-icon"></span>

</button>

<div class="collapse navbar-collapse"
id="navbarNav">

<ul class="navbar-nav me-auto">

<li class="nav-item">
<a class="nav-link"
href="/client-manager/dashboard.php">
Dashboard
</a>
</li>

<li class="nav-item">
<a class="nav-link"
href="/client-manager/clients/view_clients.php">
Clients
</a>
</li>

<li class="nav-item">
    <a class="nav-link"
       href="/client-manager/projects/view_projects.php">
       Projects
    </a>
</li>

<li class="nav-item">
    <a class="nav-link"
       href="/client-manager/reports/generate_report.php">
       Reports
    </a>
</li>

</ul>

<ul class="navbar-nav">

<li class="nav-item">

<span class="navbar-text text-white me-3">

Welcome,
<?php
echo isset($_SESSION['admin'])
? $_SESSION['admin']
: 'Guest';
?>

</span>

</li>

<li class="nav-item">

<a class="btn btn-danger btn-sm"
href="/client-manager/logout.php">

Logout

</a>

</li>

</ul>

</div>

</div>

</nav>

<div class="container mt-4">