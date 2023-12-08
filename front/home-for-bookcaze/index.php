<?php
include("../authen/check_authen.php");
?>
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
        <link href="../css/bootstrap.min.css" rel="stylesheet">
    
        <!-- Main library CSS -->
        <link href="../css/main-library.css" rel="stylesheet">
        <!-- <link rel="stylesheet" href="../frontend/new_bootstrap/css/custom.css"> -->

        <link rel="stylesheet" href="../css/fontawesome-6.1.2/css/all.css">
        <!-- Link font library -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300&display=swap" rel="stylesheet">
    <style>
      
    </style>
    <!-- <script src="js/controller/environment.js"></script> -->
		
		<meta charset="UTF-8" />
		<meta name="viewport"
			content="width=device-width, initial-scale=1.0" />
		<title>Book list</title>
	</head>
	<body style="background-image: linear-gradient(to bottom, #fdfdfd, #dee2e6);">
  <div class="container py-3">
    <header>
      <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-primary">
        <div class="container-fluid">
          <a class="navbar-brand" href="../../">eLibrary</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav me-auto mb-2 mb-md-0">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">หน้าแรก</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="../search">ค้นหา</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="../categories">หมวดหมู่</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="url_myborrow" href="">หนังสือของฉัน</a>
              </li>
            </ul>
            <form class="d-flex">
              <div class="text-white mt-1 me-2" id="txt_username"></div>
              <!-- <a class="btn btn-outline-light" href="authen" role="button">Login</a> -->
              <div id="btn_authen"></div>
            </form>
          </div>
        </div>
      </nav>
    </header>

		<div class="d-flex justify-content-center mt-5">
			<div class="spinner-border"
				role="status" id="loading">
				<span class="sr-only">Loading...</span>
			</div>
		</div>
    <div class="row my-4">
        <div class="col-md-2 mx-auto text-center"></div>
        <div class="col-md-8 mx-auto text-center">
            <!-- <div class="small fw-light">search input with icon</div> -->
            <form action="../search/" method="post">
                <div class="input-group my-3">
                    <input type="text" class="form-control form-control-lg" id="text_search" name="text_search" placeholder="ระบุคำค้นหา ชื่อหนังสือ/ ชื่อผู้แต่ง...">
                    <button type="submit"  class="input-group-text btn-success"><i class="fa-solid fa-magnifying-glass px-3"></i></button>
                </div>
            </form>
        </div>
        <div class="col-md-2 mx-auto text-center"></div>
    </div>

    <!-- <div class="row">
      <div class="col-7  text-end">
        <h2 class="my-4 text-dark">หนังสือเล่มล่าสุด</h2>
      </div>
      <div class="col-5 text-end ">
        <a href="../latestbook/">
          <button type="button" class="btn btn-md btn-outline-primary my-4 ">ดูทั้งหมด</button>
        </a>
      </div>
    </div>
    <div class="row row-cols-1 row-cols-md-4 mb-3 text-center" id="booklist">
    </div> -->

    <div class="row">
      <div class="col-7  text-end">
        <h2 class="my-4 text-dark">รายการหนังสือ</h2>
      </div>
      <div class="row row-cols-1 row-cols-md-4 mb-4 text-center" id="book_cambridge">
      </div>
    </div>

    
    <div class="table-responsive">
      <table class="table text-center" id="bookTable"></table>
    </div>
    
    <div class="footer">
      <footer class="py-5">
        <div class="row">
          <div class="col-4 text-center">
           <img src="../images/eLibrary_logo.png" class="d-line" width="75%" alt="">
          </div>

          <div class="col-3">
            <h5>เกี่ยวกับระบบ</h5>
            <ul class="nav flex-column">
              <li class="nav-item mb-2"><a href="https://elibrary.psu.ac.th/psupassportcallback?code=92340a5195235263c0555b78d1be4fa1ecfd1a59&state=XUNIQUE_AND_NON_GUESSABLE" class="nav-link p-0 text-muted">ข้อกำหนดในการเข้าใช้บริการระบบ PSU eLibrary</a></li>
              <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">แสดงความคิดเห็น</a></li>
              <li class="nav-item mb-2"><a href="https://clib.psu.ac.th" class="nav-link p-0 text-muted">เว็บไซต์สำนักทรัพยากรการเรียนรู้คุณหญิงหลง อรรถกระวีสุนทร</a></li>
            </ul>
          </div>

          <div class="col-2">
            <ul class="nav flex-column">
              <h5>สถิติการเข้าชม</h5>
              <li class="nav-item mb-2">
              <a href="https://www.hitwebcounter.com" target="_blank">
                <img src="https://hitwebcounter.com/counter/counter.php?page=8064546&style=0006&nbdigits=5&type=ip&initCount=0" title="Free Counter" Alt="web counter"   border="0" />
                </a>   
              </li>
            </ul>
          </div>

          <div class="col-3">
              <ul class="nav col-md-5 justify-content-center">
              <h5>ช่องทางการติดต่อ</h5>    
                <li class="ms-3"><a class="text-muted" href="#"><i class="fa-brands fa-twitter fa-2x"></i></a></li>
                <li class="ms-3"><a class="text-muted" href="#"><i class="fa-brands fa-instagram fa-2x"></i></a></li>
                <li class="ms-3"><a class="text-muted" href="#"><i class="fa-brands fa-facebook fa-2x"></i></a></li>
            </ul>
          </div>
      </footer>
    </div>
  </div>
  <script src="../js/libs/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script src="../js/libs/jquery.min.js"></script>
  <script src="../js/controller/environment.js"></script>
  <script src="../js/controller/home.js"></script>
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

  </script>
	</body>
</html>
