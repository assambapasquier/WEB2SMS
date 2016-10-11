<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>WEB2SMS</title>

<link href="<?php echo base_url(); ?>asset/css/bootstrap.min.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>asset/css/datepicker3.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>asset/css/styles.css" rel="stylesheet">

<!--<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
<link rel="stylesheet" href="http://fortawesome.github.io/Font-Awesome/assets/font-awesome/css/font-awesome.css"> -->
<link href="<?php echo base_url(); ?>asset/fonts/css/font-awesome.min.css" rel="stylesheet">

<!--Icons-->
<script src="<?php echo base_url(); ?>asset/js/lumino.glyphs.js"></script>

<!--[if lt IE 9]>
<script src="js/html5shiv.js"></script>
<script src="js/respond.min.js"></script>
<![endif]-->

</head>

<body>
        <?php include('nav.php'); ?>
		
	<?php include('menuGauche.php'); ?>
	
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li class="active">Icons</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header"><span style="color:rgb(0,132,232);">Administration</span></h1>
			</div>
		</div><!--/.row-->
		
		<div class="row">
			<a href="#" data-toggle="modal" data-target="#modal_add_user">
			<div class="col-xs-12 col-md-8 col-lg-8">
				<div class="row">
					<div class="col-xs-12 col-md-6 col-lg-6">
						<div class="panel panel-red panel-widget ">
							<div class="row no-padding">
								<div class="col-sm-3 col-lg-5 widget-left">
									<i class="fa fa-user fa-4x"></i>
								</div>
								<div class="col-sm-9 col-lg-7 widget-right">
									<div class="large"></div>
									<div class="text-muted"><span style="color:black;">Enregistrer un client</span></div>
								</div>
							</div>
						</div>
					</div>
					</a>
				</div>
				
				<div class="row">
					<a href="#">
					<div class="col-xs-12 col-md-6 col-lg-6">
						<div class="panel panel-blue panel-widget ">
							<div class="row no-padding">
								<div class="col-sm-3 col-lg-5 widget-left">
									<i class="fa fa-users fa-4x"></i>
								</div>
								<div class="col-sm-9 col-lg-7 widget-right">
									<div class="large"></div>
									<div class="text-muted"><span style="color:black;">Consulter la liste des clients</span></div>
								</div>
							</div>
						</div>
					</div>
					</a>
				</div>
				
			</div>	
			
			<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
				<div class="panel panel-info">
					<div class="panel-heading">
						Enoyez aisément des SMS
					</div>
					<div class="panel-body">
						<div class ="row">
							<div class="col-sm-4 col-lg-5 ">
								<img src="<?php echo base_url(); ?>asset/image.png" width="300px" height="200px"/>
							</div>
						</div>
						<div class ="row">
							<p>Enoyez vos sms à un groupe de contact via le web</p>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		
		
		<!-----------modal login--------------------------------------------------------------------->
		<div class="modal fade" id="modal_add_user" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">

			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
				<h4 class="modal-title" id="myModalLabel">Enregistrer un Client</h4>
			</div> <!-- /.modal-header -->

			<div class="modal-body">
				<form role="form">
					<div class="form-group">
						<div class="input-group">
							<input type="text" class="form-control" id="uLogin" placeholder="Login">
							<label for="uLogin" class="input-group-addon glyphicon glyphicon-user"></label>
						</div>
					</div> <!-- /.form-group -->

					<div class="form-group">
						<div class="input-group">
							<input type="password" class="form-control" id="uPassword" placeholder="Password">
							<label for="uPassword" class="input-group-addon glyphicon glyphicon-lock"></label>
						</div> <!-- /.input-group -->
					</div> <!-- /.form-group -->

					<div class="checkbox">
						<label>
							<input type="checkbox"> Remember me
						</label>
					</div> <!-- /.checkbox -->
				</form>

			</div> <!-- /.modal-body -->

			<div class="modal-footer">
				<button class="form-control btn btn-primary">Ok</button>

				<div class="progress">
					<div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="1" aria-valuemin="1" aria-valuemax="100" style="width: 0%;">
						<span class="sr-only">progress</span>
					</div>
				</div>
			</div> <!-- /.modal-footer -->

		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
		
		<!---------------------------------------------------------------------------------------------->
			
	</div>	<!--/.main-->

	<script src="<?php echo base_url(); ?>asset/js/jquery-1.11.1.min.js"></script>
	<script src="<?php echo base_url(); ?>asset/js/bootstrap.min.js"></script>
	<script src="<?php echo base_url(); ?>asset/js/chart.min.js"></script>
	<script src="<?php echo base_url(); ?>asset/js/chart-data.js"></script>
	<script src="<?php echo base_url(); ?>asset/js/easypiechart.js"></script>
	<script src="<?php echo base_url(); ?>asset/js/easypiechart-data.js"></script>
	<script src="<?php echo base_url(); ?>asset/js/bootstrap-datepicker.js"></script>
	<script>
		$('#calendar').datepicker({
		});

		!function ($) {
		    $(document).on("click","ul.nav li.parent > a > span.icon", function(){          
		        $(this).find('em:first').toggleClass("glyphicon-minus");      
		    }); 
		    $(".sidebar span.icon").find('em:first').addClass("glyphicon-plus");
		}(window.jQuery);

		$(window).on('resize', function () {
		  if ($(window).width() > 768) $('#sidebar-collapse').collapse('show')
		})
		$(window).on('resize', function () {
		  if ($(window).width() <= 767) $('#sidebar-collapse').collapse('hide')
		})
	</script>	
	
	<script>
			$(document).ready(function(){
		$('.modal-footer button').click(function(){
			var button = $(this);

			if ( button.attr("data-dismiss") != "modal" ){
				var inputs = $('form input');
				var title = $('.modal-title');
				var progress = $('.progress');
				var progressBar = $('.progress-bar');

				inputs.attr("disabled", "disabled");

				button.hide();

				progress.show();

				progressBar.animate({width : "100%"}, 100);

				progress.delay(1000)
						.fadeOut(600);

				button.text("Close")
						.removeClass("btn-primary")
						.addClass("btn-success")
						.blur()
						.delay(1600)
						.fadeIn(function(){
							title.text("Log in is successful");
							button.attr("data-dismiss", "modal");
						});
			}
		});

		$('#myModal').on('hidden.bs.modal', function (e) {
			var inputs = $('form input');
			var title = $('.modal-title');
			var progressBar = $('.progress-bar');
			var button = $('.modal-footer button');

			inputs.removeAttr("disabled");

			title.text("Log in");

			progressBar.css({ "width" : "0%" });

			button.removeClass("btn-success")
					.addClass("btn-primary")
					.text("Ok")
					.removeAttr("data-dismiss");
					
		});
	});
	</script>
</body>

</html>
