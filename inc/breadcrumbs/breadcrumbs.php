<?php
function custom_breadcrumbs($nav_class = 'col-12') {

    // Settings
    $breadcrums_id      = 'breadcrumbs';
    $breadcrums_class   = 'breadcrumbs';
    $home_title         = 'Home';
    //$nav_class          = 'col-12';

    // If you have any custom post types with custom taxonomies, put the taxonomy name below (e.g. product_cat)
    $custom_taxonomy    = 'product_cat';

    // Get the query & post information
    global $post,$wp_query;

    // Do not display on the homepage
    if ( !is_front_page() ) {

        // Build the breadcrumbs
        echo '<nav aria-label="breadcrumb" class="'.$nav_class.'">';
        echo '<ol id="' . $breadcrums_id . '" class="' . $breadcrums_class . ' breadcrumb">';

        // Home page
        echo '<li class="breadcrumb-item item-home"><a class="bread-link bread-home" href="' . get_home_url() . '" title="' . $home_title . '">' . $home_title . '</a></li>';

        if ( is_archive() && !is_tax() && !is_category() && !is_tag() ) {

            echo '<li class="breadcrumb-item item-current item-archive">' . post_type_archive_title(null, false) . '</li>';

        } else if ( is_archive() && is_tax() && !is_category() && !is_tag() ) {

            // If post is a custom post type
            $post_type = get_post_type();

            // If it is a custom post type display name and link
            if($post_type != 'post') {

                $post_type_object = get_post_type_object($post_type);
                $post_type_archive = get_post_type_archive_link($post_type);

                echo '<li class="breadcrumb-item item-cat item-custom-post-type-' . $post_type . '"><a class="bread-cat bread-custom-post-type-' . $post_type . '" href="' . $post_type_archive . '" title="' . $post_type_object->labels->name . '">' . $post_type_object->labels->name . '</a></li>';

            }

            $custom_tax_name = get_queried_object()->name;
            echo '<li class="breadcrumb-item item-current item-archive active" aria-current="page">' . $custom_tax_name . '</li>';

        } else if ( is_single() ) {

            // If post is a custom post type
            $post_type = get_post_type();

            // If it is a custom post type display name and link
            if($post_type != 'post') {

                $post_type_object = get_post_type_object($post_type);
                $post_type_archive = get_post_type_archive_link($post_type);

                echo '<li class="breadcrumb-item item-cat item-custom-post-type-' . $post_type . '"><a class="bread-cat bread-custom-post-type-' . $post_type . '" href="' . $post_type_archive . '" title="' . $post_type_object->labels->name . '">' . $post_type_object->labels->name . '</a></li>';

            }

            // Get post category info
            $category = get_the_category();

            if(!empty($category)) {

                // Get last category post is in
                $arVal = array_values($category);
                $last_category = end($arVal);

                // Get parent any categories and create array
                $get_cat_parents = rtrim(get_category_parents($last_category->term_id, true, ','),',');
                $cat_parents = explode(',',$get_cat_parents);

                // Loop through parent categories and store in variable $cat_display
                $cat_display = '';
                foreach($cat_parents as $parents) {
                    $cat_display .= '<li class="breadcrumb-item item-cat">'.$parents.'</li>';
                }

            }

            // If it's a custom post type within a custom taxonomy
            $taxonomy_exists = taxonomy_exists($custom_taxonomy);
            if(empty($last_category) && !empty($custom_taxonomy) && $taxonomy_exists) {

                $taxonomy_terms = get_the_terms( $post->ID, $custom_taxonomy );
                $cat_id         = $taxonomy_terms[0]->term_id;
                $cat_nicename   = $taxonomy_terms[0]->slug;
                $cat_link       = get_term_link($taxonomy_terms[0]->term_id, $custom_taxonomy);
                $cat_name       = $taxonomy_terms[0]->name;

            }

            // Check if the post is in a category
            if(!empty($last_category)) {
                echo $cat_display;
                echo '<li class="breadcrumb-item item-current item-' . $post->ID . ' active" aria-current="page">' . get_the_title() . '</li>';

            // Else if post is in a custom taxonomy
            } else if(!empty($cat_id)) {

                echo '<li class="breadcrumb-item item-cat item-cat-' . $cat_id . ' item-cat-' . $cat_nicename . '"><a class="bread-cat bread-cat-' . $cat_id . ' bread-cat-' . $cat_nicename . '" href="' . $cat_link . '" title="' . $cat_name . '">' . $cat_name . '</a></li>';
                echo '<li class="breadcrumb-item item-current item-' . $post->ID . ' active" aria-current="page">' . get_the_title() . '</li>';

            } else {

                echo '<li class="breadcrumb-item item-current item-' . $post->ID . ' active" aria-current="page">' . get_the_title() . '</li>';

            }

        } else if ( is_category() ) {

            // Category page
            echo '<li class="breadcrumb-item item-current item-cat active" aria-current="page">' . single_cat_title('', false) . '</li>';

        } else if ( is_page() ) {

            // Standard page
            if( $post->post_parent ){

                // If child page, get parents
                $anc = get_post_ancestors( $post->ID );

                // Get parents in the right order
                $anc = array_reverse($anc);

                // Parent page loop
                if ( !isset( $parents ) ) $parents = null;
                foreach ( $anc as $ancestor ) {
                    $parents .= '<li class="breadcrumb-item item-parent item-parent-' . $ancestor . '"><a class="bread-parent bread-parent-' . $ancestor . '" href="' . get_permalink($ancestor) . '" title="' . get_the_title($ancestor) . '">' . get_the_title($ancestor) . '</a></li>';
                }

                // Display parent pages
                echo $parents;

                // Current page
                echo '<li class="breadcrumb-item item-current item-' . $post->ID . ' active" aria-current="page">' . get_the_title() . '</li>';

            } else {

                // Just display current page if not parents
                echo '<li class="breadcrumb-item item-current item-' . $post->ID . ' active" aria-current="page">' . get_the_title() . '</li>';

            }

        } else if ( is_tag() ) {

            // Tag page

            // Get tag information
            $term_id        = get_query_var('tag_id');
            $taxonomy       = 'post_tag';
            $args           = 'include=' . $term_id;
            $terms          = get_terms( $taxonomy, $args );
            $get_term_id    = $terms[0]->term_id;
            $get_term_slug  = $terms[0]->slug;
            $get_term_name  = $terms[0]->name;

            // Display the tag name
            echo '<li class="breadcrumb-item item-current item-tag-' . $get_term_id . ' item-tag-' . $get_term_slug . ' active" aria-current="page">' . $get_term_name . '</li>';

        } elseif ( is_day() ) {

            // Day archive

            // Year link
            echo '<li class="breadcrumb-item item-year item-year-' . get_the_time('Y') . '"><a class="bread-year bread-year-' . get_the_time('Y') . '" href="' . get_year_link( get_the_time('Y') ) . '" title="' . get_the_time('Y') . '">' . get_the_time('Y') . ' Archives</a></li>';

            // Month link
            echo '<li class="breadcrumb-item item-month item-month-' . get_the_time('m') . '"><a class="bread-month bread-month-' . get_the_time('m') . '" href="' . get_month_link( get_the_time('Y'), get_the_time('m') ) . '" title="' . get_the_time('M') . '">' . get_the_time('M') . ' Archives</a></li>';

            // Day display
            echo '<li class="breadcrumb-item item-current item-' . get_the_time('j') . ' active" aria-current="page">' . get_the_time('jS') . ' ' . get_the_time('M') . ' Archives</li>';

        } else if ( is_month() ) {

            // Month Archive

            // Year link
            echo '<li class="breadcrumb-item item-year item-year-' . get_the_time('Y') . '"><a class="bread-year bread-year-' . get_the_time('Y') . '" href="' . get_year_link( get_the_time('Y') ) . '" title="' . get_the_time('Y') . '">' . get_the_time('Y') . ' Archives</a></li>';

            // Month display
            echo '<li class="breadcrumb-item item-month item-month-' . get_the_time('m') . '"><strong class="bread-month bread-month-' . get_the_time('m') . '" title="' . get_the_time('M') . '">' . get_the_time('M') . ' Archives</li>';

        } else if ( is_year() ) {

            // Display year archive
            echo '<li class="breadcrumb-item item-current item-current-' . get_the_time('Y') . ' active" aria-current="page">' . get_the_time('Y') . ' Archives</li>';

        } else if ( is_author() ) {

            // Auhor archive

            // Get the author information
            global $author;
            $userdata = get_userdata( $author );

            // Display author name
            echo '<li class="breadcrumb-item item-current item-current-' . $userdata->user_nicename . '">' . 'Author: ' . $userdata->display_name . '</li>';

        } else if ( get_query_var('paged') ) {

            // Paginated archives
            echo '<li class="breadcrumb-item item-current item-current-' . get_query_var('paged') . '">'.__('Page') . ' ' . get_query_var('paged') . '</li>';

        } else if ( is_search() ) {

            // Search results page
            echo '<li class="breadcrumb-item item-current item-current-' . get_search_query() . '">Search results for: ' . get_search_query() . '</li>';

        } elseif ( is_404() ) {

            // 404 page
            echo '<li>' . 'Error 404' . '</li>';
        }

        echo '</ol>';
        echo '</nav>';

    }

}
/*
*  Add style sheet and js
*/
function wws_breadcrumbs_scripts(){
  wp_enqueue_style( 'breadcrumbs-css', get_template_directory_uri() . '/inc/breadcrumbs/css/breadcrumbs.css' );
  //wp_enqueue_script( 'breadcrumbs-script', get_template_directory_uri() . '/inc/breadcrumbs/js/breadcrumbs.js' );

}

add_action( 'wp_enqueue_scripts', 'wws_breadcrumbs_scripts', 1 );
