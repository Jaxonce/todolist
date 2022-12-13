<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.0.1/mdb.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="./view/css/header.css" />
    <link rel="stylesheet" type="text/css" href="./view/css/style.css" />
</head>

<body>
    <header>
        <div class="header-blue" style="padding: 0;">
            <nav class="navbar navbar-dark navbar-expand-md navigation-clean-search" style="background-color: #0c63e4">
                <div class="container"><a class="navbar-brand" href="#"> ToDoListApp</a><button class="navbar-toggler" data-toggle="collapse" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
                    <div class="collapse navbar-collapse" id="navcol-1">
                        <ul class="nav navbar-nav">
                            <li class="nav-item" role="presentation"><a class="nav-link" href="?action=afficherListePublic"> Public lists </a></li>
                            <li class="nav-item" role="presentation"><a class="nav-link" href="?action=afficherListePrive"> Private lists </a></li>
                        </ul>
                        <form class="form-inline mr-auto" target="_self">
                        </form>
                        <?php if(! isset($_SESSION["role"])) { ?>
                            <span class="navbar-text"> <a href="?action=connexion" class="login">Log In</a></span>
                            <a class="btn btn-light action-button" role="button" href="?action=inscription">Sign Up</a>
                        <?php } else { ?>
                            <span class="navbar-text"> <a href="?action=deconnexion" class="login">Deconnexion</a></span>
                            <span ><?php echo $_SESSION["username"]; ?>  </span>
                        <?php } ?>
                    </div>
                </div>
            </nav>
        </div>
    </header>
    <form method="post" action="?action=ajoutListe<?php echo $type; ?>" style="display:flex!important;align-items:center; justify-content: center;">
        <input required placeholder="Add new list..." type="text" id="form3" name="nomListe" class="form-control form-control-lg" style="margin: 10px 10px 10px 10px;" />
        <button class="btn btn-primary" style="margin-right:10px;" type="submit">Add</button>
    </form>
    <section class="vh-100">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="pagination_section">
                    <?php if ($pageActuelle > 1) { ?>
                        <a href="?page=<?php echo $pageActuelle - 1    ?>">
                            << Précedent</a>
                            <?php }
                        if ($nbPages != 1) {
                            for ($i = 1; $i <= $nbPages; $i++) {
                                if ($i == $pageActuelle) {
                                    echo $i . ' ';
                                } else {
                                    echo '<a href="?page=' . $i . '">' . $i . '</a> ';
                                }
                            }
                        }

                        if ($pageActuelle < $nbPages) { ?>
                                <a href="?page=<?php echo $pageActuelle + 1    ?>">Suivant >></a>
                            <?php } ?>

                </div>
                <?php
                if (!isset($todoList)) {
                    throw new Exception("La liste n'existe pas");
                } else {
                    foreach ($todoList as $uneliste) {
                ?>
                        <div class="col" style="margin-bottom:20px!important">

                            <div class="card" style="border-radius: .75rem; background-color: #eff1f2; max-height:700px;">

                                <div class="card-body py-4 px-4 px-md-5">

                                    <p class="h1 text-center mt-3 mb-4 pb-3 text-primary">
                                        <i class="fas fa-check-square me-1"></i>
                                        <u> <?php
                                            echo $uneliste->getNom();
                                            ?></u>
                                    <form method="post" action="?action=supprimerListe<?php echo $type; ?> " class="boutonSupp" style="background: transparent;">
                                        <input type="hidden" name="idList" value="<?php echo $uneliste->getId() ?>" />
                                        <button type="submit" onclick="return confirm('Cette action est irréversible. Voulez-vous vraiment supprimer cette liste ? Les taches associées seront également supprimées.');" style="background : transparent; border : none">
                                            <img onmouseover="onImageDelete.call(this)" onmouseout="outImageDelete.call(this)" src="./view/assets/bin_empty.svg" />
                                        </button>
                                    </form>
                                    </p>

                                    <div class="pb-2">
                                        <div class="card">
                                            <div class="card-body">
                                                <div>
                                                    <form method="post" action="?action=ajoutTache<?php echo $type; ?>" class="d-flex flex-row align-items-center">
                                                        <input required name="nameTask" type="text" class="form-control form-control-lg" id="exampleFormControlInput1" placeholder="Add new..." style="margin-right:10px ">
                                                        <input type="hidden" name="idList" value="<?php echo $uneliste->getId() ?>" />
                                                        <div>
                                                            <button type="submit" class="btn btn-primary">Add</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr class="my-4">
                                    <div class="d-flex justify-content-end align-items-center mb-4 pt-2 pb-3">
                                        <p class="small mb-0 me-2 text-muted">Filter</p>
                                        <select class="select">
                                            <option value="1">All</option>
                                            <option value="2">Completed</option>
                                            <option value="3">Active</option>
                                            <option value="4">Has due date</option>
                                        </select>
                                        <p class="small mb-0 ms-4 me-2 text-muted">Sort</p>
                                        <select class="select">
                                            <option value="1">Added date</option>
                                            <option value="2">Due date</option>
                                        </select>
                                        <a href="#!" style="color: #23af89;" data-mdb-toggle="tooltip" title="Ascending"><i class="fas fa-sort-amount-down-alt ms-2"></i></a>
                                    </div>
                                    <div class="test" style="overflow-y: scroll;height: 200px;">
                                        <?php
                                        foreach ($uneliste->getTaches() as $uneTache) {
                                        ?>
                                            <ul class="list-group list-group-horizontal rounded-0 bg-transparent" style="display: flex; justify-content:space-between; width:-webkit-fill-available;">
                                                <li class="bg-transparent border-0 py-1 ps-0 pe-3 align-items-center d-flex list-group-item merde">



                                                    <input type="checkbox" value="" aria-label="..." class="strikethrough form-check-input" />
                                                    <span class="strikethrough-text lead fw-normal mb-0 d-flex"><?php echo $uneTache->getNom(); ?></span>
                                                </li>

                                                <li class="list-group-item ps-3 pe-0 py-1 rounded-0 border-0 bg-transparent">
                                                    <div class="d-flex flex-row justify-content-end mb-1">
                                                        <a href="#!" class="text-info" data-mdb-toggle="tooltip" title="Edit todo"><i class="fas fa-pencil-alt me-3"></i></a>
                                                        <form method="post" action="?action=supprimerTache<?php echo $type; ?>" class="boutonSupp" style="background: transparent;">
                                                            <input type="hidden" name="idTask" value="<?php echo $uneTache->getId() ?>" />
                                                            <button style="background: transparent ; border: none" type="submit" onclick="return confirm('Cette action est irréversible. Voulez-vous vraiment supprimer cette tache ?');" class="text-danger" data-mdb-toggle="tooltip" title="Delete todo"><i class="fas fa-trash-alt"></i></button>
                                                        </form>
                                                    </div>
                                                    <div class="text-end text-muted">
                                                        <a href="#!" class="text-muted" data-mdb-toggle="tooltip" title="Created date">
                                                            <p class="small mb-0"><?php echo $uneTache->getDateCreation(); ?></p>
                                                        </a>
                                                    </div>
                                                </li>

                                            </ul><?php
                                                }
                                                    ?>
                                    </div>


                                </div>

                            </div>
                        </div>
                <?php
                    }
                }
                ?>
            </div>
        </div>
    </section>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.0.1/mdb.min.js"></script>
    <script>
        function onImageDelete() {
            this.setAttribute("src", "./view/assets/bin_fill.svg");
        }

        function outImageDelete() {
            this.setAttribute("src", "./view/assets/bin_empty.svg");
        }
    </script>
</body>

</html>