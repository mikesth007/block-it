<?php

// exit if file is called directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// add sub-level administrative menu
function block_spam_word_add_sublevel_menu() {

	add_submenu_page(
		'options-general.php',
		'Block Spam Word Settings',
		'Block Spam Word',
		'manage_options',
		'block_spam_word',
		'block_spam_word_display_settings_page'
	);
	
}
add_action( 'admin_menu', 'block_spam_word_add_sublevel_menu' );