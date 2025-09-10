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
	$submissions = $wpdb->get_results("SELECT * FROM $table_name ORDER BY created_at DESC");
?>
	<div class="wrap">
		<h1><?php esc_html_e('Email List Submissions', 'email-list-plugin'); ?></h1>
		<table class="wp-list-table widefat fixed striped">
			<thead>
				<tr>
					<th scope="col"><?php esc_html_e('First Name', 'email-list-plugin'); ?></th>
					<th scope="col"><?php esc_html_e('Last Name', 'email-list-plugin'); ?></th>
					<th scope="col"><?php esc_html_e('Email', 'email-list-plugin'); ?></th>
					<th scope="col"><?php esc_html_e('Date', 'email-list-plugin'); ?></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($submissions as $submission) : ?>
					<tr>
						<td><?php echo esc_html($submission->first_name); ?></td>
						<td><?php echo esc_html($submission->last_name); ?></td>
						<td><?php echo esc_html($submission->email); ?></td>
						<td><?php echo esc_html($submission->created_at); ?></td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
<?php
}