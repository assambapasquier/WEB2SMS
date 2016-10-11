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

    <?php include('nav.php');?>
    
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
				<h1 class="page-header">Le WEB2SMS</h1>
			</div>
		</div><!--/.row-->
		
		<div class="row">
			
			<div class="col-xs-12 col-md-8 col-lg-8">
				<div class="row">
                                        <a href="<?php echo base_url(); ?>feature/accueil/new_message">
					<div class="col-xs-12 col-md-6 col-lg-6">
						<div class="panel panel-blue panel-widget ">
							<div class="row no-padding">
								<div class="col-sm-3 col-lg-5 widget-left">
									<i class="fa fa-envelope icon fa-4x"></i>
								</div>
								<div class="col-sm-9 col-lg-7 widget-right">
									<div class="large"></div>
									<div class="text-muted"><span style="color:black;">Nouveau Message</span></div>
								</div>
							</div>
						</div>
					</div>
					</a>
					
					<a href="#">
					<div class="col-xs-12 col-md-6 col-lg-6">
						<div class="panel panel-blue panel-widget ">
							<div class="row no-padding">
								<div class="col-sm-3 col-lg-5 widget-left">
									<i class="fa fa-paper-plane fa-4x"></i>
								</div>
								<div class="col-sm-9 col-lg-7 widget-right">
									<div class="large"></div>
									<div class="text-muted"><span style="color:black;">Messages envoyés</span></div>
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
									<div class="text-muted"><span style="color:black;">Carnet d'adresses</span></div>
								</div>
							</div>
						</div>
					</div>
					</a>
					
					<a href="#">
					<div class="col-xs-12 col-md-6 col-lg-6">
						<div class="panel panel-blue panel-widget ">
							<div class="row no-padding">
								<div class="col-sm-3 col-lg-5 widget-left">
									<i class="fa fa-file-archive-o fa-4x"></i>
								</div>
								<div class="col-sm-9 col-lg-7 widget-right">
									<div class="large"></div>
									<div class="text-muted"><span style="color:black;">Archives</span></div>
								</div>
							</div>
						</div>
					</div>
					</a>
				</div>
				<div class="row">
					<a href="#">
					<div class="col-xs-12 col-md-6 col-lg-6">
						<div class="panel panel-red panel-widget ">
							<div class="row no-padding">
								<div class="col-sm-3 col-lg-5 widget-left">
									<i class="fa fa-cogs fa-4x"></i>
								</div>
								<div class="col-sm-9 col-lg-7 widget-right">
									<div class="large"></div>
									<div class="text-muted"><span style="color:black;">Consulter les statistiques</span></div>
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
								<img src="<?php echo base_url() ?>asset/image.png" width="300px" height="200px"/>
                                                                
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
