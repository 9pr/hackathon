<div class="retraining">
	<h1 class="mb-4">Переквалификация</h1>
	<div class="row">

		<div class="col-md-6">
			<h4 class="mb-3 retraining__caption">Сокращенные специальности <i class="icon-right-fat"></i></h4>
			<div class="retraining__col">
				<div class="input-group">
				  <input type="text" class="retraining__search form-control" placeholder="Поиск по специальностям" aria-label="">
				  <div class="input-group-append">
				    <button class="btn btn-info" type="button"><i class="icon-search"></i></button>
				  </div>
				</div>
				<div class="retraining__list list-group">
					
{% set specialities = "\<\?php require_once(\'data.php\') \?\>" %}


				{% for item in specialities %}
					{{item}}
					<label class="retraining__list-item list-group-item custom-control custom-checkbox">
					  <input type="checkbox" class="retraining__list-checkbox custom-control-input" name="speciality_past" value="{{ item.speciality_id }}">
					 	<span class="retraining__list-label custom-control-label">{{ item.speciality_name | safe }}</span>
					</label>
					{% endfor %}
				</div>
				<label class="retraining__list-item list-group-item list-group-item-info custom-control custom-checkbox">
				  <input type="checkbox" class="retraining__list-checkbox custom-control-input" name="speciality_past" value="0">
				 	<span class="retraining__list-label retraining__list-label_on custom-control-label">Выделить все</span>
				 	<span class="retraining__list-label retraining__list-label_off custom-control-label">Снять все</span>
				</label>
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
				<label class="retraining__list-item list-group-item list-group-item-info custom-control custom-checkbox">
				  <input type="checkbox" class="retraining__list-checkbox custom-control-input" name="speciality_next" value="0">
				 	<span class="retraining__list-label retraining__list-label_on custom-control-label">Выделить все</span>
				 	<span class="retraining__list-label retraining__list-label_off custom-control-label">Снять все</span>
				</label>
			</div>
		</div>

	</div>

	<div class="row">
		<div class="col-12 mt-4 my-4 text-center">
			<button class="btn btn-success" type="submit">Подобрать</button>
		</div>
	</div>
</div>