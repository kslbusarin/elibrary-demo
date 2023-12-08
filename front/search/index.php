<!DOCTYPE html>
<html lang="en">
	<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
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
		<meta charset="UTF-8" />
		<meta name="viewport"
			content="width=device-width, initial-scale=1.0" />
		<title>Book list</title>
	</head>
	<body class="bg-light" onload="<?php echo "onLoadSearch('".$_POST['text_search']."')"; ?>">
        <div class="container py-3">
            <header>
                <div id="nav-placeholder"></div>
            </header>
            <div class="bg-white mt-5">
                    <!-- <?php  echo "ค้นหา : ". $_POST["text_search"]; ?><br> -->
                <div class="container shadow min-vh-100 py-4">
                    <div class="row">
                        <div class="col-md-2 mx-auto text-center"></div>
                        <div class="col-md-6 mx-auto text-center">
                            <!-- <div class="small fw-light">search input with icon</div> -->
                            <div class="input-group my-3">
                                <input type="text" class="form-control form-control-lg" id="text_search" name="text_search" placeholder="ระบุคำค้นหา ชื่อหนังสือ/ ชื่อผู้แต่ง...">
                                <button type="submit" onclick="onSearch('-')"  class="input-group-text btn-success"><i class="fa-solid fa-magnifying-glass px-3"></i></button>
                            </div>
                        </div>
                        <div class="col-md-2 mx-auto text-center"></div>
                    </div>
                    <div class="row row-cols-1 row-cols-md-4 pt-4 mb-3 text-center" id="resultList">
                    </div>
                </div>
            </div>
        </div>
        <script src="../js/libs/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <script src="../js/libs/jquery.min.js"></script>
        <script>
            $(function(){
            $("#nav-placeholder").load("../components/navbar.html");
            });
        </script>
        <script src="../js/controller/environment.js"></script>
        <script src="../js/controller/search.js"></script>
	</body>
</html>
