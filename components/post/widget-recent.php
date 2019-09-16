<?php
$arPosts = get_query_var('arPosts');
?>
<ul>
    <?php while ($arPosts->have_posts()) : $arPosts->the_post(); ?>
        <li><?php the_time('F d'); ?> - <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></li>
    <?php endwhile; ?>
</ul>