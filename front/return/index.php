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
	<body>
        <div class="container py-3">
            <header>
                <div id="nav-placeholder"></div>
            </header>

            <div class="d-flex justify-content-center mt-5">
                <div>
                    <span class="sr-only">Return</span>
                </div>
            </div>
            <div class="row row-cols-1 row-cols-md-3 mb-3 text-center" id="bookList">
            </div>
            <div class="table-responsive">
                <table class="table text-center" id="bookTable"></table>
            </div>
        </div>
        <script src="../js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <script src="../js/jquery.min.js"></script>
        <script>
            $(function(){
            $("#nav-placeholder").load("../components/navbar.html");
            });
        </script>
	</body>
</html>
