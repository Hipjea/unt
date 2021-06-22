(function($) {
	wp.customize('unt_urgent_styles', function(value) {
        var options = ['main-color', 'secondary-color', 'tertiary-color'],
            size = options.length,
            style = $('#custom-theme-options'),
            css = style.html();
        for(var i = 0; i <= size; i++) {
            value.bind(function(to) {
                var option = style.data(options[i]),
                    newcss = css.replace(option, to);
                style.html(newcss).data(options[i], to);
            });
        }
	});
})(jQuery);
