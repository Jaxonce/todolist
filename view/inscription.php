<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/header.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">



    <title>Inscription</title>
</head>


<body style="background-color: #ececec!important;">
    <div class="d-flex justify-content-end">
        <a href="index.php">
            <img src="./view/assets/close.svg" />
        </a>
    </div>
    <section class="mainSection" style="margin-top: 15vh;">
        <div class="px-4 py-5 px-md-5 text-center text-lg-start">
            <div class="container">
                <div class="row gx-lg-5 align-items-center">
                    <div class="col-lg-6 mb-5 mb-lg-0">


                        <h1 class="my-5 display-3 fw-bold ls-tight" style="color: #2f435e">
                            La meilleure ToDo app<br />
                            <span class="text-primary">pour vous</span>
                        </h1>
                        <p style="color: hsl(217, 10%, 50.8%)">
                            ToDoList en ligne pour tout le monde
                        </p>
                    </div>

                    <div class="col-lg-6 mb-5 mb-lg-0">
                        <div class="card">
                            <div class="card-body py-5 px-md-5" style="background-color: #ececec!important; border: 1px solid #2f435e!important; border-radius: 0.25em">

                                <form method="post" action="?action=inscriptionUser" style="background-color: #ececec!important; border-color:#2f435e!important">
                                    <div class="form-outline mb-4">
                                        <div class="form-outline">
                                            <input type="text" id="form3Example1" name="username" class="form-control" required style="background-color: #ececec!important; border-color:#2f435e"/>
                                            <label class="form-label" for="form3Example1">Nom d'utilisateur</label>
                                        </div>
                                    </div>

                                    <div class="form-outline mb-4">
                                        <input id="email" class="form-control" name="email" type="email" required style="background-color: #ececec!important; border-color:#2f435e"/>
                                        <label class="form-label" for="email">Addresse mail</label>
                                    </div>

                                    <div class="form-outline mb-4">
                                        <input id="password" class="form-control" name="password" type="password" required style="background-color: #ececec!important; border-color:#2f435e"/>
                                        <label class="form-label" for="password">Mot de passe</label>
                                    </div>


                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary btn-block mb-5" style="background-color: #2f435e; border-color:#2f435e" value="action">
                                            S'inscrire
                                        </button>
                                    </div>


                                </form>
                                <?php
                                if (isset($erreurConnexion)) {
                                    echo '<div class="alert alert-danger" role="alert">' . $erreurConnexion . '</div>';
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>