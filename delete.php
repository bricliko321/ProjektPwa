<?php
session_start();
include 'connect.php';


if (!isset($_SESSION['username'])) {
    header('Location: administracija.php'); 
    exit;
}


if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo '<p>Neispravan zahtjev za brisanjem vijesti.</p>';
    exit;
}

$id = $_GET['id'];


$query = "DELETE FROM vijestitablica WHERE id = ?";
$stmt = mysqli_prepare($dbc, $query);

if ($stmt) {
    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);

    if (mysqli_stmt_affected_rows($stmt) > 0) {
        echo '<p>Vijest je uspješno izbrisana.</p>';
    } else {
        echo '<p>Došlo je do pogreške prilikom brisanja vijesti.</p>';
    }

    mysqli_stmt_close($stmt);
} else {
    echo  "Greška prilikom pripreme upita: " . mysqli_error($dbc);
}

mysqli_close($dbc); 
?>
