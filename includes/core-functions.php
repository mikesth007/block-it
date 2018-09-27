<?php // Core Functionality



// disable direct file access
if ( ! defined( 'ABSPATH' ) ) {
	
	exit;
	
}

function load_custom_wp_admin_style() {
    wp_enqueue_style( 'myplugin', plugin_dir_url( dirname( __FILE__ ) ) . 'public/css/block-spam-word-admin.css', array(), null, 'screen' );

}
add_action( 'admin_enqueue_scripts', 'load_custom_wp_admin_style' );

function wordFilter($text, $keepFirstLetter, $replaceWith)
{
    $default_filter = get_all_default_spam_words();
    $filter_terms = array_merge($default_filter, get_filter_words_from_db());
    $filtered_text = $text;


    foreach($filter_terms as $word)
    {
        $match_count = preg_match_all('/' . $word . '/i', $text, $matches);
        for($i = 0; $i < $match_count; $i++)
        {
            $bwstr = trim($matches[0][$i]);
            if ($keepFirstLetter)
                $replaceText = substr($bwstr,0,1).str_repeat($replaceWith, strlen($bwstr)-1);
            else
                $replaceText = str_repeat($replaceWith, strlen($bwstr));
            $filtered_text = preg_replace('/\b' . $bwstr . '\b/', $replaceText, $filtered_text);
        }
    }
    return $filtered_text;
}

function block_spam_word_filter_comment($content) {
    $options = get_option( 'block_spam_word_options', block_spam_word_options_default() );
    if (sanitize_option($options, $options['block_spam_words_from']) == 'post_only')
        return $content;
    else
        return wordFilter($content, sanitize_option($options, $options['spam_keep_first_letter']), sanitize_option($options, $options['spam_replacement_char']));
}

function block_spam_word_filter_post($content) {
    $options = get_option( 'block_spam_word_options', block_spam_word_options_default() );
    if (sanitize_option($options, $options['block_spam_words_from']) == 'comment_only')
        return $content;
    else
        return wordFilter($content, sanitize_option($options, $options['spam_keep_first_letter']), sanitize_option($options, $options['spam_replacement_char']));
}

add_filter( 'the_content', 'block_spam_word_filter_post' );
add_filter( 'comment_text', 'block_spam_word_filter_comment' );