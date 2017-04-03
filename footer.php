<?php
/**
 * The template for displaying the footer.
 *
 * @package SpatialPixel
 */

echo '</div></main>';

echo NullTag('footer',
  NullContainer(NullRow(NullColumn('twelve', NullWidgetArea('Footer'))))
);

global $google_analytics_id;
echo NullGoogleAnalytics($google_analytics_id);

wp_footer();

echo NullBodyClose();
?>

</html>
