<?php
/**
 * Theme setup. Kept deliberately small: design lives in theme.json, sections live in /patterns.
 *
 * @package KodinavSample
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Group this theme's patterns under one category in the inserter, so the client finds them in one place.
 */
function kodinav_sample_pattern_category() {
	register_block_pattern_category(
		'kodinav-sample',
		array( 'label' => __( 'Site sections', 'kodinav-sample' ) )
	);
}
add_action( 'init', 'kodinav_sample_pattern_category' );

/**
 * A visible focus ring on every interactive element (WCAG 2.4.7 / 2.4.11), in the theme's accent colour.
 */
function kodinav_sample_focus_styles() {
	wp_register_style( 'kodinav-sample', false, array(), wp_get_theme()->get( 'Version' ) );
	wp_enqueue_style( 'kodinav-sample' );
	wp_add_inline_style(
		'kodinav-sample',
		':where(a,button,input,select,textarea,summary,[tabindex]):focus-visible{outline:2px solid var(--wp--preset--color--accent);outline-offset:3px}'
	);
}
add_action( 'wp_enqueue_scripts', 'kodinav_sample_focus_styles' );
