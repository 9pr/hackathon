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