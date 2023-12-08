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

        <script src="../js/controller/environment.js"></script>
        <script src="../js/controller/circulation/cir_finelate.js"></script>
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
            <div class="card shadow-sm bg-white mt-5">
                <!-- <div class="d-flex justify-content-left mt-3">
                    <div class="col-12">
                        <div class="mx-4">
                            <button class="btn btn-primary btn-md" >รายการหนี้</button>
                            <button class="btn btn-success btn-md" onclick="location.href = 'cir_item.php';">ประวัติการยืม-คืน</button>
                        </div>
                    </div>
                </div> -->
                <div class="d-flex justify-content-center my-3">
                <div style="overflow-x:auto;">
                    <div class="col-12 table-responsive">
                        <table class="table" id="myborrowTable">
                            <thead class="bg-primary text-white">

                            </thead>
                            <tbody>
                                <tr>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                </div>
            </div>
        </div>
        <script src="../js/libs/bootstrap.bundle.min.js"></script>
        <script src="../js/libs/jquery.min.js"></script>
        <script>
            $(function(){
                $("#nav-placeholder").load("../components/navbar.html");
                // $(window).bind("load", function() {
                //     let username = sessionStorage.getItem("username");
                //         if(username){
                //         document.getElementById("username").innerHTML = sessionStorage.getItem("userid")+" "+username;
                //         document.getElementById("btn_authen").innerHTML = `<a class="btn btn-outline-light" onclick="logout()" role="button">Logout</a>`; 
                //         document.getElementById("url_myborrow").href = "myborrow/index.php?id="+sessionStorage.getItem("userid");
                //         }
                //         else{
                //         document.getElementById("username").innerHTML = "";
                //         document.getElementById("btn_authen").innerHTML = `<a class="btn btn-outline-light" href="authen" role="button">Login</a>`; 
                //         }


                //     });
                
            });

            function logout(){
                            sessionStorage.clear();
                            location.reload();
                        }
        </script>

	</body>
</html>
