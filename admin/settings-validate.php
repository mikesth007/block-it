<?php // MyPlugin - Validate Settings



// disable direct file access
if ( ! defined( 'ABSPATH' ) ) {
	
	exit;
	
}

// callback: validate options
function block_spam_word_callback_validate_options( $input ) {
	
	// custom char to replace
	if ( isset( $input['spam_replacement_char'] ) ) {
		
		$input['spam_replacement_char'] = sanitize_text_field( $input['spam_replacement_char'] );
		
	}
	
	// block spam words from comment, post or both
	$radio_options = block_spam_word_options_radio();
	
	if ( ! isset( $input['block_spam_words_from'] ) ) {
		
		$input['block_spam_words_from'] = null;
		
	}
	if ( ! array_key_exists( $input['block_spam_words_from'], $radio_options ) ) {
		
		$input['block_spam_words_from'] = null;
		
	}

	
	// keep first letter
	if ( ! isset( $input['spam_keep_first_letter'] ) ) {
		
		$input['spam_keep_first_letter'] = null;
		
	}
	
	$input['spam_keep_first_letter'] = ($input['spam_keep_first_letter'] == 1 ? 1 : 0);
	
	return $input;
	
}


