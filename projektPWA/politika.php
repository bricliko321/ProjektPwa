<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Naslov Stranice</title>
    <link rel="stylesheet" href="css.css">
</head>
<body>

<section class="politika">
        <div class="container">
            <h2>POLITIKA</h2>
            <div class="slike">
                <?php
                include 'connect.php';
                if (!defined('UPLPATH')) {
                    define('UPLPATH', 'img/');
                }
                
                $query = "SELECT * FROM vijestitablica WHERE kategorija='politika'";
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

</body>
 </html>
