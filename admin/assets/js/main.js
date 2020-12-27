(function ($) {
    "use strict";

    var htClickCallPersonInfo       = $('.ht-click-call-person-info');
    var htClickCallFlagInfo         = $('.ht-click-call-flag-info');
    var htClickCallTitleInfo        = $('.ht-click-call-title');
    var htClickCallMessageInfo      = $('.ht-click-call-message');
    var htClickCallNumberIconInfo   = $('.ht-click-call-number-icon');

    checkClickCallOption(ht_click_data.person_info_disable,htClickCallPersonInfo);
    checkClickCallOption(ht_click_data.flag_info_disable,htClickCallFlagInfo);
    checkClickCallOption(ht_click_data.call_title_enable,htClickCallTitleInfo);
    checkClickCallOption(ht_click_data.call_now_msg_enable,htClickCallMessageInfo);
    checkClickCallOption(ht_click_data.call_num_icon_enable,htClickCallNumberIconInfo);

    $('.person-info-enable .htoptions_element_checkbox input[type="checkbox"]').change(function() {
        var htPersonEnable = $(this).prop("checked");
        htOptionInfoCheck(htPersonEnable,htClickCallPersonInfo);
    });

    $('.flag-info-enable .htoptions_element_checkbox input[type="checkbox"]').change(function() {
        var htPersonEnable = $(this).prop("checked");
        htOptionInfoCheck(htPersonEnable,htClickCallFlagInfo);
    });

    $('.call-title-enable .htoptions_element_checkbox input[type="checkbox"]').change(function() {
        var htPersonEnable = $(this).prop("checked");
        htOptionInfoCheck(htPersonEnable,htClickCallTitleInfo);
    });

    $('.call-message-enable .htoptions_element_checkbox input[type="checkbox"]').change(function() {
        var htPersonEnable = $(this).prop("checked");
        htOptionInfoCheck(htPersonEnable,htClickCallMessageInfo);
    });

    $('.call-number-icon-enable .htoptions_element_checkbox input[type="checkbox"]').change(function() {
        var htPersonEnable = $(this).prop("checked");
        htOptionInfoCheck(htPersonEnable,htClickCallNumberIconInfo);
    });


    function checkClickCallOption(dataValue,selector){
        if('on' == dataValue){
        htOptionInfoCheck(true,selector);
        }else{
            htOptionInfoCheck(false,selector);
        }
    }

    function htOptionInfoCheck(htPersonEnable,elSelector){
        if(false == htPersonEnable){
            elSelector.hide();
        }else{
            elSelector.show();
        }
    }

})(jQuery);