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
		<header class="header">
	<div class="container">
		<nav class="header__nav navbar navbar navbar-expand-lg navbar-light">
			<a class="navbar-brand" href="#">
				<img src="img/common/logo.jpg" alt="" style="width: 65px; height: 65px;">
				<span class="header__name">e-Zвилина</span>
			</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="header__navbar collapse navbar-collapse justify-content-center" id="navbarSupportedContent">
				<ul class="navbar-nav my-auto">
					<li class="nav-item header__navbar-item active">
						<button class="header__navbar-btn fancy btn btn-danger" data-fancybox data-toggle="tooltip" data-placement="bottom" title="Уволить сотрудника"><i class="icon-user-times"></i></button>
					</li>
					<li class="nav-item header__navbar-item">
						<button class="header__navbar-btn fancy btn btn-primary" data-fancybox data-toggle="tooltip" data-placement="bottom" title="Добавить сотрудника"><i class="icon-user-plus"></i></button>
					</li>
				</ul>
			</div>
			<form class="form-inline">
				<input class="form-control mr-sm-2" type="text" placeholder="Поиск по сотрудникам и вакансиям" aria-label="Search">
				<button class="btn btn-outline-success my-2 my-sm-0" type="submit">Найти</button>
			</form>
		</nav>
	</div>
</header>

		<main class="main">
			<div class="container">
				

				<div class="row">

					<div class="col-md-3">
					
						<nav class="nav flex-column">
	<a class="nav-link" href="competentions.php">Компетенции</a>
	<a class="nav-link" href="specialities.php">Специальности</a>
	<a class="nav-link" href="positions.php">Должности</a>
	<a class="nav-link" href="emplyers.php">Сотрудники</a>
	<a class="nav-link" href="experts.php">Эксперты</a>
	<a class="nav-link" href="retraining.php">Переквалификация</a>
	<a class="nav-link" href="trainings.php">Тренинги</a>
</nav>
					
					</div>


					<div class="col-md-9">
					
						<form class="form-inline mb-5 mt-2">
	<input class="form-control mr-sm-2" type="text" placeholder="Поиск по сотрудникам и вакансиям" aria-label="Search">
	<button class="btn btn-outline-success my-2 my-sm-0" type="submit">Найти</button>
</form>

<table class="table table-striped table-hover table-sm">
	<thead>
		<tr>
			<th>
				<label class="custom-control custom-checkbox mb-0">
				  <input type="checkbox" class="custom-control-input" name="workers">
				 	<span class="custom-control-label">Выбрать все</span>
				</label>
			</th>
			<th>Ф.И.О.</th>
			<th>Должность</th>
			<th>Действия</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>
				<label class="custom-control custom-checkbox mb-0">
				  <input type="checkbox" class="custom-control-input" name="worker">
				 	<span class="custom-control-label">Выбрать</span>
				</label>
			</td>
			<td>Mark</td>
			<td>Otto</td>
			<td>
				<div class="btn-group btn-group-sm" role="group">
				  <button type="button" class="btn fancybox btn-info" data-src="#worker-card" data-toggle="tooltip" data-placement="top" title="Информация"><i class="icon-info"></i></button>
				  <button type="button" class="btn fancybox btn-danger" data-toggle="tooltip" data-placement="top" title="Уволить"><i class="icon-user-times"></i></button>
				</div>
			</td>
		</tr>
		<tr>
			<td>
				<label class="custom-control custom-checkbox mb-0">
				  <input type="checkbox" class="custom-control-input" name="worker">
				 	<span class="custom-control-label">Выбрать</span>
				</label>
			</td>
			<td>Jacob</td>
			<td>Thornton</td>
			<td>
				<div class="btn-group btn-group-sm" role="group">
				  <button type="button" class="btn fancybox btn-info" data-src="#worker-card" data-toggle="tooltip" data-placement="top" title="Информация"><i class="icon-info"></i></button>
				  <button type="button" class="btn fancybox btn-danger" data-toggle="tooltip" data-placement="top" title="Уволить"><i class="icon-user-times"></i></button>
				</div>
			</td>
		</tr>
	</tbody>
</table>
					
					</div>

				</div>
				

			</div>
		</main>

	</div>


	<div id="worker-card" class="card worker-card" hidden>
	<div class="card-body worker-card__body">
		<h4 class="card-title worker-card__title">Петров Федр Иванович</h4>
		<h6 class="card-subtitle mb-2 text-muted worker-card__position">Директор IT департамента</h6>
		<div class="card-text worker-card__info">
			Информация
			<img class="worker-card__photo" src="img/upload/worker-1.jpg" alt="">
		</div>
	</div>
</div>


	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.15.0/umd/popper.js"></script>
	<script src="/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>
	<script src="js/common.js"></script>
</body>
</html>