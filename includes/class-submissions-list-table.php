<?php
/**
 * WP_List_Table for displaying email submissions.
 *
 * @package EmailList
 */

if (! defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

if (! class_exists('WP_List_Table')) {
	require_once ABSPATH . 'wp-admin/includes/class-wp-list-table.php';
}

/**
 * Class Email_List_Submissions_List_Table
 *
 * @since 0.0.1
 */
class Email_List_Submissions_List_Table extends WP_List_Table
{

	/**
	 * Constructor.
	 */
	public function __construct()
	{
		parent::__construct(
			[
				'singular' => __('Submission', 'email-list-plugin'),
				'plural'   => __('Submissions', 'email-list-plugin'),
				'ajax'     => false,
			]
		);
	}

	/**
	 * Get columns.
	 *
	 * @return array
	 */
	public function get_columns()
	{
		return [
			'cb'         => '<input type="checkbox" />',
			'first_name' => __('First Name', 'email-list-plugin'),
			'last_name'  => __('Last Name', 'email-list-plugin'),
			'email'      => __('Email', 'email-list-plugin'),
			'created_at' => __('Date', 'email-list-plugin'),
		];
	}

	/**
	 * Render the checkbox column.
	 *
	 * @param array $item The item being rendered.
	 * @return string
	 */
	protected function column_cb($item)
	{
		return sprintf(
			'<input type="checkbox" name="submission[]" value="%s" />',
			$item['id']
		);
	}

	/**
	 * Render the 'first_name' column with action links.
	 *
	 * @param array $item The item being rendered.
	 * @return string
	 */
	protected function column_first_name($item)
	{
		$delete_nonce = wp_create_nonce('el_delete_submission');
		$page = sanitize_text_field(wp_unslash($_REQUEST['page']));

		$actions = [
			'delete' => sprintf(
				'<a href="?page=%s&action=%s&submission=%s&_wpnonce=%s" onclick="return confirm(\'%s\')">%s</a>',
				esc_attr($page),
				'delete',
				absint($item['id']),
				$delete_nonce,
				esc_js(__('Are you sure you want to delete this submission?', 'email-list-plugin')),
				__('Delete', 'email-list-plugin')
			),
		];

		return '<strong>' . esc_html($item['first_name']) . '</strong>' . $this->row_actions($actions);
	}

	/**
	 * Default column.
	 *
	 * @param object $item
	 * @param string $column_name
	 * @return mixed
	 */
	public function column_default($item, $column_name)
	{
		switch ($column_name) {
			case 'last_name':
			case 'email':
			case 'created_at':
				return esc_html($item[ $column_name ]);
			default:
				return print_r($item, true); // Show the whole array for troubleshooting.
		}
	}

	/**
	 * Prepare items.
	 */
	public function prepare_items()
	{
		global $wpdb;
		$table_name = $wpdb->prefix . 'email_list_submissions';

		$columns  = $this->get_columns();
		$hidden   = array();
		$sortable = [];
		$this->_column_headers = [$columns, $hidden, $sortable];

		$this->items = $wpdb->get_results("SELECT * FROM $table_name ORDER BY created_at DESC", ARRAY_A);
	}
}
