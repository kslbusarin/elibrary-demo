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

        <link rel="stylesheet" href="../css/fontawesome-6.1.2/css/all.css">
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
      <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-primary">
        <div class="container-fluid">
          <a class="navbar-brand" href="#">eLibrary</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav me-auto mb-2 mb-md-0">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">หน้าแรก</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="search">แดชบอร์ด</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="categories">ออกจากระบบ</a>
              </li>
            </ul>
            <form class="d-flex">
              <div class="text-white mt-1 me-2" id="username"></div>
              <!-- <a class="btn btn-outline-light" href="authen" role="button">Login</a> -->
              <div id="btn_authen"></div>
            </form>
          </div>
        </div>
      </nav>
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
    <h2 class="my-4 text-center text-dark">การจัดการหนังสือ</h2>
      <div class="row row-cols-1 row-cols-md-3 mb-3 text-center" id="add_book">
        <a href = "addbook/">
          <div class="card mx-0 py-2 mb-4 rounded-2 shadow-sm">
              <div class="card-body">
                  <div style="height: 10em;">
                      <div class="h-100 d-inline-block">
                          <h3 class="pt-5">เพิ่มหนังสือ</h3>
                      </div>
                  </div>
              </div>
          </div>
        </a>
        <a href = "book/">
          <div class="card mx-0 py-2 mb-4 rounded-2 shadow-sm">
              <div class="card-body">
                  <div style="height: 10em;">
                      <div class="h-100 d-inline-block">
                          <h3 class="pt-5">แก้ไข/ลบหนังสือ</h3>
                      </div>
                  </div>
              </div>
          </div>
        </a>
        <a href = "author/">
          <div class="card mx-0 py-2 mb-4 rounded-2 shadow-sm">
              <div class="card-body">
                  <div style="height: 10em;">
                      <div class="h-100 d-inline-block">
                          <h3 class="pt-5">ผู้แต่ง</h3>
                      </div>
                  </div>
              </div>
          </div>
        </a>
        <a href = "publisher/">
          <div class="card mx-0 py-2 mb-4 rounded-2 shadow-sm">
              <div class="card-body">
                  <div style="height: 10em;">
                      <div class="h-100 d-inline-block">
                          <h3 class="pt-5">สำนักพิมพ์</h3>
                      </div>
                  </div>
              </div>
          </div>
        </a>
        <a href = "tag/">
          <div class="card mx-0 py-2 mb-4 rounded-2 shadow-sm">
              <div class="card-body">
                  <div style="height: 10em;">
                      <div class="h-100 d-inline-block">
                          <h3 class="pt-5">คำค้น</h3>
                      </div>
                  </div>
              </div>
          </div>
        </a>
        <a href = "category/">
          <div class="card mx-0 py-2 mb-4 rounded-2 shadow-sm">
              <div class="card-body">
                  <div style="height: 10em;">
                      <div class="h-100 d-inline-block">
                          <h3 class="pt-5">หมวดหมู่</h3>
                      </div>
                  </div>
              </div>
          </div>
        </a>
      </div>
      <h2 class="my-4 text-center text-dark">การจัดการระบบ</h2>
      <div class="row row-cols-1 row-cols-md-3 mb-3 text-center" id="add_book">
        <a href = "canlogintype/">
          <div class="card px-4 py-2 mb-4 rounded-2 shadow-sm">
              <div class="card-body">
                  <div style="height: 10em;">
                      <div class="h-100 d-inline-block">
                          <h4 class="pt-5 px-4">ระดับ PSU Passport ที่ Login ฝั่ง User ได้</h4>
                      </div>
                  </div>
              </div>
          </div>
        </a>
        <a href = "list/">
          <div class="card px-4 mx-0 py-2 mb-4 rounded-2 shadow-sm">
              <div class="card-body">
                  <div style="height: 10em;">
                      <div class="px-4 h-100 d-inline-block">
                          <h4 class="pt-5 px-4">ระดับ PSU Passport ที่ Login ฝั่ง Staff ได้</h4>
                      </div>
                  </div>
              </div>
          </div>
        </a>
        <a href = "borrowlevel/">
          <div class="card px-4 mx-0 py-2 mb-4 rounded-2 shadow-sm">
              <div class="card-body">
                  <div style="height: 10em;">
                      <div class="h-100 d-inline-block">
                          <h4 class="pt-5 px-4">เงื่อนไขการยืมของแต่ละ PSU Passport</h4>
                      </div>
                  </div>
              </div>
          </div>
        </a>
      </div>


  <script src="js/libs/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script src="js/libs/jquery.min.js"></script>
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
