<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <meta name="viewport" content="width=device-width" />

    <title><?php echo NullTitleTag(); ?></title>

    <link rel="profile" href="http://gmpg.org/xfn/11" />
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

    <link rel="icon" type="image/png" href="<?php bloginfo('template_url'); ?>/favicon.png">

    <?php wp_head(); ?>
</head>

<?php
echo NullBodyOpen();

do_action( 'before' );

echo NullTag('header',
  NullContainer(
    NullRow(
      NullColumn('four', NullSiteTitle().NullSiteDescription())
      . NullColumn('four', NullMenu('primary'))
      . NullColumn('four', NullSearchForm())
    )
  )
);

echo '<main><div class="container">';
?>
