/*
 * Created by ThemeBucket on 11/23/15.
 * version 1.0
 * Copyright (c) 2015 "ThemeBucket"
 */

/*
 * jQuery throttle / debounce - v1.1 - 3/7/2010
 * http://benalman.com/projects/jquery-throttle-debounce-plugin/
 *
 * Copyright (c) 2010 "Cowboy" Ben Alman
 * Dual licensed under the MIT and GPL licenses.
 * http://benalman.com/about/license/
 */

(function (b, c) {
    var $ = b.jQuery || b.Cowboy || (b.Cowboy = {}), a;
    $.throttle = a = function (e, f, j, i) {
        var h, d = 0;
        if (typeof f !== "boolean") {
            i = j;
            j = f;
            f = c
        }
        function g() {
            var o = this, m = +new Date() - d, n = arguments;

            function l() {
                d = +new Date();
                j.apply(o, n)
            }

            function k() {
                h = c
            }

            if (i && !h) {
                l()
            }
            h && clearTimeout(h);
            if (i === c && m > e) {
                l()
            } else {
                if (f !== true) {
                    h = setTimeout(i ? k : l, i === c ? e - m : e)
                }
            }
        }

        if ($.guid) {
            g.guid = j.guid = j.guid || $.guid++
        }
        return g
    };
    $.debounce = function (d, e, f) {
        return f === c ? a(d, e, false) : a(d, f, e !== false)
    }
})(this);


/*
 * tbmenu - dropdown mega menu
 * Created by ThemeBucket on 11/23/15.
 * version 1.0
 * Copyright (c) 2015 "ThemeBucket"
 */


var tbmenu = {
    defaults:{
        selector:".tbmenu",
        breakpoint:1024
    },
    settings:{},
    prepare: function () {

        $('.nav-btn').click(function () {
            $('ul'+tbmenu.settings.selector).toggle();
        })

        $(tbmenu.settings.selector + "li.menu-right").addClass('tb-r-align');
    },
    fixMenu: function () {
        var w = $(window).width();

        if ($(window).width() > tbmenu.settings.breakpoint) {
            $('ul'+tbmenu.settings.selector).removeAttr('style');
        }

        if (w <= tbmenu.settings.breakpoint) {
            $(tbmenu.settings.selector).removeClass('fade-effect slide-effect');
            $(".tb-r-align").removeClass('menu-right');
            $(tbmenu.settings.selector+" li").has('ul').find('a:eq(0)').addClass("tb-accordion");
            $(tbmenu.settings.selector+" li").has('.mega-menu').find('a:eq(0)').addClass("tb-accordion");
            $(tbmenu.settings.selector + ' ul, .tbmenu li > div').addClass('hidden-sub');
        } else {
            $(tbmenu.settings.selector+" li").has('ul').find('a:eq(0)').removeClass("tb-accordion");
            $(tbmenu.settings.selector+" li").has('.mega-menu').find('a:eq(0)').removeClass("tb-accordion");
            $(".tb-r-align").addClass('menu-right');
            $(tbmenu.settings.selector).addClass('fade-effect slide-effect');
            $(tbmenu.settings.selector + ' ul, .tbmenu li > div').removeClass('hidden-sub');
        }
    },
    addIconToParent: function () {
//             $("li").has('ul').find('a:eq(0)').append(icon);
        $(tbmenu.settings.selector + " li").has('ul').find('a:eq(0)').each(function () {
            $(this).html($(this).html() + "<i class='arrow fa fa-angle-right'/>");
        });
        $(tbmenu.settings.selector + " li").has('.mega-menu').find('a:eq(0)').each(function () {
            $(this).html($(this).html() + "<i class='arrow fa fa-angle-right'/>");
        });

    },
    makeAccordionInResponsiveView: function () {

        $(tbmenu.settings.selector).on("click", 'a.tb-accordion', function (e) {

            var children = $(this).next('ul').find(".visible-sub");
            var parents = $(this).parents(".visible-sub");


            if($(this).hasClass("tb-accordion-open")){
                $(this).next('ul').removeClass("visible-sub").addClass('hidden-sub');
                $(this).next('ul').find('ul').removeClass("visible-sub").addClass('hidden-sub');

                $(this).next('.mega-menu').removeClass("visible-sub").addClass('hidden-sub');

                $(this).removeClass("tb-accordion-open");
                return true;
            } else {
                $(".tb-accordion-open").removeClass("tb-accordion-open");
                $(this).parents('li').find('a:eq(0)').addClass("tb-accordion-open");
                $(this).addClass("tb-accordion-open");
            }

            $(".visible-sub").not(parents).not(children).toggleClass('hidden-sub visible-sub');
            $(this).next('ul').toggleClass('hidden-sub visible-sub');
            $(this).next('.mega-menu').toggleClass('hidden-sub visible-sub');
        });
    },
    init:function(options){
        tbmenu.settings = $.extend(tbmenu.defaults,options);
        tbmenu.prepare();
        tbmenu.fixMenu();
        tbmenu.addIconToParent();
        tbmenu.makeAccordionInResponsiveView();

        $(window).resize($.debounce(250, tbmenu.fixMenu));
    }
}