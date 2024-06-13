<?php
include 'connect.php'; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $repeat_password = $_POST['repeat_password'];
    $ime = $_POST['ime'];
    $prezime = $_POST['prezime'];

    
    $query_check_username = "SELECT * FROM korisnik WHERE korisnicko_ime = '$username'";
    $result_check_username = mysqli_query($dbc, $query_check_username);
    if (mysqli_num_rows($result_check_username) > 0) {
        echo '<p>Korisničko ime već postoji. Molimo odaberite drugo korisničko ime.</p>';
    } else {
        
        if ($password != $repeat_password) {
            echo '<p>Lozinke se ne podudaraju. Molimo pokušajte ponovno.</p>';
        } else {
            
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            
            $query_insert_user = "INSERT INTO korisnik (korisnicko_ime, lozinka, ime, prezime) 
                                  VALUES ('$username', '$hashed_password', '$ime', '$prezime')";
            $result_insert_user = mysqli_query($dbc, $query_insert_user);

            if ($result_insert_user) {
                echo '<p>Registracija uspješna. Sada se možete <a href="administracija.php">prijaviti</a>.</p>';
            } else {
                echo '<p>Došlo je do pogreške prilikom registracije. Molimo pokušajte ponovno.</p>';
            }
        }
    }
}

mysqli_close($dbc); 
?>

<h2>Registracija novog korisnika</h2>
<form action="" method="post">
    <label>Korisničko ime:</label> <input type="text" name="username" required><br>
    <label>Lozinka:</label> <input type="password" name="password" required><br>
    <label>Ponovite lozinku:</label> <input type="password" name="repeat_password" required><br>
    <label>Ime:</label> <input type="text" name="ime" required><br>
    <label>Prezime:</label> <input type="text" name="prezime" required><br>
    <input type="submit" value="Registriraj se">
</form>

<p>Već imate korisnički račun? <a href="administracija.php">Prijavite se ovdje</a>.</p>
