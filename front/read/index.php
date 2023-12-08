
<!-- <html>
<head>
   <meta charset="UTF8">


      <link href="./dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>


    <form action="./load.php">
        <div class="form-group mb-1">
            <input type="text" readonly class="form-control-plaintext" value="ป้อนรหัสบุคลากร">
        </div>
        <div class="form-group mx-sm-1 mb-1">
          <label class="sr-only">ป้อนรหัสตัวเลข</label>
          <input type="number" class="form-control" id="id" name="id"  min="0" step="1" data-bind="value:replyNumber">
        </div>
        <button type="submit" value="Submit" class="btn btn-primary mb-2">View e-book</button>
      </form>




      <form class="form-inline">
        <div class="form-group mb-2">
          <label for="staticEmail2" class="sr-only">Email</label>
          <input type="text" readonly class="form-control-plaintext" id="staticEmail2" value="email@example.com">
        </div>
        <div class="form-group mx-sm-3 mb-2">
          <label for="inputPassword2" class="sr-only">Password</label>
          <input type="password" class="form-control" id="inputPassword2" placeholder="Password">
        </div>
        <button type="submit" class="btn btn-primary mb-2">Confirm identity</button>
      </form>


</body>
</html> -->


<!DOCTYPE html>
    <html lang="en">
    	
    <head>
    
        <meta charset="utf-8">
        <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge"> -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="description" content="">
        <meta name="author" content="">
    	
        <link href="./dist/css/bootstrap.min.css" rel="stylesheet">
    	<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    	<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
    	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css"> -->
    </head>
    	
    <body>
    	<div class="container">
    		<div class="row">
    			<div class="col-md-4">
    				<div class="panel panel-info">
    					<div class="panel-heading">
    						<h3 class="panel-title" align="center" style="display: inline;font-weight: bold;">Demo elibrary v2.</h3>
    					</div>
    					<div class="panel-body">
                            <form action="./load.php">
    						<div class='form-row'>
    							<div class="col-xs-12 form-group">
    								<label class='control-label'>PSU Personal ID</label>
                                    <input type="number" class="form-control" id="id" name="id"  min="0" step="1" data-bind="value:replyNumber">
                                    <!-- <input class="form-control" id="nameOnCard" type="text" value=""> -->
                                    <!-- <input class="form-control" id="id" name="id"  type="text" value=""> -->
    							</div>
    							    <div class='form-row'>
    						  <div class='col-md-12 form-group'>
    							<button class='form-control btn btn-primary' type="submit" onClick="updateCreditCard();">View E-Book</button>
    						  </div>
    						</div>
    						</form>
    					</div>
    				</div>
    			</div>
    		</div>
    	</div>
    </body>
    
    </html>