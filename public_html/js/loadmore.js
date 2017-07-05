(function($) {

	$.fn.loadmore = function(options) {
		var self = this,
			settings = $.extend({
				source: '',
				step: 2
			}, options),

			stepped = 1,
			item = self.find('.item'),
			items = self.find('.items'),

			finished = function() {
				 self.find('.items-load').remove();
			},

			append = function(value) {

				var name, part;

				item.remove();

				for(name in value) {
					if(value.hasOwnProperty(name)) {
						part = item.find('*[data-field="' + name + '"]');

						if(part.length) {
							part.text(value[name]);
						}
					}
				}

				item.clone().appendTo(items);

			},
			load = function(start, count) {
				$.ajax({
					url: settings.source,
					type: 'get',
					dataType: 'json',
					data: {start: start, count: count},
					success: function(data) {
						var items = data.items;

						if(items.length) {
							$(items).each(function(index, value) {
								append(value);
							});

							stepped = stepped + count;
						}

						if(data.last === true) {
							finished();
						}

					}
				});

			};

			if(settings.source.length) {

				self.find('.items-load').on('click', function() {

					load(stepped, settings.step);
					return false;

				});

				load(1, settings.step);

			} else {
				console.log('Source requires for loadmore');
			}
	};


}(jQuery))