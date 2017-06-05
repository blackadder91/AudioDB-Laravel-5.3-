$(document).ready(function(){
    // Data func.: Filters
    $('[data-func="entities-filters"] .filter input').click(function() {
        var target = $(this).closest('.filters').data('target');
        var filterEl =  $(this).closest('.filter');
        var filterField = filterEl.data('field');
        var targetEl = $('[data-id="'+target+'"]');
        var activeFilterValues = [];

        // collect active filter values
        filterEl.find('input[type="checkbox"]:checked').each(function() {
            activeFilterValues.push($(this).val());
        })

        // do the filtering
        if (activeFilterValues.length == 0)
            targetEl.find('.item').show();
        else {
            targetEl.find('.item').each(function() {
                if ( $.inArray($(this).data(filterField), activeFilterValues) == -1 )
                    $(this).fadeOut(500);
                else
                    $(this).fadeIn(500);
            })
        }

    });

    // Data func.: View mode
    $('[data-func="view-mode"] button').click(function() {
        $('[data-func="view-mode"] button.active').removeClass('active');
        $(this).addClass('active');
        var target = $(this).parent().data('target');
        var mode = $(this).data('id');
        $('.entities.view').removeClass('active');
        if (mode == 'grid')
            $('[data-id="'+target+'"][data-func="entities-grid"]').addClass('active');
        else if (mode == 'list')
            $('[data-id="'+target+'"][data-func="entities-list"]').addClass('active');

    });

    // Function: delete
    $('[data-func="delete"]').click(function(e) {
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });

        $.ajax({
            type: "DELETE",
            url: $(this).attr('href'),
            success: function (data) {
                if (data == 1) {
                    alert('Entity succesfully deleted');
                    window.location.href = $('#back_to_index').attr('href');
                } else {
                    alert('Failed to delete entity.\nResponse: ' + data);
                }
            },
            error: function (data) {
                alert('Error occured. See console log for more details');
                console.log('Error:', data);
            }
        });
    })
})
