<!DOCTYPE html>
<html lang="en">
	<head>
		<title>INDO FX SPOT</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		<link rel="icon" type="image/png" href="<?= base_url() ?>images/icons/favicon.png"/>

		<?php include 'partials/headerStyle.php' ?>
	
	</head>
	<body>

		<header class="header">
			<div class="container">
				<div class="row">
					<div class="col-md-6">
						<a href="./" class="logo">
							<img src="<?= base_url() ?>assets/images/logo.png" alt="INDOFxSpot">
						</a>
					</div>
					<div class="col-md-6">
						<div class="member">
							<a href="https://wa.me/<?= $getWhatsappContact ?>" id="btnWhatsapp" class="hash btn btn-md rounded-pill">Contact</a>
							<span class="separator"></span>
							<a href="#!" data-target="register" class="hash btn btn-md rounded-pill">Register</a>
							<span class="separator"></span>
							<a href="#!" data-target="login" class="hash btn btn-md rounded-pill">Login</a>
						</div><!--end:member-->
					</div>
				</div><!--end:row-->
			</div>
		</header>

    	<?= $contents ?>

		<script type="text/javascript">
			$('#btnWhatsapp').click(function(){
				var linkTo = $(this).attr('href')
				window.open(linkTo, '_blank');
			})
		</script>

    </body>
</html>