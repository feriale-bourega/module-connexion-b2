<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Titre de la page</title>
  <link rel="stylesheet" href="style.css">
  <script src="script.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</head>
<body>
  ...
  <!-- Le reste du contenu -->
  <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active" data-bs-interval="10000">
      <img src="assets/images/paysage1.jpg" class="d-block w-100" alt="..." width="1200px"  height="300px">
    </div>
    <div class="carousel-item" data-bs-interval="2000">
      <img src="assets/images/paysage2.jpg" class="d-block w-100" alt="..." width="1200px"  height="300px">
    </div>
    <div class="carousel-item">
      <img src="assets/images/paysage3.jpg" class="d-block w-100" alt="..."  width="1200px"  height="300px">
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>...
<nav class="navbar bg-body-tertiary">
  <div class="container-fluid">
    <span class="navbar-brand mb-0 h1">Module Connexion</span>
  </div>
</nav>
<div  class="pad">
<div class="row row-cols-1 row-cols-md-3 g-4">
 
     <div class="col"  >
    <div class="card h-100">
      <img src="assets/images/inscription.png" class="card-img-top" alt="..."  width="80px" height="150px">
      <div class="card-body">
        <h5 class="card-title">Inscription</h5>
        <p class="card-text">Un formulaire d'inscription est un document qui permet de recueillir des informations sur une personne. L’objectif est de l'enregistrer dans un système ou de lui donner accès à un service ou à une activité. Il peut 
            être utilisé dans de nombreux contextes différents, comme l'inscription à un club, à une école ou à un événement.</p>
      </div>
      <div class="card-footer">
        <small class="text-body-secondary"><a href="inscription.php">Page inscription</a></small>
      </div>
    </div>
  </div>


  <div class="col">
    <div class="card h-100"  >
      <img src="assets/images/connexion.png" class="card-img-top" alt="..." width="80px" height="150px">
      <div class="card-body">
        <h5 class="card-title">Connexion</h5>
        <p class="card-text">Une page de connexion est une interface qui permet à un utilisateur de saisir ses informations d’identification pour accéder à un site web ou une application. Cette page est souvent appelée « page de connexion » ou « page
             d’authentification ». Elle est essentielle pour assurer la sécurité des données et des informations personnelles.</p>
      </div>
      <div class="card-footer">
        <small class="text-body-secondary"><a  href="connexion.php">Page connexion</a></small>
      </div>
    </div>
  </div>

  <div class="col" >
    <div class="card h-100"  >
      <img src="assets/images/profil.png" class="card-img-top" alt="..."  width="80px" height="150px">
      <div class="card-body">
        <h5 class="card-title">Profil</h5>
        <p class="card-text">Vous devez parfois modifier les paramètres de votre compte . Si vous avez un nouveau mot de passe,
            si votre fournisseur de messagerie vous a demandé de modifier les paramètres, ou si vous avez des 
            problèmes d’envoi et de réception de courrier électronique, vous pouvez modifier les paramètres de votre compte .</p>
      </div>
      <div class="card-footer">
        <small class="text-body-secondary"><a  href="profil.php">Modifier ses informations</a></small>
      </div>
    </div>
  </div>
</div>

</div>
</body>
</html>