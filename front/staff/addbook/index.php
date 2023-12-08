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

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css" />
        <!-- Link font library -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300&display=swap" rel="stylesheet">

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
    <h2 class="my-4 text-center text-dark">เพิ่มหนังสือ</h2>
      <div class="row row-cols-1 row-cols-md-1 mb-3 text-center" id="add_book">
        <div class="card shadow-sm bg-white mt-1 text-start">
          <div class="row my-3">
            <div class="col-2">ไฟล์หนังสือ</div>
            <div class="col-4">
              <input type="file" class="form-control" name="book_file" id="">
            </div>
          </div>
          <div class="row my-3">
            <div class="col-2">รูปหน้าปก</div>
            <div class="col-4"><input type="file" class="form-control" name="book_cover" id=""></div>
          </div>
          <div class="row my-3">
            <div class="col-2">รูปเพิ่มเติม</div>
            <div class="col-4"><input type="file" class="form-control" name="book_cover_more" id=""></div>
          </div>
          <div class="row my-3">
            <div class="col-2">ISBN</div>
            <div class="col-4"><input type="text" class="form-control" name="isbn" id=""></div>
          </div>
          <div class="row my-3">
            <div class="col-2">ชื่อเรื่อง</div>
            <div class="col-4"><input type="text" class="form-control" name="title" id=""></div>
          </div>
          <div class="row my-3">
            <div class="col-2">เรื่องย่อ</div>
            <div class="col-4"><input type="text" class="form-control" name="description" id=""></div>
          </div>
          <div class="row my-3">
            <div class="col-2">ปี</div>
            <div class="col-4"><input type="text" class="form-control" name="year" id=""></div>
          </div>
          <div class="row my-3">
            <div class="col-2">เจ้าของผลงาน</div>
            <div class="col-4"><input type="text" class="form-control author" name="author" id="authors"></div>
            <div>
              <div id="authordiv"></div>
                <button class="btn btn-success btn-md mx-1" id="add_author">เพิ่ม</button>
                <button class="btn btn-danger btn-md mx-1" id="remove_author">ลบ</button>
            </div>
          </div>
          <div class="row my-3">
            <div class="col-2">สำนักพิมพ์</div>
            <div class="col-4"><input type="text" class="form-control publisher" name="publisher" id="publishers"></div>
            <div>
              <div id="publisherdiv"></div>
                <button class="btn btn-success btn-md mx-1" id="add_publisher">เพิ่ม</button>
                <button class="btn btn-danger btn-md mx-1" id="remove_publisher">ลบ</button>
              </div>
          </div>
          <div class="row my-3">
            <div class="col-2">หมวดหมู่</div>
            <div class="col-4"><input type="text" class="form-control category" name="category" id="categories"></div>
            <div>
              <div id="categorydiv"></div>
                <button class="btn btn-success btn-md mx-1" id="add_category">เพิ่ม</button>
                <button class="btn btn-danger btn-md mx-1" id="remove_category">ลบ</button>
              </div>
          </div>
          <div class="row my-3">
            <div class="col-2">คำค้น</div>
            <div class="col-4"><input type="text" class="form-control tag" name="tag" id="tags"></div>
            <div>
              <div id="tagdiv"></div>
                <button class="btn btn-success btn-md mx-1" id="add_tag">เพิ่ม</button>
                <button class="btn btn-danger btn-md mx-1" id="remove_tag">ลบ</button>
              </div>
          </div>
          <div class="row my-3">
            <div class="col-2">จำนวนในระบบ</div>
            <div class="col-4"><input type="text" class="form-control"></div>
            <div class="col-4">สถานะการให้บริการ<input type="checkbox" class="mx-2 form-check-input"></div>
          </div>
          <div class="row my-3">
            <div class="col-6 ps-4">
              <div class="form-check">
                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1"  checked>
                <label class="text-start" for="flexRadioDefault1">
                  หนังสือภาษาไทย
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2">
                
                <label class="text-start" for="flexRadioDefault2">
                  หนังสือภาษาอังกฤษ
                </label>
              </div>
            </div>
          </div>
          <div class="row my-3">
            <div class="col-12 text-center">
              <button type="submit" class="btn btn-success btn-md mx-2">บันทึก</button>
              <button type="cancel" class="btn btn-danger btn-md mx-2">ยกเลิก</button>
            </div>
          </div>
        </div>
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
  <script type="text/javascript">
    $(function() {
    
      $( "#authors" ).autocomplete({
        source: 'http://192.168.27.106/newelibrary/test_elibrary/backend/staff/common/search-author.php',
      });

      $( ".publisher" ).autocomplete({
        source: 'http://192.168.27.106/newelibrary/test_elibrary/backend/staff/common/search-publisher.php',
      });

      $( "#categories" ).autocomplete({
        source: 'http://192.168.27.106/newelibrary/test_elibrary/backend/staff/common/search-category.php',
      });

      $( "#tags" ).autocomplete({
        source: 'http://192.168.27.106/newelibrary/test_elibrary/backend/staff/common/search-tag.php',
      });   
    });

    $(document).ready(function() {  
            $("#add_author").on("click", function() {  
                $("#authordiv").append(`<div class='row'><div class='col-2'></div>
                <div class='col-4'><input type='text' class='form-control author' name='author' id='authors'/></div>
                </div>`); 

                $( ".author" ).autocomplete({
                  source: 'http://192.168.27.106/newelibrary/test_elibrary/backend/staff/common/search-author.php',
                })
            }
            );  
            $("#remove_author").on("click", function() {  
                $("#authordiv").children().last().remove();  
            });  
            $("#add_publisher").on("click", function() {  
                $("#publisherdiv").append(`<div class='row'><div class='col-2'></div>
                <div class='col-4'><input type='text' class='form-control publisher' name='publisher' id='publishers'/></div>
                </div>`);  

                $( ".publisher" ).autocomplete({
                  source: 'http://192.168.27.106/newelibrary/test_elibrary/backend/staff/common/search-publisher.php',
                })
            });  
            $("#remove_publisher").on("click", function() {  
                $("#publisherdiv").children().last().remove();  
            });  
            $("#add_category").on("click", function() {  
                $("#categorydiv").append(`<div class='row'><div class='col-2'></div>
                <div class='col-4'><input type='text' class='form-control category' name='category' id='categories'/></div>
                </div>`); 
                
                $( ".category" ).autocomplete({
                  source: 'http://192.168.27.106/newelibrary/test_elibrary/backend/staff/common/search-category.php',
                })
            });  
            $("#remove_category").on("click", function() {  
                $("#categorydiv").children().last().remove();  
            }); 
            $("#add_tag").on("click", function() {  
                $("#tagdiv").append(`<div class='row'><div class='col-2'></div>
                <div class='col-4'><input type='text' class='form-control tag' name='tag' id='tags'/></div>
                </div>`);  

                $( ".tag" ).autocomplete({
                  source: 'http://192.168.27.106/newelibrary/test_elibrary/backend/staff/common/search-tag.php',
                })
            });  
            $("#remove_tag").on("click", function() {  
                $("#tagdiv").children().last().remove();  
            }); 

        });  
    function author_autocomplete(){
      
    }
  </script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
	</body>
</html>
