<?php // MyPlugin - Register Settings



// disable direct file access
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


// register plugin settings
function block_spam_word_register_settings() {

	register_setting(
		'block_spam_word_options',
		'block_spam_word_options',
		'block_spam_word_callback_validate_options'
	);

	add_settings_section(
		'block_spam_word_section_settings',
		'Customize Settings',
		'block_spam_word_callback_section_settings',
		'block_spam_word'
	);

	add_settings_field(
		'spam_replacement_char',
		'Replacement for Spam Word',
		'block_spam_word_callback_field_text',
		'block_spam_word',
		'block_spam_word_section_settings',
		[ 'id' => 'spam_replacement_char', 'label' => 'you can change it with your own characters' ]
	);

	add_settings_field(
		'spam_keep_first_letter',
		'Keep First Letter',
		'block_spam_word_callback_field_checkbox',
		'block_spam_word',
		'block_spam_word_section_settings',
		[ 'id' => 'spam_keep_first_letter', 'label' => 'show first letter of the word' ]
	);

	add_settings_field(
		'block_spam_words_from',
		'Block Spam Words From',
		'block_spam_word_callback_field_radio',
		'block_spam_word',
		'block_spam_word_section_settings',
		[ 'id' => 'block_spam_words_from', 'label' => 'Block Spam Words From' ]
	);



}
add_action( 'admin_init', 'block_spam_word_register_settings' );


