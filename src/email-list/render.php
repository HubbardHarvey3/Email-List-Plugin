<?php

/**
 * @see https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/block-api/block-metadata.md#render
 */
?>
<form action="" <?php echo get_block_wrapper_attributes(['style' => $style]); ?> method="post">
	<?php wp_nonce_field('email_list_form_action', 'email_list_form_nonce'); ?>

	<p>
		<label for="first_name">
			<?php esc_html_e('First Name', 'email-list-plugin'); ?>
			<span class="required">*</span>
			<br>
		</label>
		<input id="first_name" name="first_name" type="text" placeholder="<?php esc_attr_e('First Name', 'email-list-plugin'); ?>" required />
	</p>

	<p>
		<label for="last_name">
			<?php esc_html_e('Last Name', 'email-list-plugin'); ?>
			<span class="required">*</span>
			<br>
		</label>
		<input id="last_name" name="last_name" type="text" placeholder="<?php esc_attr_e('Last Name', 'email-list-plugin'); ?>" required />
	</p>

	<p>
		<label for="email">
			<?php esc_html_e('Email', 'email-list-plugin'); ?>
			<span class="required">*</span>
			<br>
		</label>
		<input id="email" name="email" type="email" placeholder="<?php esc_attr_e('Email', 'email-list-plugin'); ?>" required />
	</p>

	<p class="form-submit wp-block-button">
		<button class="wp-block-button__link wp-element-button" type="submit" name="email_list_submit">
			<?php esc_html_e('Submit!!', 'email-list-plugin'); ?>
		</button>
	</p>
</form>
<?php if (isset($_GET['form_submitted']) && $_GET['form_submitted'] == '1') : ?>
	<p class="form-message success">
		<?php esc_html_e('Thank you for signing up!', 'email-list-plugin'); ?>
	</p>
<?php endif; ?>


<?php

if (isset($_POST['email_list_submit'])) {
	if (
		!isset($_POST['email_list_form_nonce']) ||
		!wp_verify_nonce($_POST['email_list_form_nonce'], 'email_list_form_action')
	) {
		exit('Sorry, your nonce did not verify.');
	}

	global $wpdb;
	$table_name = $wpdb->prefix . 'email_list_submissions';

	$first_name = sanitize_text_field($_POST['first_name']);
	$last_name = sanitize_text_field($_POST['last_name']);
	$email = sanitize_email($_POST['email']);

	$wpdb->insert(
		$table_name,
		array(
			'first_name' => $first_name,
			'last_name' => $last_name,
			'email' => $email,
		)
	);

	$redirect_url = add_query_arg('form_submitted', '1', wp_get_referer());
	wp_safe_redirect($redirect_url);
	exit;
}
?>
