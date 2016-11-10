<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Main2</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="js/vendor/jquery-ui-1.12.1.custom/jquery-ui.min.css">
        <link rel="stylesheet" href="css/bootstrap.min.css">
       
        <link rel="stylesheet" href="css/bootstrap-theme.min.css">
        <link rel="stylesheet" href="css/main.css">

        <script src="js/vendor/modernizr-2.8.3.min.js"></script>
    </head>
    <body>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        
        <div class="modal fade"	id="modalForm" role="dialog" tabindex="-1" aria-labelledby="myModalLabel">
        	<div class="modal-dialog" role="document">
            	<div class="modal-content">
                	<div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    	<h4 class="modal-title"	id="myModalLabel"> Send mail</h4>
                    </div>
                    <div class="modal-body">
                    	<form action="" method="post" class="form-horizontal" id="sendForm" data-toggle="validator" role="form">
                           <div class="form-group">
                                <label for="inputFName" class="col-sm-3 control-label">First name</label>
                                <div class="col-sm-9">
                                	<input type="text" name="fname" required class="form-control" id="inputFName" data-error="Enter first name"/>
                                    <span class="error-box" ></span>
                                </div>
                                <div class="col-sm-9 col-sm-offset-3 help-block with-errors"></div>
                                
                          </div> 
                          <div class="form-group">
                                <label for="inputLName" class="col-sm-3 control-label">Last name</label>
                                <div  class="col-sm-9">
                                	<input type="text" name="lname" required class="form-control" id="inputLName" data-error="Enter last name"/>
                                    <span class="error-box" ></span>
                                </div>
                                <div class="col-sm-9 col-sm-offset-3 help-block with-errors"></div>
                                
                          </div>
                          <div class="form-group">
                                <label for="inputEmail" class="col-sm-3 control-label">email</label>
                                <div class="col-sm-9">
                                	<input type="email" name="email" class="form-control" id="inputEmail" data-error="Enter correct email"/>
                                    <span class="error-box" ></span>
                                </div>
                                <div class="col-sm-9 col-sm-offset-3 help-block with-errors"></div>
                                
                          </div>
                          <input type="hidden" name="itemId" id="inputItemId" />                                     		          
        				</form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal"> Close</button>
                        <button type="button" class="btn btn-primary" id="buttonSend">Send</button>
                    </div>
                 </div><!-- /.modal-content -->
        	</div><!-- /.modal-dialog -->
        </div><!-- /.modal fade -->
        
        <div></div>
    
    <?php
    if(isset($_GET['page']))
    {
       $page = $_GET['page']; 
    }
    else
        $page = 1;
    ?>

    <script>
      //Определяется переменная, которая будет доступна для 
      // всех JavaScript, подключаемых на данной странице
      var number_page = <?php echo $page; ?>;
    </script>

    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron">
      <div class="container" id="items">
        <h1>Hello, world!</h1>

        <div class="label label-success" id="items-count"> </div>

        <ul class="pagination" id="topPagination"></ul>
        <ul class="row order-list " id="order-list"> 
          	
        </ul>
        <div class="loading-image">
          <!--  <img src="img/bes.gif" alt="">
            <img src="img/loading-circle.gif" alt="">-->
             <img src="img/39.gif" alt="">
        </div>
        <ul class="pagination" id="bottomPagination"></ul>
            <!--<div class="good"> 
            	<p> <img src="img/1.jpg" alt="mobile 1"  id="ImgMobile"></p>            
       			<button class="btn btn-primary" data-toggle="modal" data-target="#modalForm"> order </button>
        	</div>
            <div class="good"> 
            	<p> <img src="img/2.jpg" alt="mobile 2"  id="ImgMobile"></p>            
       			<button class="btn btn-primary" data-toggle="modal" data-target="#modalForm"> order </button>
        	</div>
            <div class="good"> 
            	<p> <img src="img/3.jpg" alt="mobile 3"  id="ImgMobile"></p>            
       			<button class="btn btn-primary" data-toggle="modal" data-target="#modalForm"> order </button>
        	</div>-->
      </div>
    </div>


    <div class="container">
 	<?php
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {?>
		<span class="label label-default">	<?= ($_POST['fname']); ?> </span> <br />
        <span class="label label-warning">	<?= ($_POST['lname']); ?> </span> <br />
        <span class="label label-success">	<?= ($_POST['email']); ?> </span> <br />
        <span class="label label-default">  <?= ($_POST['itemId']); ?> </span><br />
        <? ?>
		<? $mailsent = mail($_POST['email'], "hello, dear ".$_POST['fname'], "hello, dear blalblablalb." .$_POST['fname'] ." ". $_POST['lname'], "From: asd@asd.com" );
			if ($mailsent) {
				echo "success";}
			else {
				echo "bad" ;}
		?> 
		
		<? } ?>
        
	 
    </div> <!-- /container -->        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.2.min.js"><\/script>')</script>
        <script src="js/vendor/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>

        <script src="js/vendor/bootstrap.min.js"></script>
        <script src="js/vendor/validator.js"></script>

        <script src="js/main.js"></script>
        
        
    </body>
</html>
