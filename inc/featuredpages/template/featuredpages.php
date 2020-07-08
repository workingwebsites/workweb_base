<?php
$arPostID = wws_get_featuredpages();
?>

<?php
foreach ($arPostID as $PostID) {
  $featured_page = get_post($PostID);

  $hasThumbnail = has_post_thumbnail($featured_page);
  if ($hasThumbnail == true) {
    $cssCol_Image = 'col-md-3';
    $cssCol_Content = 'col-md-9';
  } else {
    $cssCol_Image = null;
    $cssCol_Content = 'col';
  }

?>
  <article id="post-<?php echo $featured_page->ID ?>" class="col">
    <header class="entry-header">
      <h1><?php echo $featured_page->post_title ?></h1>
    </header>

    <div class="row">
      <?php if ($hasThumbnail == true) { ?>
        <div class="entry-thumbnail <?php echo $cssCol_Image ?>">
          <?php echo get_the_post_thumbnail($featured_page->ID)  ?>
        </div>
      <?php } ?>
      <div class="entry-content <?php echo $cssCol_Content ?>">
        <?php echo apply_filters('the_content', $featured_page->post_content) ?>
      </div>
    </div>

    <footer class="entry-footer">
      <span class="edit-link"><a class="post-edit-link" href="<?php echo get_edit_post_link($featured_page->ID); ?>">Edit</a></span>
    </footer>

  </article>
<?php } // end foreach 
?>