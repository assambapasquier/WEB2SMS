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
<link href="<?php echo base_url('asset/fonts/css/font-awesome.min.css'); ?>" rel="stylesheet">
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />

<!--Icons-->
<script src="<?php echo base_url('asset/js/lumino.glyphs.js'); ?>"></script>

<!--[if lt IE 9]>
<script src="js/html5shiv.js"></script>
<script src="js/respond.min.js"></script>
<![endif]-->

</head>

<body>

	<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="container-fluid">
                    <div class="navbar-header">
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse">
                                    <span class="sr-only">Toggle navigation</span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                            </button>
                            <a class="navbar-brand" href="#">WEB2SMS APP</a>
                            
                    </div>

            </div><!-- /.container-fluid -->
		
	</nav>
		
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
			<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
				<?php include('login.php'); ?>
			</div>
                    
                        <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                            <div classs="row">
                                
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                            <div class="panel panel-info">
                                                    <div class="panel-heading">
                                                            Enoyez aisément des SMS
                                                    </div>
                                                    <div class="panel-body">
                                                            <div class ="row">
                                                                    <div class="col-sm-4 col-lg-5 ">
                                                                            <i class="fa fa-comments fa-5x"></i>
                                                                    </div>
                                                            </div>
                                                            <div class ="row">
                                                                    <p>Enoyez vos sms à un groupe de contact via le web</p>
                                                            </div>
                                                    </div>
                                            </div>
                                    </div>
                                
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="panel panel-info">
                                                <div class="panel-heading">
                                                        Des forfaits imbattables
                                                </div>
                                                <div class="panel-body">
                                                        <div class ="row">
                                                                <div class="col-sm-4 col-lg-5 ">
                                                                        <i class="fa fa-users fa-5x"></i>
                                                                </div>
                                                        </div>
                                                        <div class ="row">
                                                                <p>Envoyez vos sms à un groupe de contact via le web</p>
                                                        </div>
                                                </div>
                                        </div>
                                </div>
                                
                            </div>
                            <div classs="row">
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="panel panel-info">
                                                <div class="panel-heading">
                                                        Quels sont les services offerts?
                                                </div>
                                                <div class="panel-body">
                                                        <div class ="row">
                                                                <div class="col-sm-4 col-lg-5 ">
                                                                        <i class="fa fa-cubes fa-5x" style="align:center"></i>
                                                                </div>
                                                        </div>
                                                        <div class ="row">
                                                                <p>Enoyez vos sms à un groupe de contact via le web</p>
                                                        </div>
                                                </div>
                                        </div>
                                </div>
                            </div>
                        </div>
			
                    </div><!--end row-->
                    
                    <!--<div class="row">
			<a href="#">
			<div class="col-xs-12 col-md-6 col-lg-3 col-lg-offset-3">
				<div class="panel panel-blue panel-widget ">
					<div class="row no-padding">
						<div class="col-sm-3 col-lg-5 widget-left">
							<i class="fa fa-unlock fa-5x"></i>
						</div>
						<div class="col-sm-9 col-lg-7 widget-right">
							<div class="large">Login</div>
							<div class="text-muted"></div>
						</div>
					</div>
				</div>
			</div>
			</a>
                    </div>-->
                
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
        
        $(function(){
        $( "#form_login" ).submit(function( event ) {
            $("#ret").html('<img src="<?php echo base_url() ?>asset/loader.GIF"/>');
            var self = $(this);
            var url = self.attr('action');
            console.log(url);
            $.ajax({
                url: url,
                data: self.serialize(),
                type: self.attr('method')
              }).done(function(data) {
                  if(data !=='')
                      {
                  $("#ret").html(data);
                $('#form_login')[0].reset();
                      }
                      else
                          {
                           window.location.href='<?php echo base_url() ?>feature/accueil';   
                          }
              });
            event.preventDefault();
        });
    });
        
        </script>
</body>

</html>
