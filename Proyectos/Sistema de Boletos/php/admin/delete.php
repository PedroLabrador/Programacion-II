<?php
    session_start();
    include '../../includes/config.php';
    $pdo = Database::getConnection();

    if (!$_SESSION['admin'])
        header ("Location:../../index.php");

    if (isset ($_GET['id'])) {
        $id = $_GET['id'];

        $sql = "DELETE FROM boletos WHERE id=$id";
        $query = $pdo->prepare ($sql);
        $query->execute ();

        header ("Location: list.php");
    }
?>
