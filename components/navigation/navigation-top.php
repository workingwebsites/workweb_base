<?php
/*
	* Set arguments for menus
	*/
$arg_short = array(
	'theme_location' => 'short-top-menu',
	'depth' => 1,
	'menu_class' => "navbar-nav",
	'container' => 'ul',
	'container_class' => "container_class"
);

/*
$arg_long = array(
	'theme_location' => 'full-top-menu',
	'depth' => 3,
	'menu_class' => "navbar-nav",
	'container' => 'ul',
	'container_class' => "container_class"
);
*/

$arg_long = array(
	'theme_location' => 'full-top-menu',
	'depth' => 3,
	'menu_class' => "navbar-nav",
	'container' => 'div',
	'container_class' => "container_class"
);
?>

<nav id="nav_short-top-menu" class="navbar navbar navbar-expand-lg" role="navigation">
	<div id="navbarNav" class="col-xs-11">
		<?php //wp_nav_menu($arg_short); 
		?>
		<?php wp_nav_menu($arg_long); ?>
	</div>
</nav>



<div class="col-12 collapse navbar-collapse" id="navbarSupportedContent">
	<?php wp_nav_menu($arg_long); ?>
</div>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Link</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Dropdown
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="#">Action</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
        </li>
      </ul>
      
    </div>
  </div>
</nav>



<!-- #site-navigation -->