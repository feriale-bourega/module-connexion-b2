    <footer>
          <div class="foot-git">
            <h4 class="footer-titre-box">Retrouvez notre projet Github </h4>
            <a href="https://github.com/feriale-bourega/moduleconnexion2" target="blank">
              <i class="fab fa-github">Module connexion</i></a>
          </div>
          <div class="menu-footer">
            <?php
            if(empty($_SESSION))
            { 
                ?>
                <ul>
                
                    <li><a href="connexion.php">Connexion</a></li>
                    <li><a href="inscription.php">Inscription</a></li>
                </ul> 
            <?php }
            // accès admin
            elseif(!empty($userinfos) && $userinfos["id"] == "1337")
            {
            ?>
                <ul>
                    <li><a href="index.php">Accueil</a></li>
                    
                    <li><a href="profil.php">Profil</a></li>
                    
                    <li><a href="admin.php">Administration</a></li>
                    <li><a href="deconnexion.php">Déconnexion</a></li>
                </ul>  
            <?php }
            //accès modérateur
            elseif(!empty($userinfos) && $userinfos["id"] == "42")
            {
            ?>
                <ul>
                    <li><a href="index.php">Accueil</a></li>
                    
                    <li><a href="profil.php">Profil</a></li>
                    
                    <li><a href="deconnexion.php">Déconnexion</a></li>
                </ul>
            <?php }
            // accès utilisateur
            else
            {
            ?>
            <ul>
                <li><a href="index.php">Accueil</a></li>
                
                <li><a href="profil.php">Profil</a></li>
                <li><a href="deconnexion.php">Déconnexion</a></li>
            </ul>
            <?php
            }
            ?>
            </div>
    </footer>
  </body>
</html>
