$(document).ready(function() {
    var $wrapper = $('#wrapper');
    var $sidebar = $('.nav.nav-sidebar');
    var $sidebarToggle = $('.sidebar-toggle');

    if ($sidebar) {
        var link = $sidebar.find('#default').find('a').first();

        $sidebar.find('a').each(function (key, element) {
            $(element).parent().removeClass('active');

            if (window.location.href.startsWith($(element).attr('href'))) {
                if ($(element).attr('href').length > link.attr('href').length) {
                    link = $(element);
                }
            }
        });

        link.parent().addClass('active');
    }

    if ($sidebarToggle) {
        $sidebarToggle.on('click', function() {
            $wrapper.toggleClass('toggled');
        });
    }
});