jQuery(document).ready(function ($) {
    $('#car-sort').on('change', function () {
        const sortOrder = $(this).val();

        $.ajax({
            url: ajax_obj.ajax_url,
            type: 'POST',
            data: {
                action: 'filter_cars',
                order: sortOrder,
            },
            success: function (response) {
                $('#car-posts-container').html(response);
            },
        });
    });
});
