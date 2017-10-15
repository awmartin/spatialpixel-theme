<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package SpatialPixel
 */

echo NullHeader();

$imageUrl = get_bloginfo('template_url')."/img/";

echo NullTag('h1', 'Oops! I can&rsquo;t find that page!')
  . NullHeroText('<p>It looks like nothing was found at this URL. Maybe try a search? ^</p>');

echo NullFooter();
?>
