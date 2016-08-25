<header id="masthead" class="site-header" role="banner">
    <div class="site-header-in">
    	
        <div class="braning-and-widgets container-width">
            <div class="site-branding">
                <?php steed_custom_logo(); ?>
            </div><!-- .site-branding -->
            
            <div class="header-widgets">
                <?php dynamic_sidebar( 'header' ); ?>
            </div>
        </div>
		
        <div class="mavigation-holder">
        	<div class="mavigation-holder-in container-width">
                <nav id="site-navigation" class="main-navigation container-width" role="navigation">
                    <?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
                </nav><!-- #site-navigation -->
                <div class="social-widgets">
					<?php dynamic_sidebar( 'social_icons' ); ?>
                </div>
                <a href="#" class="responsive-menu-hand"><i class="fa fa-align-justify"></i></a>
            </div>
        </div>
        
        
	</div>
</header><!-- #masthead -->
<div class="responsive-menu">
	<a href="#" class="responsive-menu-close"><i class="fa fa-close"></i></a>
</div>
