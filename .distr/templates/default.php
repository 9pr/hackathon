<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="SKYPE_TOOLBAR" content="SKYPE_TOOLBAR_PARSER_COMPATIBLE">

	<title>МТС | Профпереподготовка</title>

	<link rel="icon" href="https://mtscu.ru/uploads/2019/06/favicon.ico" sizes="32x32">
	<link rel="icon" href="https://mtscu.ru/uploads/2019/06/favicon.ico" sizes="192x192">
	<link rel="apple-touch-icon-precomposed" href="https://mtscu.ru/uploads/2019/06/favicon.ico">
	<meta name="msapplication-TileImage" content="https://mtscu.ru/uploads/2019/06/favicon.ico">

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css" />
	<link rel="stylesheet" type="text/css" href="css/style.css">

	<!--[if lt IE 9]><script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv-printshiv.min.js"></script><![endif]-->
	<!--[if lte IE 8]><script src="//phpbbex.com/oldies/oldies.js" charset="utf-8"></script><![endif]-->
	<script src="/node_modules/jquery/dist/jquery.min.js"></script>
</head>
<body>


	<div class="page-wrapper">
		{% include 'header/block.php' %}

		<main class="main">
			<div class="container">
				{% block blocks %}

				<div class="row">

					<div class="col-md-3">
					{% block right %}
						{% include 'right_menu/block.php' %}
					{% endblock %}
					</div>


					<div class="col-md-9">
					{% block main %}
						{% include 'main/block.php' %}
					{% endblock %}
					</div>

				</div>
				{% endblock %}

			</div>
		</main>

	</div>


	{% include 'worker_card/block.php' %}


	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.15.0/umd/popper.js"></script>
	<script src="/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>
	<script src="js/common.js"></script>
</body>
</html>