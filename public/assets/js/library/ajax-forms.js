$(document).ready(function() {
    $('[data-ajax="true"]').on('click', function(event) {
        event.preventDefault();

        var modal = $($(this).data('target'));

        modal.load($(this).data('source'), function() {
            modal.modal('show');

            modal.find('button[type="submit"]').on('click', function () {
                var form = modal.find('form');

                $.post(form.attr('action'), form.serialize(), function (response) {
                    modal.modal('hide');
                })
            });
        });
    });
});