<?php
$navbar_title = get_theme_mod( 'custom_footer_nav' );
$menu_locations = get_nav_menu_locations();
$get_selected_location = get_theme_mod( 'custom_footer_menu' );
$menu_ID = $menu_locations[ $get_selected_location ];
$items = wp_get_nav_menu_items( $menu_ID, $args = array());
?>

<div>
    <h4 id="custom-footer__navbar-title" class="footer-text-color"><?php echo esc_html( $navbar_title ); ?></h4>
    <ul id="custom-footer__menu">
        <?php foreach ( $items as $item ):
            echo wp_kses_post( '<li><a href='. $item->url .'>'. $item->title .'</a></li>' );
        endforeach; ?>
    </ul>
</div>