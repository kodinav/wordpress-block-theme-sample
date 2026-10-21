<?php
/**
 * Title: Featured project
 * Slug: kodinav-sample/project
 * Categories: kodinav-sample
 * Description: Image and text side by side; stacks on phones with the image first. The image needs alt text when replaced.
 *
 * @package KodinavSample
 */

?>
<!-- wp:group {"align":"full","anchor":"projects","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|60"}}},"layout":{"type":"constrained"}} -->
<div id="projects" class="wp-block-group alignfull" style="padding-top:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--60)">
	<!-- wp:media-text {"align":"wide","mediaType":"image","mediaWidth":55,"verticalAlignment":"center","isStackedOnMobile":true} -->
	<div class="wp-block-media-text alignwide is-stacked-on-mobile is-vertically-aligned-center" style="grid-template-columns:55% auto">
		<figure class="wp-block-media-text__media"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/project.svg' ) ); ?>" alt="<?php esc_attr_e( 'Drawing of a low timber school building around a planted courtyard', 'kodinav-sample' ); ?>" width="1200" height="800"/></figure>
		<div class="wp-block-media-text__content">
			<!-- wp:paragraph {"textColor":"muted","fontSize":"small"} -->
			<p class="has-muted-color has-text-color has-small-font-size"><?php esc_html_e( 'Featured project', 'kodinav-sample' ); ?></p>
			<!-- /wp:paragraph -->
			<!-- wp:heading -->
			<h2 class="wp-block-heading"><?php esc_html_e( 'A primary school built around its courtyard', 'kodinav-sample' ); ?></h2>
			<!-- /wp:heading -->
			<!-- wp:paragraph {"textColor":"muted"} -->
			<p class="has-muted-color has-text-color"><?php esc_html_e( 'Every classroom opens onto the garden, so children cross daylight several times a day and teachers can see the whole yard from any door.', 'kodinav-sample' ); ?></p>
			<!-- /wp:paragraph -->
			<!-- wp:list {"textColor":"muted"} -->
			<ul class="wp-block-list has-muted-color has-text-color">
				<!-- wp:list-item --><li><?php esc_html_e( '14 classrooms, library and hall', 'kodinav-sample' ); ?></li><!-- /wp:list-item -->
				<!-- wp:list-item --><li><?php esc_html_e( 'Cross-laminated timber frame', 'kodinav-sample' ); ?></li><!-- /wp:list-item -->
				<!-- wp:list-item --><li><?php esc_html_e( 'Completed in two summer holidays', 'kodinav-sample' ); ?></li><!-- /wp:list-item -->
			</ul>
			<!-- /wp:list -->
		</div>
	</div>
	<!-- /wp:media-text -->
</div>
<!-- /wp:group -->
