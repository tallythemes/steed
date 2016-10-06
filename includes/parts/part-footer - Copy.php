<footer id="colophon" class="site-footer" role="contentinfo">
	
	<div class="site-footer-in">
    	<div class="footer-widgets">
            <div class="footer-widgets-in container-width container-fluid">
            	<div class="row">
                	<div class="col-md-4"><?php dynamic_sidebar( 'footer_1' ); ?></div>
                    <div class="col-md-4"><?php dynamic_sidebar( 'footer_2' ); ?></div>
                    <div class="col-md-4"><?php dynamic_sidebar( 'footer_3' ); ?></div>
                </div>
            </div>
        </div>
    	<div class="footer-bar">
            <div class="site-info container-width">
            	
                <a href="<?php echo esc_url( __( 'https://wordpress.org/', 'steed' ) ); ?>"><?php printf( esc_html__( 'Proudly powered by %s', 'steed' ), 'WordPress' ); ?></a>
                <span class="sep"> | </span>
                <?php printf( esc_html__( 'Theme: %1$s by %2$s.', 'steed' ), 'steed', '<a href="'.esc_url('http://tallyThemes.com').'" rel="designer">TallyThemes</a>' ); ?>
            </div><!-- .site-info -->
        </div>
	</div>
</footer><!-- #colophon -->