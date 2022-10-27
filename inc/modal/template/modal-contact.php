<?php
$postid = wws_get_contactpage();
$contact_post = get_post($postid);

if (empty($contact_post)) {
  $content_string = "";
} else {
  $content =  $contact_post->post_content;
  $content_string = apply_filters('the_content', $content);
}

?>
<!--  Contact Modal -->
<div class="modal fade" id="contactModal" tabindex="-1" aria-labelledby="contactModalLabel" aria-hidden="true">
  <div id="contactModalDialog" class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="contactModalLabel"><?php echo $contact_post->post_title ?></h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div id="contactModalBody" class="modal-body">
        <?php echo $content_string; ?>
      </div>
    </div>
  </div>
</div>