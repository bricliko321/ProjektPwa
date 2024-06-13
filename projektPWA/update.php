<?php
include 'connect.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $query = "SELECT * FROM vijestitablica WHERE id=?";
    $stmt = mysqli_prepare($dbc, $query);
    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_array($result);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $title = $_POST['naslov'];
        $about = $_POST['kratki_sadrzaj'];
        $content = $_POST['sadrzaj'];
        $category = $_POST['kategorija'];
        $archive = isset($_POST['arhiva']) ? 1 : 0;

        if ($_FILES['pphoto']['name']) {
            $picture = $_FILES['pphoto']['name'];
            $target_dir = 'img/' . $picture;
            move_uploaded_file($_FILES["pphoto"]["tmp_name"], $target_dir);
        } else {
            $picture = $row['slika'];
        }

        $updateQuery = "UPDATE vijestitablica SET naslov=?, sazetak=?, tekst=?, slika=?, kategorija=?, arhiva=? WHERE id=?";
        $updateStmt = mysqli_prepare($dbc, $updateQuery);
        mysqli_stmt_bind_param($updateStmt, 'sssssii', $title, $about, $content, $picture, $category, $archive, $id);
        mysqli_stmt_execute($updateStmt);

        header("Location: administracija.php");
        exit();
    }

    mysqli_stmt_close($stmt);
} else {
    header("Location: administracija.php");
    exit();
}

mysqli_close($dbc);
?>