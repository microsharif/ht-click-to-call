(function ($) {
    "use strict";
    

    $('.ht-cta-toggle a').on('click', function (e) {
        e.preventDefault();
        var $this = $(this),
            $target = $this.attr('href');
        if (!$this.hasClass('open')) {
            $this.addClass('open');
            $($target).addClass('active');
        } else {
            $this.removeClass('open');
            $($target).removeClass('active');
        }
    })


    

})(jQuery);
