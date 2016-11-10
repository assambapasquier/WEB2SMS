<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>WEB2SMS-Messages</title>

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
				<h2 class="page-header">Gestion de votre Messagerie</h2>
			</div>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-xs-12 col-md-6 col-lg-6">
				
                            <div id="ret">

                             </div>
				<?php include('saisir_message.php'); ?>
			</div>	
		
		<div class="col-xs-12 col-md-6 col-lg-6">
			<div class="row">
                                <a href="<?php echo base_url() ?>Utilisateurs/boite_envoi" data-confirm="Etes-vous certains de vouloir annuler l'envoi du messages?">
                                <div class="col-xs-12 col-md-6 col-lg-6">
                                        <div class="panel panel-blue panel-widget ">
                                                <div class="row no-padding">
                                                        <div class="col-sm-3 col-lg-5 widget-left">
                                                                <i class="fa fa-paper-plane fa-4x"></i>
                                                        </div>
                                                        <div class="col-sm-9 col-lg-7 widget-right">
                                                                <div class="large"></div>
                                                                <div class="text-muted"><strong><span style="color:black;"><small>Consulter votre boite d'envoi</small></span></strong></div>
                                                        </div>
                                                </div>
                                        </div>
                                </div>
                                </a>
                        </div><!--end row-->
				
				<div class="row">
				
					<a href="<?php echo base_url() ?>Utilisateurs/boite_envoi" data-confirm="Etes-vous certains de vouloir annuler l'envoi du messages?">
					<div class="col-xs-12 col-md-6 col-lg-6">
						<div class="panel panel-red panel-widget ">
							<div class="row no-padding">
								<div class="col-sm-3 col-lg-5 widget-left">
									<i class="fa fa-cogs fa-4x"></i>
								</div>
								<div class="col-sm-9 col-lg-7 widget-right">
									<div class="large"></div>
									<div class="text-muted"><strong><span style="color:black;"><small>Consulter vos statistiques</small></span></strong></div>
								</div>
							</div>
						</div>
					</div>
					</a>
				</div> <!--end row-->
		</div>
	</div> <!--end row-->
		
		
		
		<!-----------modal choix contact--------------------------------------------------------------------->
                    <?php include('modal_select_contacts.php'); ?>
		<!---------------------------------------------------------------------------------------------->
                <!-----------modal choix contact--------------------------------------------------------------------->
                    <?php include('modal_select_group.php'); ?>
		<!---------------------------------------------------------------------------------------------->
                <!-----------modal choix contact--------------------------------------------------------------------->
                    <?php //include('modal_select_time.php'); ?>
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
	
	<!--------------------modal confirm--------------------------------------------------------->
	<script>
	$(function() {
		$('a[data-confirm]').click(function(ev) {
			var href = $(this).attr('href');
			
			if (!$('#dataConfirmModal').length) {
				$('body').append('<div id="dataConfirmModal" class="modal" role="dialog" aria-labelledby="dataConfirmLabel" aria-hidden="true"><div class="modal-dialog"><div class="modal-content"><div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button><h3 id="dataConfirmLabel"><span style="color:rgb(0,132,232);">Confirmation</span></h3></div><div class="modal-body"></div><div class="modal-footer"><button class="btn" data-dismiss="modal" aria-hidden="true">Non</button><a class="btn btn-danger" id="dataConfirmOK">Oui</a></div></div></div></div>');
			}
			$('#dataConfirmModal').find('.modal-body').html($(this).attr('data-confirm'));
			$('#dataConfirmOK').attr('href', href);
			$('#dataConfirmModal').modal({show:true});
			
			return false;
		});
	});
	</script>
        
        <script>
        
        $(function(){
        $( "#form_saisir_messagex" ).submit(function( event ) {
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
                $('#form_saisir_message')[0].reset();
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
        
        <!-------------chacher les colonnes d'un tableau-->
        <script>
            $('td:nth-child(1)').hide();
            $('th:nth-child(1)').hide();
        </script>
        
</body>

</html>
