<?php
session_start();
include 'connect.php'; 
define('UPLPATH', 'img/'); 


if (!isset($_SESSION['username'])) {
    header('Location: administracija.php'); 
    exit;
}


if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo '<p>Neispravan zahtjev za uređivanjem vijesti.</p>';
    exit;
}

$id = $_GET['id'];


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $title = $_POST['naslov'];
    $about = $_POST['kratki_sadrzaj'];
    $content = $_POST['sadrzaj'];
    $category = $_POST['kategorija'];
    $archive = $_POST['arhiva'];

    
    if ($_FILES['pphoto']['name']) {
        $picture = $_FILES['pphoto']['name'];
        $target_dir = 'img/' . $picture;
        move_uploaded_file($_FILES["pphoto"]["tmp_name"], $target_dir);
    } else {
        
        $query_slika = "SELECT slika FROM vijestitablica WHERE id = ?";
        $stmt_slika = mysqli_prepare($dbc, $query_slika);
        mysqli_stmt_bind_param($stmt_slika, 'i', $id);
        mysqli_stmt_execute($stmt_slika);
        $result_slika = mysqli_stmt_get_result($stmt_slika);
        $row_slika = mysqli_fetch_assoc($result_slika);
        $picture = $row_slika['slika'];
    }

 
    $updateQuery = "UPDATE vijestitablica SET naslov=?, sazetak=?, tekst=?, slika=?, kategorija=?, arhiva=? WHERE id=?";
    $updateStmt = mysqli_prepare($dbc, $updateQuery);

    if ($updateStmt) {
        mysqli_stmt_bind_param($updateStmt, 'sssssii', $title, $about, $content, $picture, $category, $archive, $id);
        mysqli_stmt_execute($updateStmt);

        
        header("Location: administracija.php");
        exit();
    } else {
        echo "Greška prilikom pripreme upita za ažuriranje: " . mysqli_error($dbc);
    }

    mysqli_stmt_close($updateStmt);
}


$query = "SELECT * FROM vijestitablica WHERE id = ?";
$stmt = mysqli_prepare($dbc, $query);

if ($stmt) {
    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) == 1) {
        
        $row = mysqli_fetch_assoc($result);
?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Uređivanje vijesti</title>
        </head>
        <body>
            <h2>Uređivanje vijesti</h2>
            <form action="" method="post" enctype="multipart/form-data">
                <label for="naslov">Naslov vijesti</label>
                <input type="text" id="naslov" name="naslov" value="<?php echo htmlspecialchars($row['naslov']); ?>">
                <div id="naslov-error" class="error-message"></div>

                <label for="kratki_sadrzaj">Kratki sadržaj vijesti (do 100 znakova)</label>
                <textarea id="kratki_sadrzaj" name="kratki_sadrzaj" maxlength="100"><?php echo htmlspecialchars($row['sazetak']); ?></textarea>
                <div id="kratki-sadrzaj-error" class="error-message"></div>

                <label for="sadrzaj">Sadržaj vijesti</label>
                <textarea id="sadrzaj" name="sadrzaj"><?php echo htmlspecialchars($row['tekst']); ?></textarea>
                <div id="sadrzaj-error" class="error-message"></div>

                <label for="kategorija">Kategorija vijesti</label>
                <select id="kategorija" name="kategorija">
                    <option value="politika" <?php if ($row['kategorija'] == 'politika') echo 'selected'; ?>>Politika</option>
                    <option value="arhiv" <?php if ($row['kategorija'] == 'arhiv') echo 'selected'; ?>>Arhiv</option>
                </select>
                <div id="kategorija-error" class="error-message"></div>

                <label for="slika">Slika</label>
                <input type="file" id="slika" name="pphoto">
                <?php if ($row['slika']): ?>
                    <img src="img/<?php echo htmlspecialchars($row['slika']); ?>" alt="Current Image" style="max-width: 100px;">
                <?php endif; ?>
                <div id="slika-error" class="error-message"></div>

                <label for="arhiva">Spremiti u arhivu:</label>
                <input type="checkbox" id="arhiva" name="arhiva" <?php if ($row['arhiva'] == 0) echo 'checked'; ?>>

                <div class="submit-buttons">
                    <button type="reset">Poništi</button>
                    <button type="submit">Spremi</button>
                </div>
            </form>
        </body>
        </html>
<?php
    } else {
        echo '<p>Vijest s ID ' . $id . ' ne postoji.</p>';
    }

    mysqli_stmt_close($stmt);
} else {
    echo  "Greška prilikom pripreme upita: " . mysqli_error($dbc);
}

mysqli_close($dbc); 
?>
