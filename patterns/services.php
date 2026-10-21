<?php
/**
 * Title: Services, three columns
 * Slug: kodinav-sample/services
 * Categories: kodinav-sample
 * Description: Section heading and three service cards. Columns stack on phones.
 *
 * @package KodinavSample
 */

$kodinav_sample_services = array(
	array( __( 'Homes', 'kodinav-sample' ), __( 'New houses and careful extensions, planned around light, storage and how a family actually moves through a day.', 'kodinav-sample' ) ),
	array( __( 'Schools', 'kodinav-sample' ), __( 'Classrooms and shared spaces that stay quiet, bright and easy to supervise, built to tight public budgets.', 'kodinav-sample' ) ),
	array( __( 'Workplaces', 'kodinav-sample' ), __( 'Offices and studios that give people a reason to come in: good air, good acoustics and places to think.', 'kodinav-sample' ) ),
);
?>
<!-- wp:group {"align":"full","backgroundColor":"surface","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|60"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull has-surface-background-color has-background" style="padding-top:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--60)">
	<!-- wp:heading {"align":"wide"} -->
	<h2 class="wp-block-heading alignwide"><?php esc_html_e( 'What we design', 'kodinav-sample' ); ?></h2>
	<!-- /wp:heading -->

	<!-- wp:columns {"align":"wide","style":{"spacing":{"blockGap":{"left":"var:preset|spacing|40","top":"var:preset|spacing|40"},"margin":{"top":"var:preset|spacing|40"}}}} -->
	<div class="wp-block-columns alignwide" style="margin-top:var(--wp--preset--spacing--40)">
		<?php foreach ( $kodinav_sample_services as $kodinav_sample_service ) : ?>
		<!-- wp:column {"style":{"border":{"top":{"color":"var:preset|color|contrast","width":"2px"}},"spacing":{"padding":{"top":"var:preset|spacing|30"}}}} -->
		<div class="wp-block-column" style="border-top-color:var(--wp--preset--color--contrast);border-top-width:2px;padding-top:var(--wp--preset--spacing--30)">
			<!-- wp:heading {"level":3} -->
			<h3 class="wp-block-heading"><?php echo esc_html( $kodinav_sample_service[0] ); ?></h3>
			<!-- /wp:heading -->
			<!-- wp:paragraph {"textColor":"muted"} -->
			<p class="has-muted-color has-text-color"><?php echo esc_html( $kodinav_sample_service[1] ); ?></p>
			<!-- /wp:paragraph -->
		</div>
		<!-- /wp:column -->
		<?php endforeach; ?>
	</div>
	<!-- /wp:columns -->
</div>
<!-- /wp:group -->
