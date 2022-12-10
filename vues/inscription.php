<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/header.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">



    <title>Inscription</title>
</head>


<body>
    <section class="mainSection" style="margin-top: 15vh;">
        <div class="px-4 py-5 px-md-5 text-center text-lg-start">
            <div class="container">
                <div class="row gx-lg-5 align-items-center">
                    <div class="col-lg-6 mb-5 mb-lg-0">


                        <h1 class="my-5 display-3 fw-bold ls-tight">
                            The best ToDo app<br />
                            <span class="text-primary">for you</span>
                        </h1>
                        <p style="color: hsl(217, 10%, 50.8%)">
                            Online ToDoList for everybody
                        </p>
                    </div>

                    <div class="col-lg-6 mb-5 mb-lg-0">
                        <div class="card">
                            <div class="card-body py-5 px-md-5">

                                <form method="post" action="?action=inscriptionUser">
                                    <div class="row">
                                        <div class="col-md-6 mb-4">
                                            <div class="form-outline">
                                                <input type="text" id="form3Example1" class="form-control" name="prenom" />
                                                <label class="form-label" for="form3Example1">First name</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-4">
                                            <div class="form-outline">
                                                <input type="text" id="form3Example2" class="form-control" name="nom"/>
                                                <label class="form-label" for="form3Example2">Last name</label>
                                            </div>
                                        </div>
                                    </div>

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
                                            Sign Up
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