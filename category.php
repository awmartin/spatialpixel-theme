<?php
/**
 * The template for displaying Category pages.
 * @package SpatialPixel
 */

echo NullHeader();

echo NullSection(
    NullBreadcrumb(array('before' => NullArchiveTitle()))
    . NullHeroText(NullArchiveDescription())
  );

echo NullLoop(array(
    'num_columns' => 1,
    'standard'    => 'title6|excerpt4|postedon2',
    'aside'       => 'title6|excerpt4|postedon2',
    'mode'        => 'manual',
    'class'       => 'fullwidth',
  ));

echo NullFooter();
?>
