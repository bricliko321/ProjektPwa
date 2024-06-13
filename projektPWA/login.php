<?php
session_start();
include 'connect.php'; 

if (isset($_POST['prijava'])) {
    $korisnicko_ime = $_POST['username'];
    $lozinka = $_POST['lozinka'];

    $sql = "SELECT id, korisnicko_ime, lozinka, razina FROM korisnik WHERE korisnicko_ime = ?";

    
    $stmt = mysqli_stmt_init($dbc);
    if (mysqli_stmt_prepare($stmt, $sql)) {
       
        mysqli_stmt_bind_param($stmt, 's', $korisnicko_ime);
        
        
        mysqli_stmt_execute($stmt);
        
        
        mysqli_stmt_store_result($stmt);
        
        
        if (mysqli_stmt_num_rows($stmt) == 1) {
           
            mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password, $razina);
            
            
            mysqli_stmt_fetch($stmt);

            
            if (password_verify($lozinka, $hashed_password)) {
                
                $_SESSION['id'] = $id;
                $_SESSION['korisnicko_ime'] = $username;
                $_SESSION['razina'] = $razina;

                
                header('Location: administracija.php');
                exit();
            } else {
               
                echo '<p>Neispravna lozinka. Molimo pokušajte ponovno.</p>';
            }
        } else {
            
            echo '<p>Korisnik s tim korisničkim imenom ne postoji. <a href="registracija.php">Registrirajte se ovdje</a>.</p>';
        }

      
        mysqli_stmt_close($stmt);
    }

    
    mysqli_close($dbc);
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Prijava</title>
</head>
<body>
    <h2>Prijava</h2>
    <form method="POST" action="">
        <label for="username">Korisničko ime:</label><br>
        <input type="text" id="username" name="username" required><br><br>
        <label for="lozinka">Lozinka:</label><br>
        <input type="password" id="lozinka" name="lozinka" required><br><br>
        <input type="submit" name="prijava" value="Prijavi se">
    </form>
</body>
</html>
