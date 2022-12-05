<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/header.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">



    <title>Connexion</title>
</head>


<body>
<section class="mainSection" style="margin-top: 15vh;">
    <div class="px-4 py-5 px-md-5 text-center text-lg-start">
        <div class="container">
            <div class="row gx-lg-5 align-items-center">
                <div class="col-lg-6 mb-5 mb-lg-0">


                    <h1 class="my-5 display-3 fw-bold ls-tight">
                        Log<br />
                        <span class="text-primary">in</span>
                    </h1>
                    <p style="color: hsl(217, 10%, 50.8%)">
                        Online ToDoList for everybody
                    </p>
                </div>

                <div class="col-lg-6 mb-5 mb-lg-0">
                    <div class="card">
                        <div class="card-body py-5 px-md-5">

                            <form method="post" action="php/verif.php">

                                <div class="form-outline mb-4">
                                    <input id="email" class="form-control" name="email"/>
                                    <label class="form-label" for="email">Email address</label>
                                </div>

                                <div class="form-outline mb-4">
                                    <input id="password" class="form-control" name="password" />
                                    <label class="form-label" for="password">Password</label>
                                </div>


                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary btn-block mb-5" value="action">
                                        Log in
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
</body>
</html>
