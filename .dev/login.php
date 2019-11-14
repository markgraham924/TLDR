<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="stylesheet" type="text/css" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <link rel="stylesheet" type="text/css" href="footer-dark.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="img.css">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Home</title>
    </head>
    <body>
        <nav class="navbar navbar-light bg-light">
            <span class="navbar-brand mb-0 h1">TL; DL Spotify</span>
        </nav>
        <div class="container">
            <form action="newAuth.php" method="POST">
                <label>Admin Password: <input class="form-control" type="password" name="password" required></label>
                <label>New APP Name: <input class="form-control" type="text" name="appName" required></label>
                <button type="submit" class="btn btn-success">Submit</button>
            </form>
        </div>
        <div class="footer-dark">
            <footer>
                <div class="container">
                    <div class="row">
                        <div class="col-sm-6 col-md-3 item">
                            <h3>TLDL.dev</h3>
                            <ul>
                                <li><a href="index.php">Home</a></li>
                                <li><a href="redirect.php">Signup</a></li>
                            </ul>
                        </div>
                        <div class="col-sm-6 col-md-3 item">
                            <h3>More TL; DL</h3>
                            <ul>
                                <li><a href="https://github.com/markgraham924/TLDR">Github</a></li>
                                <li><a href="https://trello.com/b/em1SQhK9/tl-dl-spotify">Trello</a></li>
                            </ul>
                        </div>
                        <div class="col-md 6 item text">
                            <h3>TL; DL</h3>
                            <p>An asset of Layered Network managed within the GMPAUTO.co.uk network</p>
                        </div>
                        <div class="col item social">
                            <a href="https://twitter.com/MarkG924"><i class="icon ion-social-twitter"></i></a>
                            <a href="https://www.instagram.com/_mark.graham/"><i class="icon ion-social-instagram"></i></a>
                        </div>
                    </div>
                    <p class="copyright">Mark Graham (Layered Network) &copy; 2019</p>
                </div>
            </footer>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </body>
</html>