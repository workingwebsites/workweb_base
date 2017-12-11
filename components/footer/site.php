        <aside id="sidebar-footer-logo" class="col-md-3" role="complementary">
        	<?php wws_get_custom_logo() //the_custom_logo();?>
        </aside>
        
        <aside id="sidebar-footer-1" class="col-md-3 widget-area" role="complementary">
			<?php if ( is_active_sidebar( 'sidebar-footer-1' ) ) { ?>
					<?php dynamic_sidebar( 'sidebar-footer-1' ); ?>
            <?php }	?>
        </aside>
        
        <aside id="sidebar-footer-2" class="widget-area col-md-3" role="complementary">
        	<?php if ( is_active_sidebar( 'sidebar-footer-2' ) ) { ?>
                    <?php dynamic_sidebar( 'sidebar-footer-2' ); ?>
            <?php }	?>
        </aside>
        
        <aside id="sidebar-footer-3" class="widget-area col-md-3" role="complementary">
        	<?php if ( is_active_sidebar( 'sidebar-footer-3' ) ) { ?>
                    <?php dynamic_sidebar( 'sidebar-footer-3' ); ?>
            <?php }	?>
        </aside>        


