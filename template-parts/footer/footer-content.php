<?php
/**
 * Template for Footer Navigation
 */

$copyright = get_theme_mod( 'custom_footer_copy' );
$footer_title = get_theme_mod( 'custom_footer_title' );
$footer_description = get_theme_mod( 'custom_footer_description' );
$checkbox = get_theme_mod( 'footer_col_checkbox' );
?>

<div id="custom-footer" class="site-info">
    <div id="custom-footer__content" class=<?php if ( $checkbox ==  1 ) : echo esc_attr( 'two-columns' ); endif; ?> >
        <div>
            <h4 id="custom-footer__title" class="footer-text-color"><?php echo esc_html( $footer_title ); ?></h4>
            <p id="custom-footer__description" class="footer-text-color"><?php echo esc_html( $footer_description ); ?></p>
        </div>
		<?php  if ( $checkbox ==  1 ) :
        	get_template_part( 'template-parts/footer/footer', 'content-two-columns' ); 
		endif; ?>
	</div>
<hr class="custom-footer__hr"/>
<p id="custom-footer__copyright-text" class="footer-text-color"><?php echo esc_html( $copyright ); ?></p>
</div>
