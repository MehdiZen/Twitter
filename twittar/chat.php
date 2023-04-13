
<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Page Title</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='/twittar/chat.css'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
        crossorigin="anonymous"></script>
    <script src='main.js'></script>
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"
        integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
</head>

<body>
<?php
    session_start();
    $id_sender = $_SESSION['id'];
    $host = 'www.webacademie-project.tech';
    $dbname = 'twitter_academy_db';
    $username = 'wac209_user';
    $password = 'wac209';
    try {
        $conn = new PDO(
            "mysql:host=$host;dbname=$dbname",
            $username,
            $password
        );
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
    }
    $recupUser = $conn->prepare("SELECT * FROM users WHERE id = $_SESSION[id]");
		$recupUser->execute();
		if ($recupUser->rowCount() > 0) {
            foreach ($recupUser as $key) {
            }
		} else {
			echo "Recommence";
		}
    ?>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg bg-light navbar-light">
        <!-- Container wrapper -->
        <div class="container-fluid">
            <!-- Navbar brand -->
            <a class="navbar-brand" href="/twittar/index.php">Brand</a>
            <!-- Search -->
            <form method="get" class="w-auto">
                <input name="search" type="search" class="form-control" placeholder="Type query" aria-label="Search" />
                <button name="searchy" class="btn btn-dark" type="submit">envoie ta grand mère</button>
            </form>
        </div>
        <a href="/twittar/deco.php"><button type="submit" class="btn" style="--bs-btn-padding-y: margin: 0!important;
	background-color: transparent;
	box-shadow: inset 0 0 0 1px #39b900;
	color: #39b900;
	border-radius: 2rem;
	width: 110px;">
					Déconnexion
				</button></a>
    </nav>
    <!-- Navbar -->
        <form method="post">
            <textarea id="area" value="ggggvghgg" name="message" id="" cols="30" rows="10"></textarea>
            <button name="chat" type="submit" id="button">tg fdp</button>
        </form>
    </div>

    
    <?php
    // search bar
    $id_receiver = $_GET['search'];
    $idsendto = $id_receiver;
    echo "idme = $id_sender<br>";
    echo "idsendto = $idsendto<br>";
    
    /*
    if (isset($_POST['searchy'])) {
    echo "<h1>$id_receiver<h1>";
    $sql = "SELECT id FROM users WHERE id = '$id_receiver'";
    $query = $conn->prepare($sql);
    // On exécute
    if ($query->execute()) {
    echo "Le poto est trouvé";
    $TraitementFini = true; //pour cacher le formulaire
    } else {
    echo 'Une erreur est survenue, merci de réessayer ou contactez-nous si le problème persiste.';
    }
    }
    */




    // message
    $message = $_POST['message'];
    if (isset($_POST['chat'])) {
        $sql = "INSERT INTO private_message (id_sender, id_receiver, message, date_send) VALUES ($id_sender, $idsendto, '$message', CURRENT_TIMESTAMP)";
        $query = $conn->prepare($sql);
        // On exécute
        if ($query->execute()) {
            echo " Envoie avec succès";
            $TraitementFini = true; //pour cacher le formulaire
        } else {
            echo 'Une erreur est survenue, merci de réessayer ou contactez-nous si le problème persiste.';
        }
    } else {
        echo "idsendto is not defined ($idsendto)\n";
    }
    ?>
   <div class="chat-container">
    <div class="message-box">
        <?php
        $recupUser = $conn->prepare("SELECT name FROM users WHERE id = $id_sender");
        $recupUser->execute();
        if ($recupUser->rowCount() > 0) {
            foreach ($recupUser as $key) {
                $me = $key[0];
            }
        }
        $recupUser = $conn->prepare("SELECT name FROM users WHERE id = $idsendto");
        $recupUser->execute();
        if ($recupUser->rowCount() > 0) {
            foreach ($recupUser as $key) {
                $to = $key[0];
            }
        }
        ?>
        <div class="message">
            <div class="message-header">
                <span class="username"><?php echo $me ?></span>
                <span class="timestamp"><?php echo date('h:i') ?></span>
            </div>
            <div class="message-content sent">
                <?php
                $recupUser = $conn->prepare("SELECT * FROM private_message WHERE id_sender = $_SESSION[id] AND id_receiver = $idsendto");
                $recupUser->execute();
                if ($recupUser->rowCount() > 0) {
                    foreach ($recupUser as $key) {
                        $mess = $key[2];
                        $datenow = substr($key[3], 11);
                        echo "J'ai envoyé : $mess à $to le $datenow<br>";
                    }
                } else {
                    echo "Recommence";
                }
                ?>
            </div>
        </div>
        <div class="message">
            <div class="message-header">
                <span class="username"><?php echo $to ?></span>
                <span class="timestamp"><?php echo date('h:i') ?></span>
            </div>
            <div class="message-content received">
                <?php
                $recupUser = $conn->prepare("SELECT * FROM private_message WHERE id_sender = $idsendto AND id_receiver = $_SESSION[id]");
                $recupUser->execute();
                if ($recupUser->rowCount() > 0) {
                    foreach ($recupUser as $key) {
                        $mess = $key[2];
                        $datenow = substr($key[3], 11);
                        echo "$to a envoyé : $mess à moi le $datenow<br>";
                    }
                } else {
                    echo "Recommence";
                }
                ?>
            </div>
        </div>
    </div>
</div>

</body>

</html>