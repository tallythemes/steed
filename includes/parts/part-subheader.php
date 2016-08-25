<div class="site-subheader">
	<div class="site-subheader-in container-width">
    	<?php			
			if(is_search()){
				?>
                <h1 class="page-title"><?php printf( esc_html__( 'Search Results for: %s', 'steed' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
				<?php
			}elseif(is_single()){
				the_title( '<h1 class="entry-title">', '</h1>' );
				echo '<div class="entry-meta">';
					steed_posted_on();
				echo '</div>';
			}else{
				the_title( '<h1 class="entry-title">', '</h1>' );	
			}
		?>
    </div>
</div>