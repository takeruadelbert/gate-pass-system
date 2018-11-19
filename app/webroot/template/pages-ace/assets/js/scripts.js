$(document).ready(function() {
    // Initializes search overlay plugin.
    // Replace onSearchSubmit() and onKeyEnter() with 
    // your logic to perform a search and display results
    $('[data-pages="search"]').search({
        searchField: '#overlay-search',
        closeButton: '.overlay-close',
        suggestions: '#overlay-suggestions',
        brand: '.brand',
        onSearchSubmit: function(searchString) {
            console.log("Search for: " + searchString);
        },
        onKeyEnter: function(searchString) {
            console.log("Live search for: " + searchString);
            var searchField = $('#overlay-search');
            var searchResults = $('.search-results');
            clearTimeout($.data(this, 'timer'));
            searchResults.fadeOut("fast");
            var wait = setTimeout(function() {
                searchResults.find('.result-name').each(function() {
                    if (searchField.val().length != 0) {
                        $(this).html(searchField.val());
                        searchResults.fadeIn("fast");
                    }
                });
            }, 500);
            $(this).data('timer', wait);
        }
    });
    var $filters = $('#filters');
    $('[data-toggle="filters"]').click(function() {
        $filters.toggleClass('open');
    });
    $("body").after($filters.remove());

    $(".pages-date").datepicker({
        format: "yyyy-mm-dd",
    }).after('<span class="input-group-addon"><i class="fa fa-calendar"></i></span>').parent("div").addClass("input-group");
    $(':input[required=""],:input[required]').parent("div").addClass("required");
    $('.summernote').summernote({
        height: 200,
        onfocus: function(e) {
            $('body').addClass('overlay-disabled');
        },
        onblur: function(e) {
            $('body').removeClass('overlay-disabled');
        }
    });
    $(".pages-time").after('<span class="input-group-addon"><i class="pg-clock"></i></span>').timepicker({
        showMeridian: false,
        defaultTime: false,
        minuteStep: 1,
    }).on('show.timepicker', function(e) {
        var widget = $('.bootstrap-timepicker-widget');
        widget.find('.glyphicon-chevron-up').removeClass().addClass('pg-arrow_maximize');
        widget.find('.glyphicon-chevron-down').removeClass().addClass('pg-arrow_minimize');
    }).parent("div").addClass("bootstrap-timepicker input-group");
})