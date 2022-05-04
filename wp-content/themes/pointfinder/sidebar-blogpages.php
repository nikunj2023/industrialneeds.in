<?php 

$_page_sidebar = get_post_meta( get_the_id(), "webbupointfinder_page_sidebar", true );
	
if ( is_active_sidebar( $_page_sidebar ) ) : ?>
<div class="sidebar-widget">
	<?php dynamic_sidebar($_page_sidebar); ?>
</div>
<?php endif; ?>