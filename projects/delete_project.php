<?php

session_start();

if(!isset($_SESSION['admin']))
{
    header("Location: ../login.php");
    exit();
}

include("../includes/db.php");

if(isset($_GET['id']))
{
    $id = $_GET['id'];

    mysqli_query(
        $conn,
        "DELETE FROM projects
         WHERE project_id = $id"
    );
}

header("Location:view_projects.php");
exit();

?>