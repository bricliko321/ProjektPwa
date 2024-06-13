<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Naslov Stranice</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="wrapper">
    <header>
        <h1>DRŽAVNE VIJESTI</h1>
    </header>
    
    <nav>
        <ul>
            <li><a href="index.php">POČETNA</a></li>
            <li><a href="politika.php">POLITIKA</a></li>
            <li><a href="arhiv.php">ARHIV</a></li>
            <li><a href="administracija.php">ADMINISTRACIJA</a></li>
            <li><a href="unesiVijest.php">UNESI VIJEST</a></li>
        </ul>
    </nav>
    
    <section class="politika">
        <div class="container">
            <h2>POLITIKA</h2>
            <div class="slike">
                <?php
                include 'connect.php';
                if (!defined('UPLPATH')) {
                    define('UPLPATH', 'img/');
                }
                
                $query = "SELECT * FROM vijestitablica WHERE arhiva=0 AND kategorija='politika' LIMIT 3";
                $result = mysqli_query($dbc, $query);
                
                while ($row = mysqli_fetch_array($result)) {
                    echo '<div class="slika-wrapper">';
                    echo '<a href="clanak.php?id=' . $row['id'] . '">';
                    echo '<img src="' . UPLPATH . $row['slika'] . '" alt="">';
                    
                    echo '<div class="prozor">';
                    echo '<div class="unutarnji-prozor">';
                    echo '<h4>' . $row['naslov'] . '</h4>';
                    echo '</div>'; 
                    echo '</div>'; 
                    
                    echo '</a>'; 
                    echo '</div>'; 
                }
                ?>
            </div> 
        </div> 
    </section> 

    <section class="arhiv">
        <div class="container">
            <h2>ARHIV</h2>
            <div class="slike">
                <?php
                
                $query = "SELECT * FROM vijestitablica WHERE arhiva=0 AND kategorija='arhiv' LIMIT 3";
                $result = mysqli_query($dbc, $query);
                
                while ($row = mysqli_fetch_array($result)) {
                    echo '<div class="slika-wrapper">';
                    echo '<a href="clanak.php?id=' . $row['id'] . '">';
                    echo '<img src="' . UPLPATH . $row['slika'] . '" alt="">';
                    
                    echo '<div class="prozor">';
                    echo '<div class="unutarnji-prozor">';
                    echo '<h4>' . $row['naslov'] . '</h4>';
                    echo '</div>'; 
                    echo '</div>'; 
                    
                    echo '</a>'; 
                    echo '</div>'; 
                }
                ?>
            </div> 
        </div> 
    </section> 

 

</div> 


<footer>
            <p>DRŽAVNE VIJESTI - SVA PRAVA ZADRŽANA 2024</p>
    </footer>
</body>
</html>
