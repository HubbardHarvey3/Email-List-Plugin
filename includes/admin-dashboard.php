<?php

/**
 * Admin dashboard functionality for the Email List plugin.
 *
 * @package EmailList
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

/**
 * Adds the admin menu page for the email list.
 */
function email_list_add_admin_menu()
{
	add_menu_page(
		__('Email List Submissions', 'email-list-plugin'),
		__('Email List', 'email-list-plugin'),
		'manage_options',
		'email-list-submissions',
		'email_list_admin_page_content',
		'dashicons-email-alt',
		20
	);
}
add_action('admin_menu', 'email_list_add_admin_menu');

/**
 * Renders the content for the admin page.
 */
function email_list_admin_page_content()
{
	global $wpdb;
	$table_name = $wpdb->prefix . 'email_list_submissions';

	// Handle delete action.
	if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['submission'])) {
		// Verify nonce.
		if (isset($_GET['_wpnonce']) && wp_verify_nonce(sanitize_text_field(wp_unslash($_GET['_wpnonce'])), 'el_delete_submission')) {
			$id = absint($_GET['submission']);
			$wpdb->delete($table_name, ['id' => $id], ['%d']);

			// Add a success notice.
			add_action(
				'admin_notices',
				function () {
					?>
					<div class="notice notice-success is-dismissible">
						<p><?php esc_html_e('Submission deleted successfully!', 'email-list-plugin'); ?></p>
					</div>
					<?php
				}
			);
		} else {
			// Nonce verification failed.
			wp_die(esc_html__('Security check failed.', 'email-list-plugin'));
		}
	}

	// Create an instance of our list table class.
	$list_table = new Email_List_Submissions_List_Table();
	// Fetch, prepare, and sort the data.
	$list_table->prepare_items();
	?>
	<div class="wrap">
		<h1><?php esc_html_e('Email List Submissions', 'email-list-plugin'); ?></h1>
		<?php
		// Display admin notices (like our success message).
		do_action('admin_notices');
		?>
		<?php
		// Render the list table.
		$list_table->display();
		?>
	</div>
<?php
}