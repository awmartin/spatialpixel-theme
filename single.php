<?php
/**
 * The Template for displaying all single posts.
 *
 * @package SpatialPixel
 */

echo NullHeader();

the_post();

NullPostFormatTemplate();

echo NullPostSchema();
echo NullFooter();
?>
