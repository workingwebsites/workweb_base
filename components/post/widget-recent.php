<?php
$arPosts = get_query_var('arPosts');
?>
<ul class="fp_whatsnew">
    <?php while ($arPosts->have_posts()) : $arPosts->the_post();
        $post = get_post();
        
        //Set excerpt
        if (has_excerpt()) {
            $postExceprt = wpautop($post->post_excerpt);
        } else {
            $strPostExceprt = implode(' ', array_slice(explode(' ', get_the_content()), 0, 55));
            $postExceprt = $strPostExceprt.' &hellip;';
        }
        ?>
        <li class="row wn_item">
            <div class="col-3 wn_thumbnail">
                <?php the_post_thumbnail() ?>
            </div>
            <div class="col-9">
                <div class="wn_time">
                    <?php the_time('F d, Y'); ?>
                </div>
                <h3 class="wn_title"><?php the_title(); ?></h3>
                <div class="wn_content">
                    <?php echo $postExceprt; ?>
                </div>
                <div class="wn_link">
                    <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">More</a>
                </div>
            </div>
        </li>
    <?php endwhile; ?>
</ul>