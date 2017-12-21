
	<?php
	/*
	* Set arguements for menus
	*/
		$arg = array( 'theme_location' => 'short-top-menu',
									'depth'=>1,
									'menu_class' => "navbar-nav",
									'container' => 'ul',
									'container_class' => "container_class"
								);
		?>

		<nav class="col-12 navbar navbar-toggleable-sm" role="navigation">
		  <div id="navbarNav">
		    <?php wp_nav_menu( $arg ); ?>
		  </div>
		</nav>


<!-- #site-navigation -->
