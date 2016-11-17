<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>WEB2SMS-Adresses</title>

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
				<h2 class="page-header">Gestion du carnet d'adresses</h2>
			</div>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-xs-12 col-md-8 col-lg-8">
                                <?php
                                    if(isset($error_adr) && $error_adr!==null){
                                        if($error_adr == "1"){
                                            echo '<div class="alert alert-dismissable alert-danger"><small>Echec d\'ajout du contact. Veuillez reessayer SVP</small></div>';
                                        }
                                        
                                    }
                                    
                               ?>
				<?php include('tab_contacts.php'); ?>
                            
			</div>	
		
                        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                                <?php include('tab_groups.php'); ?>
                        </div>
                </div> <!--end row-->
                
		
		
		
		<!-----------modal add contact--------------------------------------------------------------------->
		<?php include('modal_add_contact.php'); ?>
		<!---------------------------------------------------------------------------------------------->
                
                <!-----------modal add groupe--------------------------------------------------------------------->
		<?php include('modal_add_group.php'); ?>
		<!---------------------------------------------------------------------------------------------->
                
                <!-----------modal update adr--------------------------------------------------------------------->
		<?php include('modal_update_adr.php'); ?>
		<!---------------------------------------------------------------------------------------------->
                <!-----------modal update adr--------------------------------------------------------------------->
		<?php include('modal_import_adr.php'); ?>
		<!---------------------------------------------------------------------------------------------->
			
	</div>	<!--/.main-->

	<script src="<?php echo base_url(); ?>asset/js/jquery-1.11.1.min.js"></script>
	<script src="<?php echo base_url(); ?>asset/js/bootstrap.min.js"></script>
	<script src="<?php echo base_url(); ?>asset/js/chart.min.js"></script>
	<script src="<?php echo base_url(); ?>asset/js/chart-data.js"></script>
	<script src="<?php echo base_url(); ?>asset/js/easypiechart.js"></script>
	<script src="<?php echo base_url(); ?>asset/js/easypiechart-data.js"></script>
	<script src="<?php echo base_url(); ?>asset/js/bootstrap-datepicker.js"></script>
	<script src="<?php echo base_url(); ?>asset/js/bootstrap-table.js"></script>
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
	
        
        <!-----------------------------update en cliquant dans une tableau---------------------------->
        <script>
            $('.edition').click(function(){
            var row = $(this).closest('tr');
                cells = row.find('td');
                id = cells.eq(1).html();
                libelle = cells.eq(2).html();
                //alert(libelle);
                //$(e.currentTarget).find('input[name="bookId"]').val(bookId);
                //$(".identifiant").val(id);
                //$(".lib").val(libelle);
                //$('#UpdateAdr').modal({show:true});
                $('#UpdateAdr').modal('show'); 
            });
            
        </script>
        
        <script>
            $('.supprimer').click(function(){
            var row = $(this).closest('tr');
                cells = row.find('td');
                id = cells.eq(1).html();
                libelle = cells.eq(2).html();
                
                //$(e.currentTarget).find('input[name="bookId"]').val(bookId);
                $(".identifiant").val(id);
                $(".lib").val(libelle);
                
                $('#SupprAdr').modal('show'); 
            });
        </script>
        
</body>

</html>
