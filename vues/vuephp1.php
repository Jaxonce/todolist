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
    <link rel="stylesheet" href="css/header.css"/>
</head>
<body>
    <header>
        <div class="header-blue" style="padding: 0;">
            <nav class="navbar navbar-dark navbar-expand-md navigation-clean-search" style="background-color: #0c63e4">
                <div class="container" ><a class="navbar-brand" href="#"> ToDoListApp</a><button class="navbar-toggler" data-toggle="collapse" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
                    <div class="collapse navbar-collapse" id="navcol-1">
                        <ul class="nav navbar-nav">
                            <li class="nav-item" role="presentation"><a class="nav-link" href="#"> Public lists </a></li>
                            <li class="nav-item" role="presentation"><a class="nav-link" href="#"> Private lists </a></li>
                        </ul>
                        <form class="form-inline mr-auto" target="_self">
                        </form><span class="navbar-text"> <a href="" class="login">Log In</a></span>
                        <a class="btn btn-light action-button" role="button" href="?action=inscription">Sign Up</a></div>
                </div>
            </nav>
        </div>
    </header>
    <form method="post" action="?action=ajoutListe">
        <input type="text" id="form3" class="form-control form-control-lg" name="nameNewListPublic"/>
        <button type="submit" class="btn btn-primary btn-lg ms-2">Add</button>
    </form>

    <?php
        if(! isset($todoListPublic)){
            echo "Pas de liste";
        }else {

            foreach ($todoListPublic as $uneliste) {


    ?>


    <div class="card" style="border-radius: 15px;">
        <div class="card-body p-5">
            <h6 class="mb-3">
                <?php
                            echo $uneliste->getNom();

                ?>
            </h6>
            <form class="d-flex justify-content-center align-items-center mb-4">
                <div class="form-outline flex-fill">
                    <input type="text" id="form3" class="form-control form-control-lg" />
                    <label class="form-label" for="form3">What do you need to do today?</label>
                </div>
                <button type="submit" class="btn btn-primary btn-lg ms-2">Add</button>
            </form>

            <ul class="list-group mb-0">
                <li
                        class="list-group-item d-flex justify-content-between align-items-center border-start-0 border-top-0 border-end-0 border-bottom rounded-0 mb-2">
                    <div class="d-flex align-items-center">
                        <input class="form-check-input me-2" type="checkbox" value="" aria-label="..." />
                        Cras justo odio
                    </div>
                    <a href="#!" data-mdb-toggle="tooltip" title="Remove item">
                        <i class="fas fa-times text-primary"></i>
                    </a>
                </li>

            </ul>

        </div>
    </div>
    <?php
            }
        }
    ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>


</body>
</html>
