//=require retraining/_script.js

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