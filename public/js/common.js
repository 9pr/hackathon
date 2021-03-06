$(function(){

	initCompareSpecialities();
	initSearchSpecialities();
	initCompareSubmit();

});


function initCompareSpecialities() {

	if (!$('input.retraining__list-checkbox').length) return;

	$(document).on('change', 'input.retraining__list-checkbox', function(){
		var $_this = $(this),
				val = parseInt($_this.val()),
				name = $_this.attr('name'),
				checked = this.checked,
				$_double = $('input.retraining__list-checkbox[value="'+val+'"]').not($_this)
			;

		if ($_double.length) {
			if (checked == true) {
				$_double.prop('checked', false);
				$_double.closest('.retraining__list-item').hide();
			} else {
				$_double.closest('.retraining__list-item').show();
				//$('input.retraining__list-checkbox[name="'+name+'"][value="0"]').prop('checked', false);
			}
		}

		// if (val == 0) {
		// 	if (checked) {
		// 		$('input.retraining__list-checkbox').prop('checked', true);
		// 		$('input.retraining__list-checkbox[name="'+name+'"]').prop('checked', true);
		// 	} else {
		// 		$('input.retraining__list-checkbox[name="'+name+'"]').prop('checked', false);
		// 	}
		// }

		// if ($('input.retraining__list-checkbox[name="'+name+'"]').length - 1 == $('input.retraining__list-checkbox[name="'+name+'"]:checked').length) {
		// 	$('input.retraining__list-checkbox[name="'+name+'"][value="0"]').prop('checked', true);
		// }
	});

}



function initSearchSpecialities() {

	if (!$('input.retraining__search').length) return;

	var specialitiesArr = {};
	$('.retraining__list-label').map(function(){
		var key = $(this).text().toLowerCase(),
				val = $(this).parent().find(':checkbox').val()
			;
		specialitiesArr[key] = val;
	});

	$('input.retraining__search').on('keyup', function(){

		var $_this = $(this),
					str = $.trim( $_this.val() ).toLowerCase(),
					$_parent = $_this.closest('div.retraining__col')
				;

		if ($.trim( str ) || str.length > 2) {
			$_parent.find('.retraining__list-item').hide();
			$.each(specialitiesArr, function(k,v){
				if (k.indexOf(str) > -1) {
					$('input.retraining__list-checkbox[value="'+v+'"]').closest('.retraining__list-item').show();
				}
			});

		} else {
			$_parent.find('.retraining__list-item').show();
		}
	});

}


function initCompareSubmit() {
	if (!$('#retraining__compare').length) return;

	$('#retraining__compare').on('click', function(){
		var speciality_past = [],
				speciality_next = []
			;

		$('input[name="speciality_past"]:checked').map(function(){
			speciality_past.push( $(this).val() );
		});
		$('input[name="speciality_next"]:checked').map(function(){
			speciality_next.push( $(this).val() );
		});

		var compare = speciality_past + ':' + speciality_next;

		$.getJSON( 'http://hr.9pr.ru/index.php?class=competence&method=reducible&value='+compare, function( data ) {
			if (data) {
				$('#retraining-table').show();
			}

			var filter_post = [];
		  console.log(data);
		  $.each(data['need_speciality'], function(kn,vn){
		  	$('.retraining-table__filter_needpost').append(
	  			$('<option>', {'html': vn.speciality_name, 'value': vn.speciality_name, 'name': 'retraining-table__filter_needpost'})
	  		);
		  });

		  $.each(data['employee_removed'], function(k,v){
		  	//console.log(k, v);
		  	$('.retraining-table__filter_name').append(
	  			$('<option>', {'html': v.employee_surname + ' ' + v.employee_name + ' ' + v.employee_fathers_name, 'value': v.employee_surname + ' ' + v.employee_name + ' ' + v.employee_fathers_name})
	  		);

		  	if(filter_post.indexOf(v.post_name) < 0) {
		  		filter_post.push(v.post_name);
		  	}

		  	// Строка
		  	$.each(v['posted'], function(kd, vd){
		  		//console.log(kd, vd);

		  		var wanted_skills = vd['competence_absent'] ? Object.keys(vd['competence_absent']).length : 0;
		  		var tr = $('<tr>').append(
			  		$('<td>', {'class': 'td__filter_name', 'html': v.employee_surname + ' ' + v.employee_name + ' ' + v.employee_fathers_name + ' ' + v.employee_birthday})
			  	).append(
			  		$('<td>', {'class': 'td__filter_post', 'html': v.post_name})
			  	).append(
			  		$('<td>', {'class': 'td__filter_needpost', 'html': vd['post']})
			  	).append(
			  		$('<td>', {'html': wanted_skills})
			  	).append(
			  		$('<td>', {'html': wanted_skills})
			  	).append(
			  		$('<td>', {'html': wanted_skills})
			  	);
			  	tr.appendTo('#retraining-table tbody');
		  	});

		  });

		  $.each(filter_post, function(i,v){
		  	$('.retraining-table__filter_post').append(
	  			$('<option>', {'html': v, 'value': v})
	  		);
		  });


		  $('.retraining__tab_compare').hide();
		  $('.retraining__tab_table').show();


		  $('.retraining-table__filter').on('change', function(){
		  	var $_this = $(this),
		  			name = $_this.attr('name'),
		  			td = name.replace('retraining-table', 'td'),
		  			val = $_this.val()
		  		;
		  	$('.retraining-table__filter').prop('selectedIndex', 0);
		  	$('#retraining-table tbody tr').hide();
		  	$('td.'+td+':contains('+val+')').closest('tr').show();
		  });
		});
	});
}

$(function(){
	initTooltips();
	initFancybox()
});


function initTooltips() {
	if (!$('[data-toggle="tooltip"]').length) return;
	$('[data-toggle="tooltip"]').tooltip();
}


function initFancybox() {
	if (!$('.fancybox').length) return;

	$(document).on('init.fancybox', '.fancybox', function () {
		var
		defaults = {
			width: 1180,
			autoSize: false,
			autoHeight: true,
			minWidth: 320,
			autoResize: true,
			padding: 0,
			margin: 0,
			helpers: {
				media: {},
				overlay: {
					locked: false
				}
			},
			youtube: {
				autoplay: 1,
				showinfo: 0,
				rel: 0,
				modestbranding: 1
			},
			iframe: {
				preload: false
			},
			tpl: {
				closeBtn: '<a title="Закрыть" class="fancybox-item fancybox-close" href="javascript:;"></a>',
				next: '<a title="Далее" class="fancybox-nav fancybox-next" href="javascript:;"><span class="icon-next"></span></a>',
				prev: '<a title="Назад" class="fancybox-nav fancybox-prev" href="javascript:;"><span class="icon-prev"></span></a>'
			}
		},
		$el = $(this),
		group = $el.attr('data-fancybox-group'),
		options = eval('[' + $el.data('fancybox-options') + ']')[0]
		;

		if (group) $el = $('[data-fancybox-group="' + group + '"]');

		$.extend(defaults, options);

		$el.fancybox(defaults);
	});

	$('.fancybox').trigger('init.fancybox');
}