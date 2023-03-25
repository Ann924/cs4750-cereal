<?php
require("connect_db.php");
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">  
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Lilian Zhang">
    <meta name="description" content="project">  
        
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom border-dark">
        <div class="container-fluid">
            <div class="col-4"></div>
            <div class="col-4 justify-content-center">
                <a class="navbar-brand navbar-nav mx-auto justify-content-center">Cereal</a>
            </div>
            <div class="col-4">
                <span class="navbar-nav ms-auto justify-content-end">account logo goes here</span>
            </div>
        </div>
    </nav>
    <div class="container-fluid">
        <div class="row mt-4 d-flex justify-content-center align-items-center">
            <div class="col-md-6 border border-dark bg-light">
                <div class="row mt-3 mb-3 mx-3 justify-content-center font-weight-bold">
                    <h2 class="text-center">Login</h2>
                    <i class="text-center text-secondary">Embark on your cereal journey today</i>
                </div>
                <form>
                    <div class="row mb-3 mx-3">
                        <input type="text" class="form-control" id="username" name="username" placeholder="username">
                    </div>
                    <div class="row mb-3 mx-3">
                        <input type="text" class="form-control" id="password" name="password" placeholder="password">
                    </div>
                    <div class="row mb-3 mx-3 justify-content-center">
                        <div class="col-8">
                            <div class="row">
                                <input type="submit" class="btn btn-primary" name="loginBtn" value="Login" title="login" />
                            </div>
                        </div>
                    </div>
                </form>
                <div class="row mb-3 mx-3 justify-content-center">
                    <h6 class="text-center"><i class="text-center text-secondary">Haven't signed up yet? Click below to begin.</i></h6>
                    
                    <div class="col-8">
                        <div class="row">
                            
                            <a href="signup.html" class="btn btn-primary" name="signupBtn" title="signup">Sign up</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>
