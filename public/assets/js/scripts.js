/* ---------------------------------------------
 common scripts
 --------------------------------------------- */

;(function () {

    "use strict"; // use strict to start

    $(document).ready(function () {


        //nav accordion

        $('#nav-accordion').dcAccordion({
            eventType: 'click',
            autoClose: true,
            saveState: true,
            disableLink: true,
            speed: 'slow',
            showCount: false,
            autoExpand: true,
//        cookie: 'dcjq-accordion-1',
            classExpand: 'dcjq-current-parent'
        });


        // left nav toggler
        $('.js_left-nav-toggler').on('click', function () {
            $(document.body).toggleClass('left-nav-toggle');
        });

        // right side toggle

        $(".right_side_toggle").on('click', function(){
            $('#right_side_bar').toggleClass('show');
        });


        /* ---------------------------------------------
         custom scroll
         --------------------------------------------- */
        $(".left-sidebar .sidebar-menu, .mail-page .mail-list-scroll").niceScroll({
            cursorcolor:"#626be3",
            cursorwidth:"2px",
            background:"transparent",
            cursorborder:"2px solid #3da5f4",
            cursorborderradius: 0
        });


        /* ---------------------------------------------
         Accordion init
         --------------------------------------------- */

        var allPanels = $(".accordion > dd").hide();
        allPanels.first().slideDown("easeOutExpo");
        $(".accordion").each(function () {
            $(this).find("dt > a").first().addClass("active").parent().next().css({display: "block"});
        });

        $(".accordion > dt > a").click(function () {

            var current = $(this).parent().next("dd");
            $(this).parents(".accordion").find("dt > a").removeClass("active");
            $(this).addClass("active");
            $(this).parents(".accordion").find("dd").slideUp("easeInExpo");
            $(this).parent().next().slideDown("easeOutExpo");

            return false;

        });


        /* ---------------------------------------------
         Toggle init
         --------------------------------------------- */

        var allToggles = $(".toggle > dd").hide();
        $(".toggle > dt > a").click(function () {

            if ($(this).hasClass("active")) {

                $(this).parent().next().slideUp("easeOutExpo");
                $(this).removeClass("active");

            }
            else {
                var current = $(this).parent().next("dd");
                $(this).addClass("active");
                $(this).parent().next().slideDown("easeOutExpo");
            }

            return false;
        });

        /* ---------------------------------------------
         Configure tooltips globally
         --------------------------------------------- */

        $('[data-toggle="tooltip"]').tooltip();

        /* ---------------------------------------------
         Configure popover globally
         --------------------------------------------- */
        $('[data-toggle="popover"]').popover();


    });

})(jQuery);


