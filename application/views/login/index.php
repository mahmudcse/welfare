<!--Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE HTML>
<html>
<head>
<title>Transparent Login Form Responsive Widget Template | Home :: w3layouts</title>
<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link href="<?php echo base_url('assets/login/') ?>css/style.css" rel="stylesheet" type="text/css" media="all"/>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Transparent Login Form Responsive Widget,Login form widgets, Sign up Web forms , Login signup Responsive web form,Flat Pricing table,Flat Drop downs,Registration Forms,News letter Forms,Elements" />
<!--web-fonts-->
<link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css' />
<!--web-fonts-->
</head>

<style>
	p{
		color: #fff;
	}
</style>

<body>
<!--header-->
	<div class="header-w3l">
		<h1> Login</h1>
	</div>
<!--//header-->

<!--main-->
<div class="main-content-agile">
	<div class="sub-main-w3">

		<p class="has-error">
			<?php echo validation_errors();?>
		</p>
		
		<?php echo form_open('employee/loginValidation'); ?>
			<input placeholder="E-mail" name="email" class="user" type="text" required=""><br>
			<input  placeholder="Password" name="password" class="pass" type="password" required=""><br>
			<input type="submit" value="">
		<?php echo form_close(); ?>
	</div>
</div>
<!--//main-->

<!--footer-->
<div class="footer">
	<p>&copy; <?php echo date('Y'); ?></p>
</div>
<!--//footer-->

</body>
</html>