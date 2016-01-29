$(document).ready(function() {
    var sidebar = $('.nav.nav-sidebar');
    if (sidebar) {
        sidebar.find('a').each(function (key, element) {
            if ($(element).attr('href') == window.location.href)  {
                $(element).parent().addClass('active');
            } else {
                $(element).parent().removeClass('active');
            }
        });
    }
});