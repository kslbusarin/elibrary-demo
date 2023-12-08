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
            <div class="card shadow-sm bg-white mt-5 px-3">
                <div class="row">
                <div class="col-8">
                    <table class="table">
                        <tbody>
                            <tr>
                                <td>ชื่อ</td>
                                <td>:</td>
                                <td id="fullname">-</td>
                            </tr>
                            <tr>
                                <td>Name</td>
                                <td>:</td>
                                <td id="fullname_en">-</td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td>:</td>
                                <td id="email">-</td>
                            </tr>
                            <tr>
                                <td>Faculty</td>
                                <td>:</td>
                                <td id="faculty">-</td>
                            </tr>
                            <tr>
                                <td>Department</td>
                                <td>:</td>
                                <td id="department">-</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-4 text-center mt-3">
                    <img src="https://cdn.pixabay.com/photo/2014/04/03/11/56/avatar-312603_960_720.png" width="30%" alt="">
                </div>
                </div>
                
            </div>
            
        </div>
        <script src="../js/libs/bootstrap.bundle.min.js"></script>
        <script src="../js/libs/jquery.min.js"></script>
        <!-- <script src="../js/controller/fine/pay_fine.js"></script> -->
        <script>
            $(function(){
                $("#nav-placeholder").load("../components/navbar.html");             
            });
        
        </script>
        <script src="../js/controller/environment.js"></script>
        <script src="../js/controller/profile.js"></script> 
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	</body>
</html>
