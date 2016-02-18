$(document).ready(function() {
    var $wrapper = $('#wrapper');
    var $sidebar = $('.nav.nav-sidebar');
    var $sidebarToggle = $('.sidebar-toggle');

    if ($sidebar) {

        var $link = $sidebar.find('#default').find('a').first();

        $sidebar.find('a').each(function (key, element) {
            $(element).parent().removeClass('active');

            if (window.location.href.startsWith($(element).attr('href'))) {
                if ($(element).attr('href').length > $link.attr('href').length) {
                    $link = $(element);
                }
            }
        });

        $link.parent().addClass('active');
    }

    if ($sidebarToggle) {
        $('body').on('click', function() {
            if ($(document).width() < 768) {
                $wrapper.removeClass('mobile-toggled');
            }
        });

        $sidebarToggle.on('click', function() {
            event.stopPropagation();
            $wrapper.toggleClass($(document).width() < 768 ? 'mobile-toggled' : 'toggled');
        });
    }
});