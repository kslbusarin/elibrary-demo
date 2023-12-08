<!DOCTYPE html>
<html lang="en">
	<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="Sarayut">
        <meta name="generator" content="Sarayut">
        <title>elibrary</title>
    
        <!-- Bootstrap core CSS -->
        <link href="../css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    
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
			<div class="spinner-border"
				role="status" id="loading">
				<span class="sr-only">Loading...</span>
			</div>
		</div>
    <div class="row">
      <div class="col-12">
        <h3 id="category_name"></h3>
      </div>
    </div>
    <div class="row row-cols-1 row-cols-md-4 mb-3 text-center" id="bookList">
    </div>
    <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top"></footer>
      <div class="col-md-4 d-flex align-items-center">
        <a href="/" class="mb-3 me-2 mb-md-0 text-muted text-decoration-none lh-1">
          <svg class="bi" width="30" height="24"><use xlink:href="#bootstrap"/></svg>
        </a>
        <span class="mb-3 mb-md-0 text-muted">&copy; 2022 PSU</span>
      </div>

  </footer>
  <script src="../js/libs/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script src="../js/libs/jquery.min.js"></script>
  <script>
    $(function(){
    $("#nav-placeholder").load("../components/navbar.html");
    });
  </script>
  <script src="../js/controller/environment.js"></script>
  <script src="../js/controller/categories/categories_detail.js"></script>
	</body>
</html>
