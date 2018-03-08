console.log("ok script");
$(document).ready(function() {
    $('select').material_select();
    $('.carousel').carousel();
    $(".button-collapse").sideNav();

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

    $(document).on('click', '.js-remove-wishlist', function(e){
        e.preventDefault();
        var urlArray = $(this).attr('href').split('/');
        var imdb = urlArray[urlArray.length-1];
        var url = $(this).attr('href');
        $.ajax({
            method: "GET",
            url: url,
        })
            .done(function( msg ) {
                console.log(msg)
                $("#"+imdb).fadeOut("slow");
                $("#"+imdb).remove();
            });
    })

    $( "#search" ).on('input',function() {
        var href =  $( "#search" ).attr('data-href');
       var search = $( "#search" ).val();
       if(search.length > 3){
           $.ajax({
               method: "GET",
               url: href+'/'+search,
               datatype: "JSON"
           })
               .done(function( msg ) {
                   console.log(msg)


               });
       }
    });




});