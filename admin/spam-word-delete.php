<?php
/**
 * Created by PhpStorm.
 * User: MSH7
 */

    if (isset($_POST['delete_row'])) {
        require_once( str_replace('//','/',dirname(__FILE__).'/') .'../../../../wp-config.php');

        $spam_id = $_POST['spam_id'];
        global $wpdb;
        $table_name = $wpdb->prefix . 'spam_words';
        $result = $wpdb->delete($table_name, array('id' => $spam_id));
        if ($result == false)
            echo 'failure';
        else
            echo 'success';
        exit();
    }
