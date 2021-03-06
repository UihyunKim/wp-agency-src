<?php
  // comment callback function
  function format_comment($comment, $args, $depth) {
    if ('div' === $args['style']) {
      $tag = 'div';
      $add_below = 'comment';
    } else {
      $tag = 'li';
      $add_below = 'div-comment';
    }
?>

  <<?php echo $tag; ?> <?php comment_class(empty($args['has_children']) ? '' : 'parent'); ?> id="comment-<?php comment_ID() ?>">
    <?php if ('div' != $args['style']) : ?>
      <div id="div-comment-<?php comment_ID() ?>" class="comment-body border-top py-4 d-flex flex-column flex-md-row">

        <div class="avatar">
          <?php 
            if ($args['avatar_size'] != 0) {
              // echo get_avatar($comment, $args['avatar_size']);
              $class = "border rounded-circle mr-4";
              $avatar = get_avatar($comment, $args['avatar_size']);
              $avatar = explode("class='", $avatar);
              $avatar[1] = "class='" . $class . ' ' . $avatar[1];
              $avatar = $avatar[0] . $avatar[1];
              echo $avatar;
            }
          ?>
        </div>

        <div class="comment-main d-md-flex flex-md-row flex-wrap w-100">
          <div class="order-md-0 comment-user my-3 mt-md-0 mr-md-auto">
            <?php printf(__('<h3 class="font-weight-bold">%s</h3>'), get_comment_author()); ?>

            <h4>
              <?php
                /* translators: 1: date, 2: time */
                printf(
                  __('%1$s, %2$s'),
                  get_comment_date(),
                  get_comment_time()
                ); ?>
            </h4>
          </div>
          <div class="order-md-2 comment-text w-100">
            <?php if ($comment->comment_approved == '0') : ?>
              <em class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.'); ?></em><br/>
            <?php endif ?>
            <?php comment_text(); ?>
          </div>

          <div class="order-md-1 comment-reply d-flex flex-row my-3 mt-md-0">
            <div class="comment-meta commentmetadata mr-2 text-uppercase">
              <?php edit_comment_link(__('Edit'), '  ', ''); ?>
            </div>
            <div>
              <?php comment_reply_link(
                array_merge(
                  $args,
                  array(
                    'add_below' => $add_below,
                    'depth'   => $depth,
                    'max_depth' => $args['max_depth']
                  )
                )
                ); ?>
            </div>
          </div>
            
        </div>
      </div>
    <?php endif; ?>
  <!-- </<?php echo $tag; ?>> -->
<?php 
} ?>