/**
 * Retrieves the translation of text.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-i18n/
 */
import { __ } from '@wordpress/i18n';

/**
 * React hook that is used to mark the block wrapper element.
 * It provides all the necessary props like the class name.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-block-editor/#useblockprops
 */
import { useBlockProps } from '@wordpress/block-editor';

/**
 * Lets webpack process CSS, SASS or SCSS files referenced in JavaScript files.
 * Those files can contain any CSS code that gets applied to the editor.
 *
 * @see https://www.npmjs.com/package/@wordpress/scripts#using-css
 */
import './editor.scss';

/**
 * The edit function describes the structure of your block in the context of the
 * editor. This represents what the editor will render when the block is used.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-edit-save/#edit
 *
 * @return {Element} Element to render.
 */
export default function Edit() {
	const blockProps = useBlockProps();

	return (
		<>
			<form {...blockProps}>
				<p>
					<label htmlFor="first_name">
						{__('First Name', 'email-list-plugin')}
						<span className="required">*</span>
					</label>
					<br />
					<input id="first_name" type="text" />
				</p>
				<p>
					<label htmlFor="last_name">
						{__('Last Name', 'email-list-plugin')}
						<span className="required">*</span>
					</label>
					<br />
					<input id="last_name" type="text" />
				</p>
				<p>
					<label htmlFor="email">
						{__('Email', 'email-list-plugin')}
						<span className="required">*</span>
					</label>
					<br />
					<input id="email" type="email" />
				</p>
				<p className="form-submit wp-block-button">
					<button
						className="wp-block-button__link wp-element-button"
						type="submit"
					>
						{__('Submit!!', 'email-list-plugin')}
					</button>
				</p>
			</form>
		</>
	);
}
