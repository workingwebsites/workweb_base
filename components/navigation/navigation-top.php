<?php

/** 
 * Set arguments for menus
 */

$arg_full = array(
	'theme_location' => 'full-top-menu',
	'depth' => 2,
	'menu_class' => "navbar-nav collapse navbar-collapse",
	'container' => 'div',
	'container_class' => "container_class"
);
?>

<nav id="nav_top-menu" class="navbar navbar navbar-expand-lg" role="navigation">
	<div id="navbarNav" class="col-xs-11">
		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menu-main-menu" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span> Menu
		</button>
		<?php wp_nav_menu($arg_full); ?>
	</div>
</nav>


<!-- #site-navigation -->