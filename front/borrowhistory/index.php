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
        <script src="../js/controller/borrowhistory.js"></script>
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
                <div class="d-flex justify-content-left mt-3">
                    <div class="col-12">
                        <div class="mx-4">
                            <button class="btn btn-primary btn-md" onclick="gotoMyBorrow()">หนังสือที่ยืม</button>
                            <button class="btn btn-success btn-md" onclick="">ประวัติการยืม</button>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-center my-3">
                    <div class="col-10 table-responsive">
                        <table class="table text-center" id="borrowHistoryTable">
                            <thead class="bg-success text-white">
                                <th>ชื่อเรื่อง</th>
                                <th>วันที่ยืม</th>
                                <th>กำหนดคืน</th>
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
        <script src="../js/libs/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <script src="../js/libs/jquery.min.js"></script>
        <script>
            $(function(){
            $("#nav-placeholder").load("../components/navbar.html");
            });
        </script>

	</body>
</html>
