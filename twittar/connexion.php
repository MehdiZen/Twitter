<?php
session_start();//session_start() combiné à $_SESSION (voir en fin de traitement du formulaire) nous permettra de garder le pseudo en sauvegarde pendant qu'il est connecté, si vous voulez que sur une page, le pseudo soit (ou tout autre variable sauvegardée avec $_SESSION) soit retransmis, mettez session_start() au début de votre fichier PHP, comme ici
?><!DOCTYPE HTML>
<html>
	<head>
		<title>Script espace membre</title>
		<link rel='stylesheet' type='text/css' media='screen' href='style.css'>

	</head>
	<body>
		<a href="inscription.php">S'inscrire</a>
		<br>
		<a href="connexion.php">Se connecter</a>
		<br>

		<?php
		//si une session est déjà "isset" avec ce visiteur, on l'informe:
		if(isset($_SESSION['id'])){
			echo "Vous êtes déjà connecté, vous pouvez accéder à l'espace membre en <a href='espace-membre.php'>cliquant ici</a>.";
		} else {
			//si le formulaire est envoyé ("envoyé" signifie que le bouton submit est cliqué)
			if(isset($_POST['valider'])){
				//vérifie si tous les champs sont bien pris en compte:
				if(!isset($_POST['pseudo'],$_POST['mdp'])){
					echo "Un des champs n'est pas reconnu.";
				} else {
					//tous les champs sont précisés, on regarde si le membre est inscrit dans la bdd:
					//d'abord il faut créer une connexion à la base de données dans laquelle on souhaite regarder:
					$host = 'www.webacademie-project.tech';
					$dbname = 'twitter_academy_db';
					$username = 'wac209_user';
					$password = 'wac209';
					try {
						$mysqli = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
						$mysqli->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					} catch (PDOException $e) {
					}					if(!$mysqli) {
						echo "Erreur connexion BDD";
					} else {   

						//on défini nos variables:
						$Pseudo=htmlentities($_POST['pseudo'],ENT_QUOTES,"UTF-8");//htmlentities avec ENT_QUOTES permet de sécuriser la requête pour éviter les injections SQL, UTF-8 pour dire de convertir en ce format
						$Mdp=md5($_POST['mdp']);
						$req=mysqli_query($mysqli,"SELECT * FROM membres WHERE pseudo='$Pseudo' AND mdp='$Mdp'");
						//on regarde si le membre est inscrit dans la bdd:
						if(mysqli_num_rows($req)!=1){
							echo "Pseudo ou mot de passe incorrect.";
						} else {
							//pseudo et mot de passe sont trouvé sur une même colonne, on ouvre une session:
							$_SESSION['pseudo']=$Pseudo;
							echo "Vous êtes connecté avec succès $Pseudo! Vous pouvez accéder à l'espace membre en <a href='espace-membre.php'>cliquant ici</a>.";
							$TraitementFini=true;//pour cacher le formulaire
						}
					}
				}
			}
			if(!isset($TraitementFini)){//quand le membre sera connecté, on définira cette variable afin de cacher le formulaire
				?>
    <div class="centrer">
        <div class="card">
            <div class="card-header">
                <div class="text-header">Connexion</div>
            </div>
            <div class="card-body">
                <form method="post" action="connexion.php">
                    <div class="form-group">
                        <label for="username">Username:</label>
                        <input required="" class="form-control" name="pseudo" id="username" type="text">
                    </div>
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input required="" class="form-control" name="mdp" id="password" type="password">
                    </div>
                    <input type="submit" class="btn" value="Register" name="valider">    
                </form>
            </div>
        </div>
    </div>
				<?php
			}
		}
		?>
	</body>
</html>
