jQuery(document).ready(function() {
    "use strict";
    jQuery('#videoslider1').tabs({
        cache: true
    });
    // initialize paging
    function init() {
        jQuery('#videoslider1').tabs('paging', {
            cycle: true,
            nextButton: 'next &gt;',
            prevButton: '&lt; prev'
        });
    }
    init();
});

$(window).bind("load", function() {
    "use strict";
    var vidWidth = jQuery(".slide_content").width();
    jQuery(".video").css("width", vidWidth);
});
jQuery(document).ready(function() {
    "use strict";
    jQuery('.crsl-items').carousels({
        visible: 3,
        itemMargin: 20
    });
    jQuery('.crsl-items1').carousels({
        visible: 2,
        itemMargin: 20
    });
    jQuery('.crsl-items2').carousels({
        visible: 2,
        itemMargin: 20
    });
    jQuery('.crsl-items3').carousels({
        visible: 1,
        itemMargin: 20
    });
});

jQuery(document).ready(function() {
    "use strict";
    jQuery('.carousels').carousel()
    jQuery('#intertabs a').click(function(e) {
        e.preventDefault()
        jQuery(intertabs).tab('show')
    })

});



jQuery(document).ready(function() {
    "use strict";
    // hide #back-top first
    jQuery(".gotop").hide();

    // fade in #back-top
    jQuery(function() {
        jQuery(window).scroll(function() {
            if (jQuery(this).scrollTop() > 100) {
                jQuery('.gotop').fadeIn();
            } else {
                jQuery('.gotop').fadeOut();
            }
        });

        // scroll body to 0px on click
        jQuery('.gotop').click(function() {
            jQuery('body,html').animate({
                scrollTop: 0
            }, 800);
            return false;
        });
    });
});

jQuery(document).on('click', '.yamm .dropdown-menu', function(e) {
    "use strict";
    e.stopPropagation()
});

jQuery(function() {
    "use strict";
    jQuery("[data-toggle='tooltip']").tooltip();
    jQuery(".alert").alert()
    jQuery('#newTab a').click(function(e) {
        e.preventDefault()
        jQuery(this).tab('show')
    })
});
jQuery(document).ready(function() {
    "use strict";
    var s = jQuery(".stickynav");
    var pos = s.position();
    jQuery(window).scroll(function() {
        var windowpos = jQuery(window).scrollTop();

        if (windowpos >= pos.top) {
            s.addClass("stick");
        } else {
            s.removeClass("stick");
        }
    });
});

(function(jQuery) {
    "use strict";
    /**
     * Copyright 2012, Digital Fusion
     * Licensed under the MIT license.
     * http://teamdf.com/jquery-plugins/license/
     *
     * @author Sam Sehnert
     * @desc A small plugin that checks whether elements are within
     *     the user visible viewport of a web browser.
     *     only accounts for vertical position, not horizontal.
     */

    jQuery.fn.visible = function(partial) {

        var jQueryt = jQuery(this),
            jQueryw = jQuery(window),
            viewTop = jQueryw.scrollTop(),
            viewBottom = viewTop + jQueryw.height(),
            _top = jQueryt.offset().top,
            _bottom = _top + jQueryt.height(),
            compareTop = partial === true ? _bottom : _top,
            compareBottom = partial === true ? _top : _bottom;

        return ((compareBottom <= viewBottom) && (compareTop >= viewTop));

    };

})(jQuery);

var win = jQuery(window);

var allMods = jQuery(".sections");

allMods.each(function(i, el) {
    var el = jQuery(el);
    if (el.visible(true)) {
        el.addClass("already-visible");
    }
});

win.scroll(function(event) {

    allMods.each(function(i, el) {
        var el = jQuery(el);
        if (el.visible(true)) {
            el.addClass("come-in");
        }
    });

});




//tab effects

var TabbedContent = {
    init: function() {
        $(".tab_item").mouseover(function() {

            var background = $(this).parent().find(".moving_bg");

            $(background).stop().animate({
                left: $(this).position()['left']
            }, {
                duration: 300
            });

            TabbedContent.slideContent($(this));

        });
    },

    slideContent: function(obj) {
        var margin = $(obj).parent().parent().find(".slide_content").width();
        margin = margin * ($(obj).prevAll().size() - 1);
        margin = margin * -1;

        $(obj).parent().parent().find(".tabslider").stop().animate({
            marginLeft: margin + "px"
        }, {
            duration: 300
        });
    }
}

$(document).ready(function() {
    "use strict";
    TabbedContent.init();
});

/**
 * Javascript-Equal-Height-Responsive-Rows
 * https://github.com/Sam152/Javascript-Equal-Height-Responsive-Rows
 */
(function(jQuery) {
    jQuery.fn.equalHeight = function() {
        var heights = [];
        jQuery.each(this, function(i, element) {
            jQueryelement = jQuery(element);
            var element_height;
            var includePadding = (jQueryelement.css('box-sizing') == 'border-box') || (jQueryelement.css('-moz-box-sizing') == 'border-box');
            if (includePadding) {
                element_height = jQueryelement.innerHeight();
            } else {
                element_height = jQueryelement.height();
            }
            heights.push(element_height);
        });
        this.height(Math.max.apply(window, heights));
        return this;
    };
    jQuery.fn.equalHeightGrid = function(columns) {
        var jQuerytiles = this;
        jQuerytiles.css('height', 'auto');
        for (var i = 0; i < jQuerytiles.length; i++) {
            if (i % columns === 0) {
                var row = jQuery(jQuerytiles[i]);
                for (var n = 1; n < columns; n++) {
                    row = row.add(jQuerytiles[i + n]);
                }
                row.equalHeight();
            }
        }
        return this;
    };
    jQuery.fn.detectGridColumns = function() {
        var offset = 0,
            cols = 0;
        this.each(function(i, elem) {
            var elem_offset = jQuery(elem).offset().top;
            if (offset === 0 || elem_offset == offset) {
                cols++;
                offset = elem_offset;
            } else {
                return false;
            }
        });
        return cols;
    };
    jQuery.fn.responsiveEqualHeightGrid = function() {
        var _this = this;

        function syncHeights() {
            var cols = _this.detectGridColumns();
            _this.equalHeightGrid(cols);
        }
        jQuery(window).bind('resize load', syncHeights);
        syncHeights();
        return this;
    };
})(jQuery);

jQuery(function(jQuery) {
    "use strict";
    jQuery('.equalcol').responsiveEqualHeightGrid();
});