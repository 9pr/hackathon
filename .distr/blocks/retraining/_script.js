$(function(){

	initCompareSpecialities();
	initSearchSpecialities();
	initSelectAll();

});


function initCompareSpecialities() {

	if (!$('input.retraining__list-checkbox').length) return;

	$(document).on('change', 'input.retraining__list-checkbox', function(){
		var $_this = $(this),
				val = parseInt($_this.val()),
				name = $_this.next('.retraining__list-label').text(),
				checked = this.checked,
				$_double = $('input.retraining__list-checkbox[value="'+val+'"]').not($_this)
			;
console.log(name, val);
		if (!val || !$_double.length) return;
		if (checked == true) {
			$_double.prop('checked', false);
			$_double.closest('.retraining__list-item').hide();
		} else {
			$_double.closest('.retraining__list-item').show();
		}
	});

}


function initSelectAll() {
	$('input.retraining__list-checkbox[value="0"]').on('change', function(){
		var $_this = $(this),
				name = $_this.attr('name'),
				checked = $_this.prop('checked')
			;

		if (checked) {
			$('input.retraining__list-checkbox[name="'+name+'"]').prop('checked', 'checked');
		} else {
			$('input.retraining__list-checkbox[name="'+name+'"]').prop('checked', false);
		}

		initCompareSpecialities();
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

		if (!$.trim( str ) || str.length < 3) {;

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