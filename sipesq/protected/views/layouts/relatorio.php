<!DOCTYPE html>
<html lang="pt">
  <head>
    <meta charset="utf-8">
    <title><?php echo CHtml::encode("SIPESQ"); ?></title>

	<script type="text/javascript" src="https://www.google.com/jsapi?key=ABQIAAAAwtW6REnoXPwabzosDJ1ZbxSf6zeDUL0NX_-81yZ_3MTVk-1i4xQ4nST236nGieybG_Uiv9EE12qxDg"></script>
	<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl?>/js/jquery.js"></script>
	<link href='https://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,100,300,400,700,900' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Amaranth:700' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap-responsive.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/sipesq.min.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" />

	
	<style>
	body{
		max-width: 960px;
		display: block;
		margin:0 auto;
		background-color: #fff;
		font-family: 'Open Sans', Arial, Helvetica, sans-serif;
		/*font-size: 62.5%;  with this 1em = 10px */
		/*padding-top: 42px;*/
		font-size: 14px;
		line-height: 21px;
	}

	@page {
		margin: 2cm;
	}

	@media print{

		body{
			display: block;
			margin:0 auto;
			background-color: #fff;
			font-family: 'Open Sans', Arial, Helvetica, sans-serif;
			font-size: 11pt;
		}

		.section-break {
			page-break-before: always;
		}

		.view-atividade {
			border: solid;
			page-break-inside: avoid;
		}

		#atv-section {
			display: inline;
			font-size: 11pt;
			font-weight: 700;
		}

		#atv-text {
			display: inline;
			font-size: 11pt;
		}

		.atv-nome {
		font-size: 20px;
		font-weight: 700;
		padding-top: 20px;
		padding-bottom: 20px;
		}

		.table-relatorio th{
			text-align: center;
			vertical-align: top;
		}

		.table-relatorio tbody > tr:nth-child(odd) > td,
		.table-relatorio tbody > tr:nth-child(odd) > th {
			background-color: #ececec;
		}

		.bar_chart {
			page-break-inside: avoid;
		}


	}

	#relatorio-header {
		padding: 50px 0;
		line-height: 35px;
		font-family: 'Open Sans', Arial, Helvetica, sans-serif;
		font-weight: 900;
		font-size: 35px;
		text-align: left;
		text-transform: uppercase;
	}

	.logo {
		float:left;
		padding-right: 30px;
	}

	.relatorio-text {
		font-size: 14px;
		line-height: 21px;
		
	}

	.relatorio-number {
		font-family: Amaranth;
		font-size: 35px;
		font-weight: 900;
		padding-right: 10px;
		padding-left: 10px;
	}

	.relatorio-section{
		border-left: 10px #275280 solid;
		padding: 15px 0;
		background-color: #1b3959;
		font-size: 30px;
		font-weight: 100;
		color: #FFFFFF;
	}

	h4 {
		font-family: 'Open Sans', Arial, Helvetica, sans-serif;
		font-weight: 900;
	}

	@media print{
		h1, h2, h3, h4, h5, h6 {
			font-family: 'Open Sans', Arial, Helvetica, sans-serif;

		}
	}

	

	.view-atividade{
		font-weight: 400;
		line-height: 22px;

	}


	

	@media screen {
		#atv-section{
	 		font-weight: 100;
	 		text-align: right;
		}

		#atv-text {
			font-weight: 100;
		}

		.print {
			display:none;
		}

		.atv-nome {
		font-size: 20px;
		font-weight: 300;
		padding-top: 20px;
		padding-bottom: 20px;
		}

		.table-striped th, .table-striped td {
			border: 1px #dddddd solid;
			border-bottom: 0;
			border-top: 0;
		}

		.table-striped th:first-child, .table-striped td:first-child, .table-striped th:last-child, .table-striped td:last-child{
			border-left: 0;
			border-right: 0;
		}

		.table-relatorio th{
			text-align: center;
			vertical-align: top;
		}

		.table-relatorio tbody > tr:nth-child(odd) > td,
		.table-relatorio tbody > tr:nth-child(odd) > th {
			background-color: #ececec;
		}

		.table-relatorio tbody tr:hover > td,
		.table-relatorio tbody tr:hover > th {
			background-color: #adadad;
		}

		.bar_chart{
		width: 800px;
		height: 300px;
		}

		.char-table{
			margin-top: 20px;
		}
	}
	

	@media all {
		.page-break	{ display: none; }
	}

	@media print {
		.page-break	{ display: block; page-break-before: always; }
	}

	/*
	
	table{
	border-collapse:collapse;
	}
	table, th, td
		{
		border: 1px solid black;
		padding: 5px;
		}
	.atv-description{
		border: 1px solid #ccc;
		padding: 5px;
	}
	
	.atv-date{
	 float: right;
	 /*border: 3px solid black;
	 font-weight: bold;
	}
	*/
	
	</style>
	
</head>

<body> 

<div class="container-fluid" id="page">
	<div class="row-fluid">
		<?php echo $content; ?>
	</div>
</div><!-- page -->

</body>
</html>
