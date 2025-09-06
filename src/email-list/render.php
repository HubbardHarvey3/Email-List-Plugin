<?php

/**
 * @see https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/block-api/block-metadata.md#render
 */
?>
<form action="" <?php echo get_block_wrapper_attributes(['class' => 'wp-block-post-comments-form']); ?> method="post">
	<?php wp_nonce_field('email_list_form_action', 'email_list_form_nonce'); ?>

	<p>
		<label for="first_name">
			<?php esc_html_e('First Name', 'learning-blocks'); ?>
			<span class="required">*</span>
			<br>
		</label>
		<input id="first_name" name="first_name" type="text" placeholder="<?php esc_attr_e('First Name', 'learning-blocks'); ?>" required />
	</p>

	<p>
		<label for="last_name">
			<?php esc_html_e('Last Name', 'learning-blocks'); ?>
			<span class="required">*</span>
			<br>
		</label>
		<input id="last_name" name="last_name" type="text" placeholder="<?php esc_attr_e('Last Name', 'learning-blocks'); ?>" required />
	</p>

	<p>
		<label for="email">
			<?php esc_html_e('Email', 'learning-blocks'); ?>
			<span class="required">*</span>
			<br>
		</label>
		<input id="email" name="email" type="email" placeholder="<?php esc_attr_e('Email', 'learning-blocks'); ?>" required />
	</p>

	<p class="form-submit wp-block-button">
		<button class="wp-block-button__link wp-element-button" type="submit" name="email_list_submit">
			<?php esc_html_e('Submit!!', 'learning-blocks'); ?>
		</button>
	</p>
</form>
<?php if (isset($_GET['form_submitted']) && $_GET['form_submitted'] == '1') : ?>
	<p class="form-message success">
		<?php esc_html_e('Thank you for signing up!', 'learning-blocks'); ?>
	</p>
<?php endif; ?>
