<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700">
    <link rel="stylesheet" href="./vues/css/header.css" />
    <link rel="stylesheet" type="text/css" href="./vues/css/style.css" />
</head>

<body>
    <header>
        <div class="header-blue" style="padding: 0;">
            <nav class="navbar navbar-dark navbar-expand-md navigation-clean-search" style="background-color: #0c63e4">
                <div class="container"><a class="navbar-brand" href="#"> ToDoListApp</a><button class="navbar-toggler" data-toggle="collapse" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
                    <div class="collapse navbar-collapse" id="navcol-1">
                        <ul class="nav navbar-nav">
                            <li class="nav-item" role="presentation"><a class="nav-link" href="#"> Public lists </a></li>
                            <li class="nav-item" role="presentation"><a class="nav-link" href="#"> Private lists </a></li>
                        </ul>
                        <form class="form-inline mr-auto" target="_self">
                        </form><span class="navbar-text"> <a href="?action=connexion" class="login">Log In</a></span>
                        <a class="btn btn-light action-button" role="button" href="?action=inscription">Sign Up</a>
                    </div>
                </div>
            </nav>
        </div>
    </header>
    <form method="post" action="?action=ajoutListePublic">
        <input type="text" id="form3" name="nameNewListPublic" />
        <button type="submit">Add</button>
    </form>
    <div class="allCard">
        <?php
        if (!isset($todoListPublic)) {
            echo "Pas de liste";
        } else {
            foreach ($todoListPublic as $uneliste) {
        ?>
                <div class=listeTask>
                    <form method="post" action="?action=supprimerListe" class="boutonSupp">
                        <input type="hidden" name="idList" value="<?php echo $uneliste->getId() ?>" />
                        <button type="submit" onclick="return confirm('Voulez-vous vraiment supprimer ?');" style="background : transparent; border : none" >
                            <img onmouseover="onImageDelete.call(this)" onmouseout="outImageDelete.call(this)" src="./vues/assets/bin_empty.svg"/>
                        </button>
                    </form>
                    <div class="taskInTheList">
                        <h6 class="taskTitle">
                            <?php
                            echo $uneliste->getNom();
                            ?>
                        </h6>
                        <form class="formAddTask">
                            <div>
                                <input type="text" id="form3" class="inputAddTask" placeholder="What do you need to do today?" />
                                <label for="form3"></label>
                            </div>
                            <button type="submit" class="btn btn-primary btn-sm">Add</button>
                        </form>
                        <ul class="allTask">
                            <?php
                            foreach ($uneliste->getTaches() as $uneTache) {
                            ?>
                                <li class="taskList">
                                    <div>
                                        <input type="checkbox" value="" aria-label="..." class="strikethrough" />
                                        <span class="strikethrough-text"><?php echo $uneTache->getNom(); ?></span>
                                    </div>
                                    <a href="#!" data-mdb-toggle="tooltip" title="Remove item">
                                        supprimer
                                    </a>
                                </li>
                            <?php
                            }
                            ?>
                        </ul>
                    </div>
                </div>
        <?php
            }
        }
        ?>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>
    <script>
        function onImageDelete() {
            this.setAttribute("src","./vues/assets/bin_fill.svg");
        }
        function outImageDelete() {
            this.setAttribute("src","./vues/assets/bin_empty.svg");
        }
    </script>
</body>

</html>