<?php
/**
 * Created by PhpStorm.
 * User: MSH7
 */

global $spam_db_version;

function block_spam_word_install() {
    global $wpdb;
    global $spam_db_version;
    $spam_db_version = "1.0.1";

    $current_version = get_option('spam_db_version');

    $table_name = $wpdb->prefix . 'spam_words';

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

    if ($current_version != $spam_db_version) {
        $charset_collate = $wpdb->get_charset_collate();

        $sql = "CREATE TABLE " . $table_name . " (
		id mediumint(9) NOT NULL AUTO_INCREMENT,
		time datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
		word text NOT NULL UNIQUE,
		PRIMARY KEY  (id)
	) " . $charset_collate . ";";

        dbDelta($sql);

        update_option('spam_db_version', $spam_db_version);
    }
}
