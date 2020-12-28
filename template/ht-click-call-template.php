

    <div class="site-wrapper-reveal">

        <!-- Single Call To action Area Start -->
        <div class="ht-cta-box ht-cta-box--right">
            <div id="ht-cta" class="ht-cta-content-box">
                <div class="ht-cta-content">

                    <?php 
                       $click_call_numberget = $click_call_number ? $click_call_number : "(325)23352233699";
                       $click_call_textg = $click_call_text ? $click_call_text : "Call Us";
                    if($person_info_enabel == 'on'): ?>
                        <?php if($click_call_prsn_img): ?>
                            <div class="author-image">
                                <img src="<?php echo esc_url($click_call_prsn_img); ?>" alt="person image">
                            </div>
                        <?php endif; ?>

                        <?php if($click_call_person ): ?>
                            <h5 class="name"><?php echo esc_html__($click_call_person,'ht-click-call'); ?></h5>
                        <?php endif; ?>

                        <?php if($click_call_prsn_pos ): ?>
                            <p><?php echo esc_html__($click_call_prsn_pos,'ht-click-call') ?></p>
                        <?php endif; 
                        endif; ?>

                    <?php if($call_now_msg_enable == 'on'): 
                            if($click_call_msg): ?>
                            <p class="ht-cta-message"><?php echo esc_html__($click_call_msg,'ht-click-call');?></p>
                        <?php endif; 
                    endif; ?>

                    <?php if($call_title_enable == 'on'): ?>
                            <h5 class="title"><?php echo esc_html__($click_call_textg,'ht-click-call');?></p></h5>
                        <?php endif; ?>

                    <?php if(($flag_image_enable == 'on' || $call_num_icon_enabel == 'on') || $click_call_cty_code): ?>

                        <div class="select-country">

                            <?php if($flag_image_enable == 'on' && $click_call_flag_img): ?>
                                <span class="flag-image">
                                    <img src="<?php echo esc_url($click_call_flag_img);?>" alt="Country Flag Image">
                                </span>
                            <?php endif; ?>

                            <span class="cuntry-code"><?php 
                                if($call_num_icon_enabel == 'on'):
                                    if($call_num_icon_img): ?>
                                        <img src="<?php echo esc_url($call_num_icon_img);?>" alt="Add Call Number Icon">
                                    <?php endif; 
                                endif;
                                echo esc_html__($click_call_cty_code,'ht-click-call'); ?>
                            </span>

                            <a class="ht-details-call" href="<?php echo esc_url('tel:'.$click_call_numberget); ?>">
                                <?php echo esc_html__($click_call_numberget,'ht-click-call'); ?></a>

                        </div>
                    <?php else: ?>
                        <a class="ht-simple-call" href="<?php echo esc_url('tel:'.$click_call_numberget); ?>">
                            <?php echo esc_html__($click_call_numberget,'ht-click-call'); ?></a>
                    <?php endif; ?>
                </div>
            </div>
            <div class="ht-cta-button ht-cta-toggle ht-cta-button--07">
                <a href="#ht-cta">
                    <div class="button-box">
                        <div class="images-one">
                            <?php
                                $click_call_icon_btn = $click_call_icon ? $click_call_icon : CLICK_CALL_PL_URL. 'assets/images/icons/white-call-icon.png';
                            ?>
                            <img src="<?php echo esc_url($click_call_icon_btn); ?>" class="img-fluid " alt="Add Click Call Button Icon">
                        </div>
                        <div class="images-two">
                            <img src="<?php echo esc_url(CLICK_CALL_PL_URL. 'assets/images/icons/white-call-close.png'); ?>" class="img-fluid" alt="click call close">
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <!-- Single Call To action Area End -->
    </div>

