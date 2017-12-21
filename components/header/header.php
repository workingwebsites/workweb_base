<?php
	//Custom logo needs to be resized, so left out
	//echo has_custom_logo() ? 'has logo' : 'no logo';

	//workweb_base_the_custom_logo();
?>
    <div class="site-branding">
            <h1 class="site-title"> <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
            <h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
    </div>
		<!-- .site-branding -->
