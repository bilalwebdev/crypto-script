jQuery(window).on("load", function () {
    $('#main-wrapper').addClass('show');
});

(function ($) {
    "use strict";

    $("#menu").metisMenu();


    $('.searchNav').on('keyup', function () {

        var search = $(this).val().toLowerCase();

        var result = $('.search-item');


        $(result).html('');

        if (search.length == 0) {
            $('.search-item').addClass('d-none');
            return;
        }
        $('.search-item').removeClass('d-none');


        var searchResult = $('.metismenu a').not('.has-arrow').filter(function (index, item) {
            return $(item).text().trim().toLowerCase().indexOf(search) >= 0 ? item : null;
        }).sort();


        if (searchResult.length == 0) {
            $(result).append('<li class="text-muted pl-5">No search result found.</li>');
            return;
        }

        searchResult.each(function (index, item) {
            var item_url = $(item).attr('href');
            var item_text = $(item).text().replace(/(\d+)/g, '').trim();
            $(result).append(`
            <li>
            
              <a href="${item_url}" class="d-block">${item_text}</a>
            </li>
          `);
        });

    });


    $("#checkAll").change(function () {
        $("td input:checkbox").prop('checked', $(this).prop("checked"));
    });

    $(".nav-control").on('click', function () {

        $('#main-wrapper').toggleClass("menu-toggle");

        $(".hamburger").toggleClass("is-active");
    });

    //to keep the current page active
    $(function () {
        for (var nk = window.location,
            o = $("ul#menu a").filter(function () {
                return this.href == nk;
            })
                .addClass("mm-active")
                .parent()
                .addClass("mm-active"); ;) {
            // console.log(o)
            if (!o.is("li")) break;
            o = o.parent()
                .addClass("mm-show")
                .parent()
                .addClass("mm-active");
        }

        $("ul#menu>li").on('click', function () {
            const sidebarStyle = $('body').attr('data-sidebar-style');
            if (sidebarStyle === 'mini') {
                console.log($(this).find('ul'))
                $(this).find('ul').stop()
            }
        })
    });

    $('a[data-action="collapse"]').on("click", function (i) {
        i.preventDefault(),
            $(this).closest(".card").find('[data-action="collapse"] i').toggleClass("mdi-arrow-down mdi-arrow-up"),
            $(this).closest(".card").children(".card-body").collapse("toggle");
    });

    $('a[data-action="expand"]').on("click", function (i) {
        i.preventDefault(),
            $(this).closest(".card").find('[data-action="expand"] i').toggleClass("icon-size-actual icon-size-fullscreen"),
            $(this).closest(".card").toggleClass("card-fullscreen");
    });



    $('[data-action="close"]').on("click", function () {
        $(this).closest(".card").removeClass().slideUp("fast");
    });

    $('[data-action="reload"]').on("click", function () {
        var e = $(this);
        e.parents(".card").addClass("card-load"),
            e.parents(".card").append('<div class="card-loader"><i class=" ti-reload rotate-refresh"></div>'),
            setTimeout(function () {
                e.parents(".card").children(".card-loader").remove(),
                    e.parents(".card").removeClass("card-load")
            }, 2000)
    });

    const headerHight = $('.header').innerHeight();

    $(window).scroll(function () {
        if ($('body').attr('data-layout') === "horizontal" && $('body').attr('data-header-position') === "static" && $('body').attr('data-sidebar-position') === "fixed")
            $(this.window).scrollTop() >= headerHight ? $('.quixnav').addClass('fixed') : $('.quixnav').removeClass('fixed')
    });

})(jQuery);

const qs = new PerfectScrollbar('.quixnav-scroll');

$('.btn-number').on('click', function (e) {
    e.preventDefault();

    fieldName = $(this).attr('data-field');
    type = $(this).attr('data-type');
    var input = $("input[name='" + fieldName + "']");
    var currentVal = parseInt(input.val());
    if (!isNaN(currentVal)) {
        if (type == 'minus')
            input.val(currentVal - 1);
        else if (type == 'plus')
            input.val(currentVal + 1);
    } else {
        input.val(0);
    }
});

$('.sidebar-open').on('click', function () {
    $('.quixnav').toggleClass('active');
    $(this).toggleClass('active');
});

$('.mobile-search-toggle').on('click', function(){

    $(this).toggleClass('active');

    $('.header-search form').toggleClass('active');
});

feather.replace();

$('.header-search .header-search-res-btn').on('click', function(){
    $('.header-search .form').toggleClass('active');
});

$(document).on('click touchstart', function (e){
    if (!$(e.target).is('.header-search-res-btn, .header-search-res-btn *, .header-search .form, .header-search .form *')) {
      $('.header-search .form').removeClass('active');
    }
});