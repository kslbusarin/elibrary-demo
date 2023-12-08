<?php
    // include("../authen/check_authen.php");
?>
<!DOCTYPE html>
<html lang="en">
	<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <title>elibrary</title>
    
        <!-- Bootstrap core CSS -->
        <link href="../css/bootstrap.min.css" rel="stylesheet">

        <!-- Favicons -->
		<meta charset="UTF-8" />
		<meta name="viewport"
			content="width=device-width, initial-scale=1.0" />
		<title>Book list</title>
	</head>
	<body class="bg-light">
        <div class="container py-3">
            <header>
                <div id="nav-placeholder"></div>
            </header>
            <div class="d-flex justify-content-center mt-5">
                <div class="spinner-border"
                    role="status" id="loading">
                    <span class="sr-only">Loading...</span>
                </div>
		    </div>
            <div class="bg-white mt-5">
                <h5>Categories</h5>
                <div class="row row-cols-1 row-cols-md-4 mb-3 text-center" id="categoriesList">
                </div>
            </div>
        </div>
        <script src="../js/libs/bootstrap.bundle.min.js"></script>
        <script src="../js/libs/jquery.min.js"></script>
        <script>
            
            $(function(){
            $("#nav-placeholder").load("../components/navbar.html");
            });
        </script>
        <script src="../js/controller/environment.js"></script>
        <script src="../js/controller/categories/categories.js"></script>
	</body>
</html>
