<div class="retraining">
	<h1 class="mb-4">Переквалификация</h1>

	<div class="retraining__tab retraining__tab_compare">
		<div class="row">

			<div class="col-md-6">
				<h4 class="mb-3 retraining__caption">Сокращаемые специальности <i class="icon-right-fat"></i></h4>
				<div class="retraining__col">
					<div class="input-group">
					  <input type="text" class="retraining__search form-control" placeholder="Поиск по специальностям" aria-label="">
					  <div class="input-group-append">
					    <button class="btn btn-info" type="button"><i class="icon-search"></i></button>
					  </div>
					</div>
					<div class="retraining__list list-group">
						{% from './data.php' import data as specialities %}

						{% for item in specialities %}
						<label class="retraining__list-item list-group-item custom-control custom-checkbox">
						  <input type="checkbox" class="retraining__list-checkbox custom-control-input" name="speciality_past" value="{{ item.speciality_id }}">
						 	<span class="retraining__list-label custom-control-label">{{ item.speciality_name | safe }}</span>
						</label>
						{% endfor %}
					</div>
					{#
					<label class="retraining__list-item list-group-item list-group-item-info custom-control custom-checkbox">
					  <input type="checkbox" class="retraining__list-checkbox custom-control-input" name="speciality_past" value="0">
					 	<span class="retraining__list-label retraining__list-label_on custom-control-label">Выделить все</span>
					 	<span class="retraining__list-label retraining__list-label_off custom-control-label">Снять все</span>
					</label>
					#}
				</div>
			</div>

			<div class="col-md-6">
				<h4 class="mb-3 retraining__caption">Требуемые специальности</h4>
				<div class="retraining__col">
					<div class="input-group">
					  <input type="text" class="retraining__search form-control" placeholder="Поиск по специальностям" aria-label="">
					  <div class="input-group-append">
					    <button class="btn btn-info" type="button"><i class="icon-search"></i></button>
					  </div>
					</div>
					<div class="retraining__list list-group">
						{% for item in specialities %}
						<label class="retraining__list-item list-group-item custom-control custom-checkbox">
						  <input type="checkbox" class="retraining__list-checkbox custom-control-input" name="speciality_next" value="{{ item.speciality_id }}">
						 	<span class="retraining__list-label custom-control-label">{{ item.speciality_name | safe }}</span>
						</label>
						{% endfor %}
					</div>
					{#
					<label class="retraining__list-item list-group-item list-group-item-info custom-control custom-checkbox">
					  <input type="checkbox" class="retraining__list-checkbox custom-control-input" name="speciality_next" value="0">
					 	<span class="retraining__list-label retraining__list-label_on custom-control-label">Выделить все</span>
					 	<span class="retraining__list-label retraining__list-label_off custom-control-label">Снять все</span>
					</label>
					#}
				</div>
			</div>

		</div>

		<div class="row">
			<div class="col-12 mt-4 my-4 text-center">
				<button id="retraining__compare" class="btn btn-lg btn-success" type="submit">Подобрать</button>
			</div>
		</div>
	</div>

	<div class="retraining__tab retraining__tab_table mt-5" style="display: none;">
		<table id="retraining-table" class="table table-bordered table-striped table-hover table-sm">
			<thead>
				<tr>
				<td width="200">
					<select class="retraining-table__filter retraining-table__filter_name custom-select">
					  <option selected value="0">Ф.И.О.</option>
					</select>
				</td>
				<td width="200">
					<select class="retraining-table__filter retraining-table__filter_post custom-select">
					  <option selected value="0">Выбрать</option>
					</select>
				</td width="200">
				<td width="200">
					<select class="retraining-table__filter retraining-table__filter_needpost custom-select">
					  <option selected value="0">Выбрать</option>
					</select>
				</td>
				<td colspan="3"></td>
			</tr>
				<tr>
					<th width="200">Ф.И.О.</th>
					<th width="200">Текущая специальность</th>
					<th width="200">Требуемая специальность</th>
					<th>Недостающие компетенции</th>
					<th>Эксперты</th>
					<th>Курсы</th>
				</tr>
			</thead>
			<tbody></tbody>
		</table>
	</div>
</div>