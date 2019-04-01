$( document ).ready(function() {
    $('#credit-card-new').change(function() {
        console.log('enable form');
        // Add required when a new card is being created
        $('.checkout-form').find('input[type=text], select').attr('required', true);
    });

    $('.credit-card-file').change(function() {
        console.log('disable form');
        // Remove required when using a card that was saved
        $('.checkout-form').find('input[type=text], select').removeAttr('required');
    });
});

