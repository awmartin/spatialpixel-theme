<?php
/**
 * The Template for displaying asides.
 *
 * @package SpatialPixel
 */

echo NullArticle(
  NullArticleHeader(
    NullBreadcrumb(array('before' => NullPostTitle()))
    . NullPostThumbnail('large', false)
    )

  . NullContentSidebar(
      NullPostContent()
      . NullArticleFooter(NullPostedOn().NullComments())
      , NullWidgetArea('Post')
    )
  );

?>
