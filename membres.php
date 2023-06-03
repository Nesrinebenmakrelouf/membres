<!DOCTYPE html>
<html>
<head>
    <title>Membres</title>
    <link rel="stylesheet" href="styles.css" />
</head>
<body>
    <section id="header">
    <img src="logo.png" height="70px" width="140px" id="logo">
        <div>
            <ul id="navbar">
                <li><a class="active" href="acceuil.php">Accueil</a></li>
                <li><a  href="Apropos.php">À propos</a></li>
                <li><a href="membres.php">Membres</a></li>

                <li class="dropdown">
                  <a href="publication.php" class="dropdown-toggle" id="publications-dropdown">Publications</a>
                  <ul class="dropdown-menu" aria-labelledby="publications-dropdown">
                      <li><a href="publication.php">Publication et Communication</a></li>
                      <li><a href="publication.php">Theses et mémoires</a></li>
                      <li><a href="publication.php">Evenements Scientifiques</a></li>
                  </ul> 
              </li>
              <li class="dropdown">
                  <a href="projet.php" class="dropdown-toggle" id="projets-dropdown">Projets</a>
                  <ul class="dropdown-menu" aria-labelledby="projets-dropdown">
                      <li><a href="projet.php">Nationaux</a></li>
                      <li><a href="projet.php">Internationaux</a></li>
                  </ul>  
              </li>
              
              </li>
                <li><a href="contact.php">Contact</a></li>
                
            </ul>
        </div>
    </section>
   <div class="titre1"> <h1>  Equipes et Membres d'equipes    </h1>
     
  </div>
    <?php
    // Connexion à la base de données (à adapter avec vos paramètres de connexion)
    $host = 'localhost';
    $db = 'lrdsi';
    $user = 'root';
    $password = '';

    $dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ];
    try {
        $pdo = new PDO($dsn, $user, $password, $options);
    } catch (PDOException $e) {
        die('Erreur de connexion à la base de données : ' . $e->getMessage());
    }

    // Récupérer les équipes et leurs membres depuis la base de données
    $stmt = $pdo->query('SELECT equipe.nomeq AS nom_equipe, 
                                membre.nom AS nom_membre,
                                membre.prenom AS prenom_membre,
                                membre.grade AS grade_membre, 
                                membre.adrs_email AS email_membre
                        FROM membre
                        INNER JOIN equipe ON membre.id_eq = equipe.id_eq');

    $equipes = $stmt->fetchAll(PDO::FETCH_GROUP);

    // Afficher les informations des équipes et de leurs membres
    foreach ($equipes as $nomEquipe => $membres) {

        echo '
        <p class="nom-equipe">   <img src="equipe.png" alt="" id="imge"> • ' . $nomEquipe . '</p>';echo '<br>';
        
        // Récupérer le chef d'équipe
        $chefEquipe = $membres[0];
        echo '<p class="divchef"> <b>Chef équipe:</b> ' . $chefEquipe['nom_membre'] . ' ' . $chefEquipe['prenom_membre'] . '</p>';
        
        // Afficher les autres membres
        echo '<p class="divmembre"><b>Membres:</b></p>';echo '<br>';
        echo '<ul>';
        foreach ($membres as $membre) {
            // Vérifier si le membre est le chef d'équipe pour ne pas le répéter
            if ($membre !== $chefEquipe) {
               
                echo '<p class="infomembre">'.$membre['nom_membre'] . ' ' . $membre['prenom_membre'] . ' - ' . $membre['grade_membre'] . '</p>';
                if (!empty($membre['email_membre'])) {
                    echo '<p class="mail"> '.$membre['email_membre'] . '</p>';
                }
                echo '</li>';
                echo '<br>';
            }
        }
        
        echo '</ul>';
        
    }
    ?>
 <section>
            <!--Start Footer -->
            <br><div class="footer" Align="center"> <br>
              <img src="logo.png" height="75px" width="160px" id="logo" Align="left">
              <img src="logo.png" height="75px" width="160px" id="logo" Align="right">
              <h3>LABORATOIRE DE RECHERCHE POUR LE DEVELOPPEMENT DES SYSTEMES INFORMATISES <br> Université Saad Dahlab - Blida 1  |  Faculté des Sciences  </h3> <br>
              <h2>Tel: + 213 (0)25 27 24 36  <br> Email: lrdsi@univ-blida.dz</h2>
              <br><p class="copyright"> &copy; 2023 All Rights Reserved to LRDSI</p>
            </div>
      
          </section> 
</body>
</html>