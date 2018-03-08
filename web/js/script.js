console.log("ok script");
$(document).ready(function() {
    $('select').material_select();


    $(document).on('click','.js-add-wishlist', function(e){
        e.preventDefault();
        var url = $(this).parent().attr('href');
        var returnUrl = $(this).parent().attr('data-url');
        $.ajax({
            method: "GET",
            url: url,
        })
            .done(function( msg ) {
                $('.js-hide').addClass('hide');
                $("#js-wishlist").find('.js-add-clone').remove();
                var clone = $('.js-remove-clone:first').clone();
                clone.find('a').attr('href',returnUrl );
                clone.find('a').attr('data-url',url );
                clone.clone().removeClass('hide').appendTo("#js-wishlist");
            });
    })

    $(document).on('click','.js-remove-wishlist' ,function(e){
        e.preventDefault();
        var url = $(this).parent().attr('href');
        var returnUrl = $(this).parent().attr('data-url');
        $.ajax({
            method: "GET",
            url: url,
        })
            .done(function( msg ) {
                $('.js-hide').addClass('hide');
                $("#js-wishlist").find('.js-remove-clone').remove();
                var clone = $('.js-add-clone:first').clone();
                clone.find('a').attr('href',returnUrl );
                clone.find('a').attr('data-url',url );
                clone.removeClass('hide').appendTo("#js-wishlist");
            });
    })





});