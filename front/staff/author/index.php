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
        <link href="../../css/bootstrap.min.css" rel="stylesheet">
    
        <!-- Main library CSS -->
        <link href="../../css/main-library.css" rel="stylesheet">

        <link rel="stylesheet" href="../../css/fontawesome-6.1.2/css/all.css">
        <!-- Link font library -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300&display=swap" rel="stylesheet">
  <style>
    
  </style>
    <script src="../js/controller/environment.js"></script>
		<meta charset="UTF-8" />
		<meta name="viewport"
			content="width=device-width, initial-scale=1.0" />
		<title>Book list</title>
	</head>
	<body style="background-image: linear-gradient(to bottom, #fdfdfd, #dee2e6);">
  <div class="container py-3">
    <header>

    </header>

		<div class="d-flex justify-content-center mt-5">
			<!-- <div class="spinner-border" role="status" id="loading"> >
				 <span class="sr-only">Loading...</span> >
			 </div> -->
		</div>
    <div class="row my-4">
        <div class="col-md-2 mx-auto text-center"></div>
        <div class="col-md-8 mx-auto text-center">
        </div>
        <div class="col-md-2 mx-auto text-center"></div>
    </div>
    <h2 class="my-4 text-center text-dark">เพิ่มหนังสือ</h2>
      <div class="row row-cols-1 row-cols-md-3 mb-3 text-center" id="add_book">
      </div>
  </div>

    

  <script src="../../js/libs/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script src="../../js/libs/jquery.min.js"></script>
  <script>
    var carouselWidth = $(".carousel-inner")[0].scrollWidth;
    var cardWidth = $(".carousel-item").width();
    var scrollPosition = 0;
    $(".carousel-control-next").on("click", function () {
      if (scrollPosition < (carouselWidth - cardWidth * 4)) { //check if you can go any further
        scrollPosition += cardWidth;  //update scroll position
        $(".carousel-inner").animate({ scrollLeft: scrollPosition },600); //scroll left
      }
    });
    $(".carousel-control-prev").on("click", function () {
      scrollPosition = 0;
      $(".carousel-inner").animate({ scrollLeft: 0 },100); //scroll to begin
    });

    let username = sessionStorage.getItem("username");
    if(username){
      document.getElementById("username").innerHTML = sessionStorage.getItem("userid")+" "+username;
      document.getElementById("btn_authen").innerHTML = `<a class="btn btn-outline-light" onclick="logout()" role="button">Logout</a>`; 
      document.getElementById("url_myborrow").href = "myborrow/index.php?id="+sessionStorage.getItem("userid");
    }
    else{
      document.getElementById("username").innerHTML = "";
      document.getElementById("btn_authen").innerHTML = `<a class="btn btn-outline-light" href="authen" role="button">Login</a>`; 
    }

    function logout(){
        sessionStorage.clear();
        location.reload();
    }
  </script>
	</body>
</html>
