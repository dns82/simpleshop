<!DOCTYPE html>
<html lang="en-US">
<head>
	<title><?php echo $title ?></title>
	
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0" >
	
	<link rel="stylesheet" href="<?php echo $latest_build_path . '/css/concatenated/style.css' ?>" media="all" />
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
	<script data-main="/assets/js/app" src="/assets/js/require.js"></script>
</head>
<body>

	<header class="main-header">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-2"></div>
				<div class="col-md-8">
					<h1 class="title"><a href="/"><?php echo $header_title ?></a></h1>
					<?php echo $mini_cart?>	
				</div>
				<div class="col-md-2"></div>
			</div>
		</div>
	</header>
	
	<main>
		<section class="main-content">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-12">
						<?php echo $content ?>
					</div>
				</div>
			</div>
		</section>
	</main>
</body>
</html>