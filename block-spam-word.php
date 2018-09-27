<?php

/**
 * Plugin Name:       Block Spam Word
 * Plugin URI:        https://profiles.wordpress.org/maikalshrestha
 * Description:       This plugin helps the admin to block spam/ inappropriate words in the website either in comments, posts or both
 * Version:           1.0
 * Text Domain        block-spam-word
 * Author:            Maikal Shrestha
 * Author URI:        https://profiles.wordpress.org/maikalshrestha
 * License:           GPL-2.0+
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}


// default plugin options
function block_spam_word_options_default()
{
    return array(
        'spam_replacement_char' => '*',
        'spam_keep_first_letter' => true,
        'block_spam_words_from' => 'both'
    );
}

if ( is_admin() ) {

    // include dependencies
    require_once plugin_dir_path( __FILE__ ) . 'admin/admin-menu.php';
    require_once plugin_dir_path( __FILE__ ) . 'admin/settings-page.php';
    require_once plugin_dir_path( __FILE__ ) . 'admin/settings-register.php';
    require_once plugin_dir_path( __FILE__ ) . 'admin/settings-callbacks.php';
    require_once plugin_dir_path( __FILE__ ) . 'admin/settings-validate.php';
    require_once plugin_dir_path( __FILE__ ) . 'admin/create-spam-table.php';
    require_once plugin_dir_path( __FILE__ ) . 'admin/spam-word-delete.php';

    add_action('wp_ajax_spam_delete_action', 'delete_spam_data');
    add_action('wp_ajax_nonpriv_spam_delete_action', 'delete_spam_data');
}

//include dependencies
require_once plugin_dir_path( __FILE__ ) . 'includes/core-functions.php';
require_once plugin_dir_path( __FILE__ ) . 'includes/spam-words-util.php';

register_activation_hook( __FILE__, 'block_spam_word_install' );
