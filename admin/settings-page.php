<?php // MyPlugin - Settings Page



// exit if file is called directly
if ( ! defined( 'ABSPATH' ) ) {

	exit;

}




// display the plugin settings page
function block_spam_word_display_settings_page() {
	
	// check if user is allowed access
	if ( ! current_user_can( 'manage_options' ) ) return;
	
	?>
	
	<div class="wrap">
		<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
		<form action="options.php" method="post">
			
			<?php
			
			// output security fields
			settings_fields( 'block_spam_word_options' );
			
			// output setting sections
			do_settings_sections( 'block_spam_word' );
			
			// submit button
			submit_button();
			
			?>
			
		</form>

        <?php
        if (!empty($_POST)) {
            global $wpdb;
            $table = $wpdb->prefix.'spam_words';
            $word = sanitize_text_field($_POST['spamword']);
            $data = array(
                'word' => $word
            );
            $format = array(
                '%s'
            );
            $success=$wpdb->insert( $table, $data, $format );
            if($success){
                echo '<p class="success-message">data has been saved.</p>' ;
            } else {
                echo '<p class="error-message">Some problem occurred.</p>';
            }
        }
            ?>
            <form method="post" id="block-spam-word-form">

                <table>
                    <tr>
                        <td>Enter word to block</td>
                        <td><input type="text" name="spamword" required/></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><input type="submit" value="Add"/></td>
                    </tr>
                </table>

            </form>
            <br />
            <?php

            global $wpdb;
            $table_name = $wpdb->prefix . 'spam_words';
            $results = $wpdb->get_results("SELECT id,word,time FROM $table_name");
            if (!empty($results)) {
                echo "<table width='80%' border='0' class='block-spam-word-table'>";
                echo "<tr><th>S.N.</th><th>Word</th><th>Created On</th><th>Action</th></tr>";
                echo "<tbody>";
                $number = 1;
                foreach ($results as $row) {
                    echo "<tr>";
                    echo "<td>" . $number . "</td>";
                    echo "<td>" . $row->word . "</td>";
                    echo "<td>" . $row->time . "</td>";
                    echo "<td><button id='$row->id' onclick='delete_row($row->id)'>Delete</button></td>";
                    echo "</tr>";
                    $number ++;
                }
                echo "</tbody>";
                echo "</table>";

            } else {
                echo "No data saved.";
            }

        ?>
	</div>
	
	<?php
	
}


