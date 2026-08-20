<div class="footer-columns">
        <div class="jlc-container">
            <div class="jlc-row">
                <?php
                $footer_columns = get_theme_mod('footer_columns', 'footer4col');
                switch ( $footer_columns ) {         
                    case 'footer1col' :
                    ?>
                        <div class="jlc-col-md-12">
                        <?php if (is_active_sidebar('footer1-sidebar')) : dynamic_sidebar('footer1-sidebar'); endif; ?>
                        </div>
                    <?php                
                    break;
                    case 'footer2col' :
                    ?>
                        <div class="jlc-col-md-6">
                        <?php if (is_active_sidebar('footer1-sidebar')) : dynamic_sidebar('footer1-sidebar'); endif; ?>
                        </div>
                        <div class="jlc-col-md-6">
                        <?php if (is_active_sidebar('footer2-sidebar')) : dynamic_sidebar('footer2-sidebar'); endif; ?>
                        </div>
                    <?php                
                    break;
                    case 'footer3col' :
                    ?>
                        <div class="jlc-col-md-4">
                        <?php if (is_active_sidebar('footer1-sidebar')) : dynamic_sidebar('footer1-sidebar'); endif; ?>
                        </div>
                        <div class="jlc-col-md-4">
                        <?php if (is_active_sidebar('footer2-sidebar')) : dynamic_sidebar('footer2-sidebar'); endif; ?>
                        </div>
                        <div class="jlc-col-md-4">
                        <?php if (is_active_sidebar('footer3-sidebar')) : dynamic_sidebar('footer3-sidebar'); endif; ?>
                        </div>
                    <?php                
                    break;          
                    case 'footer4col' :
                    ?>
                        <div class="jlc-col-md-3">
                        <?php if (is_active_sidebar('footer1-sidebar')) : dynamic_sidebar('footer1-sidebar'); endif; ?>
                        </div>
                        <div class="jlc-col-md-3">
                        <?php if (is_active_sidebar('footer2-sidebar')) : dynamic_sidebar('footer2-sidebar'); endif; ?>
                        </div>
                        <div class="jlc-col-md-3">
                        <?php if (is_active_sidebar('footer3-sidebar')) : dynamic_sidebar('footer3-sidebar'); endif; ?>
                        </div>
                        <div class="jlc-col-md-3">
                        <?php if (is_active_sidebar('footer4-sidebar')) : dynamic_sidebar('footer4-sidebar'); endif; ?>
                        </div>
                    <?php                
                    break;          
                }
                ?>
            </div>
        </div>
    </div>