<?php
include 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $picture = $_FILES['pphoto']['name'];
    $title = $_POST['naslov'];
    $about = $_POST['kratki_sadrzaj'];
    $content = $_POST['sadrzaj'];
    $category = $_POST['kategorija'];
    $date = date('d.m.Y.');
    $archive = isset($_POST['arhiva']) ? $_POST['arhiva'] : 0; 

    
    $target_dir = 'img/' . $picture;
    if (move_uploaded_file($_FILES["pphoto"]["tmp_name"], $target_dir)) {
        $stmt = mysqli_prepare($dbc, "INSERT INTO vijestitablica (datum, naslov, sazetak, tekst, slika, kategorija, arhiva) VALUES (?, ?, ?, ?, ?, ?, ?)");

        mysqli_stmt_bind_param($stmt, 'ssssssi', $date, $title, $about, $content, $picture, $category, $archive);

        if (mysqli_stmt_execute($stmt)) {
            echo "Record inserted successfully.";
        } else {
            echo "Error: " . mysqli_stmt_error($stmt);
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "Error uploading the file.";
    }

    mysqli_close($dbc);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forma za vijesti</title>
    <link rel="stylesheet" href="css.css">
</head>
<body>
    <h1 class="title">Forma za unos vijesti</h1>
    <form id="formaVijesti" action="unesiVijest.php" method="post" enctype="multipart/form-data">
        <div class="form-item">
            <span id="porukaNaslov" class="bojaPoruke"></span>
            <label for="naslov">Naslov vijesti:</label><br>
            <input type="text" id="naslov" name="naslov" required><br><br>
        </div>
        <div class="form-item">
            <span id="porukaKratkiSadrzaj" class="bojaPoruke"></span>
            <label for="kratki_sadrzaj">Kratki sadržaj:</label><br>
            <textarea id="kratki_sadrzaj" name="kratki_sadrzaj" rows="4" cols="50" required></textarea><br><br>
        </div>
        <div class="form-item">
            <span id="porukaSadrzaj" class="bojaPoruke"></span>
            <label for="sadrzaj">Sadržaj vijesti:</label><br>
            <textarea id="sadrzaj" name="sadrzaj" rows="8" cols="50" required></textarea><br><br>
        </div>
        <div class="form-item">
            <span id="porukaSlika" class="bojaPoruke"></span>
            <label for="slika">Odaberi sliku:</label><br>
            <input type="file" id="slika" name="pphoto" accept="image/*" required><br>
            <small>(Dozvoljeni formati: JPG, JPEG, PNG)</small><br><br>
        </div>
        <div class="form-item">
            <span id="porukaKategorija" class="bojaPoruke"></span>
            <label for="kategorija">Kategorija:</label>
            <select id="kategorija" name="kategorija" required>
                <option value="" disabled selected>Odabir kategorije</option>
                <option value="politika">politika</option>
                <option value="arhiv">arhiv</option>
            </select><br><br>
        </div>
        <div class="form-item">
            <label>Spremiti u arhivu:</label><br>
            <input type="checkbox" id="arhiviranje" name="arhiva"><br><br>
        </div>
        <div class="form-item">
            <button type="reset">Poništi</button>
            <button type="submit" id="slanje">Prihvati</button>
        </div>
    </form>

    <script src="validacija.js"></script>
</body>
</html>
