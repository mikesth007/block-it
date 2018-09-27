<?php
/**
 * When plugin is deleted.
 */

// exit if uninstall constant is not defined
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {

    exit;

}


global $wpdb;
$table_name = $wpdb->prefix . 'spam_words';
$wpdb->query( "DROP TABLE IF EXISTS ".$table_name );

// delete the plugin options
delete_option( 'block_spam_word_options' );
delete_option( 'spam_db_version' );