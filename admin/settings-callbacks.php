<?php // MyPlugin - Settings Callbacks



// disable direct file access
if ( ! defined( 'ABSPATH' ) ) {

	exit;

}

// callback: admin section
function block_spam_word_callback_section_settings() {
	echo '<p>These settings enable you to customize blocking in your website.</p>';
}

// select field options
function block_spam_word_options_radio() {

    return array(

        'post_only'  => 'All Posts',
        'comment_only' => 'All Comments',
        'both'    => 'Both'

    );

}

// callback: text field
function block_spam_word_callback_field_text( $args ) {

    $options = get_option( 'block_spam_word_options', block_spam_word_options_default() );

    $id    = isset( $args['id'] )    ? $args['id']    : '';
    $label = isset( $args['label'] ) ? $args['label'] : '';

    $value = isset( $options[$id] ) ? sanitize_text_field( $options[$id] ) : '';

    echo '<input id="block_spam_word_options_'. $id .'" name="block_spam_word_options['. $id .']" type="text" maxlength="1" required value="'. $value .'"><br />';
    echo '<label for="block_spam_word_options_'. $id .'">'. $label .'</label>';

}



// callback: radio field
function block_spam_word_callback_field_radio( $args ) {

    $options = get_option( 'block_spam_word_options', block_spam_word_options_default() );

    $id    = isset( $args['id'] )    ? $args['id']    : '';

    $selected_option = isset( $options[$id] ) ? sanitize_text_field( $options[$id] ) : '';

    $radio_options = array(

        'post_only'  => 'Posts',
        'comment_only' => 'Comments',
        'both'    => 'Both'

    );

    foreach ( $radio_options as $value => $label ) {

        $checked = checked( $selected_option === $value, true, false );

        echo '<label><input name="block_spam_word_options['. $id .']" type="radio" value="'. $value .'"'. $checked .'> ';
        echo '<span>'. $label .'</span></label><br />';

    }

}

// callback: checkbox field
function block_spam_word_callback_field_checkbox( $args ) {

    $options = get_option( 'block_spam_word_options', block_spam_word_options_default() );

    $id    = isset( $args['id'] )    ? $args['id']    : '';
    $label = isset( $args['label'] ) ? $args['label'] : '';

    $checked = isset( $options[$id] ) ? checked( $options[$id], 1, false ) : '';

    echo '<input id="block_spam_word_options_'. $id .'" name="block_spam_word_options['. $id .']" type="checkbox" value="1"'. $checked .'> ';
    echo '<label for="block_spam_word_options_'. $id .'">'. $label .'</label>';

}