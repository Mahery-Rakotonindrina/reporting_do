<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="UTF-8">
		<title>REPORTING DO</title>
		<meta name="description" content="The small framework with powerful features">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<!-- <link rel="shortcut icon" type="image/png" href="<?= base_url()?>/assets/images/viapost.jpg"/> -->
		
		<!-- load CSS -->
		<link rel="stylesheet" type="text/css" href="<?= base_url()?>/assets/css/bootstrap/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="<?= base_url()?>/assets/css/bootstrap/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="<?= base_url()?>/assets/css/fontawesome/css/all.min.css">
        <link rel="stylesheet" type="text/css" href="<?= base_url()?>/assets/css/style.css">
        <link rel="stylesheet" type="text/css" href="<?= base_url()?>/assets/css/sidebar_style.css">
        <link rel="stylesheet" type="text/css" href="<?= base_url()?>/assets/css/sidebar.css">
        <link href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css" rel="stylesheet" crossorigin="anonymous" />


		<!-- Load JS -->
        <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>

		<!--<script type="text/javascript" src="<?= base_url()?>/assets/js/jquery.min.js"></script>-->
        <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js" crossorigin="anonymous"></script>
		<script type="text/javascript" src="<?= base_url()?>/assets/JS/bootstrap/bootstrap.js"/></script>
		<script type="text/javascript" src="<?= base_url()?>/assets/JS/Bootbox/bootbox.all.js"/></script>
		<script type="text/javascript" src="<?= base_url()?>/assets/JS/Bootbox/bootbox.locales.js"/></script>
		<script type="text/javascript" src="<?= base_url()?>/assets/JS/Bootbox/bootbox.min.js"/></script>
        <script type="text/javascript" src="<?= base_url()?>/assets/JS/fontawesome/fontawesome.js"></script>
        <script type="text/javascript" src="<?= base_url()?>/assets/JS/fontawesome-6/js/all.js"></script>
        <script type="text/javascript" src="<?= base_url()?>/assets/JS/fontawesome/solid.js"></script>
        <script type="text/javascript" src="<?= base_url()?>/assets/JS/commun.js"></script>
        <script type="text/javascript" src="<?= base_url()?>/assets/JS/SweetAlert/SweetAlert_unpkg.js"></script>


        <!-- Isolated Version of Bootstrap, not needed if your site already uses Bootstrap -->
        <link rel="stylesheet" href="https://formden.com/static/cdn/bootstrap-iso.css" />
        <!-- Bootstrap Date-Picker Plugin -->
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>

	</head>
	
	<body>
        <div class="wrapper">
            <input class="base_url" type="hidden" value="<?=base_url()?>">
           			
            <div class="contenu" style="width:100%!important;">
			    <div class="row-fluid">
					<div class="datepicker_div row" style="margin-left: 0;">
						<input class="form-control col-sm-2" id="datepicker1" name="data" type="text" value="<?= date('d/m/Y', strtotime($debut))?>" data-datedeb="<?= date('d/m/Y', strtotime($debut))?>" style="font-size: 1.4em;spadding: 50px;"/>&nbsp;&nbsp;&nbsp;&nbsp;
						<input class="form-control col-sm-2" id="datepicker2" name="data" type="text" value="<?= date('d/m/Y', strtotime($fin))?>" data-datefin="<?= date('d/m/Y', strtotime($fin))?>" style="font-size: 1.4em; "/>&nbsp;&nbsp;
						<button class="btn btn-info btn-recherche" id="recherche_rep" style="width:35px; height:35px; margin-top: 0px"><i class="fa fa-search"></i></button>
					</div>

					<div class="x-content contenu-diff"> 
						<img src="<?= base_url()?>/assets/images/loading.gif" alt="loading" class="loader" style="width: 50px; height:50px; display:none">

						<div class="row">
						<?php if(isset($contenu)) {
                                echo view($contenu);
                            }?>
						</div>
					</div>
                </div>
            </div>
        </div>

		<script>
			(function($){
				$.fn.datepicker.dates['fr'] = {
					days: ["dimanche", "lundi", "mardi", "mercredi", "jeudi", "vendredi", "samedi"],
					daysShort: ["dim.", "lun.", "mar.", "mer.", "jeu.", "ven.", "sam."],
					daysMin: ["D", "L", "M", "M", "J", "V", "S"],
					months: ["janvier", "février", "mars", "avril", "mai", "juin", "juillet", "août", "septembre", "octobre", "novembre", "décembre"],
					monthsShort: ["janv.", "févr.", "mars", "avril", "mai", "juin", "juil.", "août", "sept.", "oct.", "nov.", "déc."],
					today: "Aujourd'hui",
					monthsTitle: "Mois",
					clear: "Effacer",
					weekStart: 1,
					format: "dd/mm/yyyy"
				};
			}(jQuery));

			$('#datepicker1').datepicker({
				language: 'fr',
				autoclose: true,
				todayHighlight: true,	
				calendarWeeks: true,
			})

			$('#datepicker2').datepicker({
				language: 'fr',
				autoclose: true,
				todayHighlight: true,
				calendarWeeks: true,
			})

			$('#date_app').datepicker({
				language: 'fr',
				autoclose: true,
				todayHighlight: true,
				calendarWeeks: true,
			})
		</script>

		<!-- Javascript -->
		<?php if(isset($require_js)) { ?>
			<?php foreach($require_js as $js) { ?>
				<script type="text/javascript" src="<?= base_url("/assets/JS/reporting/". $js )?>"></script>
			<?php } ?>
		<?php } ?>

		<?php include_once(__DIR__.'/../reporting/modal_saisie.php');?>
		<?php include_once(__DIR__.'/../Interface/modal_show_parameter.php');?>
		<?php include_once(__DIR__.'/../Interface/modal_edit_reporting.php');?>
		<?php include_once(__DIR__.'/../Interface/modal_show_history.php');?>
		<?php include_once(__DIR__.'/../Interface/modal_visu_parametrage.php');?>
		<?php include_once(__DIR__.'/../Interface/modal_visu_saisie.php');?>

    </body>
</html>
