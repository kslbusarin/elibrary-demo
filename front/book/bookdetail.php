
<?php
// include("../authen/check_authen.php");
?>
<!DOCTYPE html>
<html lang="en">
	<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
    
        <!-- Bootstrap core CSS -->
        <link href="../css/bootstrap.min.css" rel="stylesheet">
         <!-- Favicons -->

		<meta charset="UTF-8" />
		<meta name="viewport"
			content="width=device-width, initial-scale=1.0" />
		<!-- <title>Book list</title> -->
        <style>
            
        </style>

	</head>
	<body class="bg-light">
        <div class="container py-3">
            <header>
                <div id="nav-placeholder"></div>
            </header>
            <div class="card shadow-sm bg-white mt-5">
                <div class="row mt-4">
                    <!-- Book Cover and Viewcount stat -->
                    <div class="col-md-6 text-center">
                        <div class="row">
                            <div class="col-12">
                                <img width="50%" class="img-fluid" id="coverfileurl"  alt="">
                            </div>
                            <div class="col-12 mt-4">
                            <b class="my-4 text-secondary" id ="viewcount"></b>
                            <b class="my-4 text-secondary" id ="borrowcount"></b>
                            </div>
                        </div>
                    </div>

                    <!-- Book Detail -->
                    <div class="col-md-6">
                        <h3 class="ms-4 me-4 mt-3 text-center" id="book_title">.....</h3>
                        <div class="d-flex justify-content-center mx-5">
                            <table class="table table-responsive-sm">
                                <tr>
                                    <td>ผู้แต่ง</td>
                                    <td id="author">......</td>
                                </tr>
                                <tr>
                                    <td>สำนักพิมพ์</td>
                                    <td id="publisher">......</td>
                                </tr>
                                <tr>
                                    <td>ปีพิมพ์</td>
                                    <td id="year">......</td>
                                </tr>
                                <tr>
                                    <td>หมวดหมู่</td>
                                    <td id="categories">......</td>
                                </tr>
                                <tr>
                                    <td>สถานะ</td>
                                    <td id="status">......</td>
                                </tr>
                            </table>
                        </div>
                        <div class="d-flex justify-content-center mx-5">
                            <div class="p-1">
                                <!-- <button class="btn btn-success btn-md" onclick="createBorrow()">ยืม</button> -->
                            </div>

                            <!-- <div class="p-1"><button class='btn btn-primary btn-md'  onclick='gotoReadWatermark()'>Test</button></div> -->
                            <div class="p-1" id="prem_read"></div>
                            <div class="p-1" id="btn_return"></div>
                        </div>
                        <div class="d-flex justify-content-center mt-5 mx-5">
                            <div id="qrcode"></div>
                        </div>
                        <div class="d-flex justify-content-center">
                            <small id="share_url" class="my-2 mx-4" ></small>
                        </div>
                        <div class="d-flex justify-content-center my-2 mx-4 ">
                            <button class="btn-sm btn-success" onclick="copyToClipboard('#share_url')">Share</button>
                            <small id="txt_copy" ></small>
                        </div>
                    </div>
                </div>
                <hr class="mx-3">
                <!-- Book Desciption -->
                <div class="row px-4">
                    <h5>รายละเอียด</h5>
                    <div class="col-md-12">
                        <p class="my-1 ms-2 text-secondary text-left" id ="description"></p>
                    </div>
                </div>

                <!-- Book Tag -->
                <div class="row px-2">
                    <div class="col-md-12">
                        <p class="my-1 ms-2 text-secondary text-left" id ="book_tag"></p>
                    </div>
                </div>

                

                <div class="d-flex justify-content-center my-4">
                    <div class="col-2 col-xs-0 px-3"></div>
                    <div class="col-10 col-xs-12 px-3">
                    </div>
                </div>
            </div>

            
        </div>
                
        <script src="../js/libs/jquery.min.js"></script>
        <script src="../js/libs/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <script>
            $(function(){
            $("#nav-placeholder").load("../components/navbar.html");
            });
        </script>        

        <script src="../js/controller/environment.js"></script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
		<script src="../js/controller/bookdetail.js"></script>
        <script src="../js/libs/qrcode.min.js"></script> 
        <!-- Google tag (gtag.js) -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-XZSENCTMS9"></script>
        <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-XZSENCTMS9');
        </script>

	</body>
</html>
