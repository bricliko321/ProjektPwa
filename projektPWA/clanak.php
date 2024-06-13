<!DOCTYPE html>
<html lang="hr">
<head>
    <meta name="author" content="Igor Kundid">
    <meta name="description" content="Projektni zadatak">
    <meta name="keywords" content="Vijesti, Projekt">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Drzavne Vijesti</title>
    <link rel="stylesheet" href="css.css">
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
            <li><a href="#">ARHIV</a></li>
            <li><a href="administracija.php">ADMINISTRACIJA</a></li>
            <li><a href="unesiVijest.php">UNESI VIJEST</a></li>
        </ul>
    </nav>



    <?php
        include 'connect.php';
        define('UPLPATH', 'img/');

        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            
            $query = "SELECT * FROM vijestitablica WHERE id = '$id'";
            $result = mysqli_query($dbc, $query);
            
            if ($result && mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_array($result);
            } else {
                echo "<p>Article not found.</p>";
                exit;
            }
        } else {
            echo "<p>No article ID provided.</p>";
            exit;
        }
    ?>

    <main>
        <section role="main">
            <div class="row">
                <h2 class="category"><?php
                echo "<span>".$row['kategorija']."</span>";
                ?></h2>
                <h1 class="title"><?php
                echo $row['naslov'];
                ?></h1>
                <p>OBJAVLJENO: <?php
                echo "<span>".$row['datum']."</span>";
                ?></p>
            </div>
            <section class="slika">
                <?php
                    echo '<img src="' . UPLPATH . $row['slika'] . '">';
                ?>
            </section>
            <section class="about">
                <p>
                <?php
                    echo "<i>".$row['sazetak']."</i>";
                ?>
                </p>
            </section>
            <section class="sadrzaj">
                <p>
                <?php
                echo $row['tekst'];
                ?>
                </p>
            </section>
        </section>
    </main>

 </div>
 <footer>
            <p>DRŽAVNE VIJESTI - SVA PRAVA ZADRŽANA 2024</p>
    </footer>
</body>
</html>