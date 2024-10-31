<?php

use Tribe\NextivaOne\Template;

if ( empty( $fields ) ) {
	return;
}
?>
<div class="nextiva-one__form" data-js="nexone-contact-form">
	<?php do_action( 'nextivaone/form/contact_form/before' ); ?>
	<div class="nextiva-one__form-wrapper" data-js="nexone-form-wrapper">
		<button type="button" class="nextiva-one__text-button" data-js="nexone-form-close">
			<span class="icon">
				<svg width="8" height="15" viewBox="0 0 8 15" fill="none" xmlns="http://www.w3.org/2000/svg" class="object-fit contain">
					<path d="M7 1.5L1 7.5L7 13.5" stroke="#18216d" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
				</svg>
			</span>
			<span class="text"><?php esc_html_e( 'All contact options', 'nexone' ); ?></span>
		</button>
		<h2 class="t-form-title">Message Us</h2>
		<form class="nextiva-one__form-element" action="<?php echo sprintf( '%snextivaone/v1/form/submission', get_rest_url() )?>" method="post">
			<?php foreach ( $fields as $key => $field ): ?>
				<div class="nextiva-one__form-field">
					<label for="<?php echo $field['id'];?>">
						<?php echo $field['label']; ?>
					</label>
					<?php if ( $field['type'] !== 'textarea' ): ?>
						<input
							type="<?php echo $field['type']; ?>"
							id="<?php echo $field['id']; ?>"
							name="<?php echo $field['name']; ?>"
							<?php echo $field['required'] ? 'required' : '' ?>
							<?php echo ! empty( $field['classes'] ) ? sprintf( 'class="%s"', implode( ' ', $field['classes'] ) ) : '' ?>
							<?php echo Template::get_field_attributes( $field['attrs'] );?>
							placeholder="<?php echo $field['placeholder']; ?>" />
					<?php else: ?>
						<textarea
							id="<?php echo $field['id']; ?>"
							name="<?php echo $field['name']; ?>"
							<?php echo $field['required'] ? 'required' : '' ?>
							<?php echo ! empty( $field['classes'] ) ? sprintf( 'class="%s"', implode( ' ', $field['classes'] ) ) : '' ?>
							<?php echo Template::get_field_attributes( $field['attrs'] );?>
							placeholder="<?php echo $field['placeholder']; ?>"></textarea>
					<?php endif; ?>
				</div>
			<?php endforeach; ?>

			<?php wp_nonce_field('wp_rest' ) ?>

			<div class="nextiva-one__form-footer">
				<button type="submit" class="nextiva-one__button"><?php esc_html_e( 'Submit', 'nexone' ); ?></button>
			</div>
		</form>
	</div>
	<div class="nextiva-one__form-submitted" data-js="nexone-form-success">
		<span class="icon">
			<svg width="83" height="64" viewBox="0 0 83 64" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M73.4 52.7992H28.6C25.5088 52.7992 23 50.6488 23 47.9992V15.9992C23 13.3496 25.5088 11.1992 28.6 11.1992H73.4C76.4912 11.1992 79 13.3496 79 15.9992V47.9992C79 50.6488 76.4912 52.7992 73.4 52.7992Z" stroke="#005FEC" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
				<path d="M23 16L51 32L79 16" stroke="#005FEC" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
				<line x1="26.5332" y1="26.6001" x2="1.86654" y2="26.6001" stroke="#005FEC" stroke-width="2" stroke-linecap="round"/>
				<line x1="26.5332" y1="37.2666" x2="1.86654" y2="37.2666" stroke="#005FEC" stroke-width="2" stroke-linecap="round"/>
				<line x1="26.5332" y1="31.9331" x2="7.19987" y2="31.9331" stroke="#005FEC" stroke-width="2" stroke-linecap="round"/>
			</svg>
		</span>
		<div class="nextiva-one__content">
			<p><strong><?php esc_html_e( 'Message sent', 'nexone' ); ?></strong></p>
			<p><?php esc_html_e( 'Thank you for reaching out. A representative will get in touch with you shortly.', 'nexone' ); ?></p>
			<button type="button" class="nextiva-one__button" data-js="nexone-form-close"><?php esc_html_e( 'Close', 'nexone' ); ?></button>
		</div>
	</div>
	<div class="nextiva-one__form-error" data-js="nexone-form-error">
		<span class="icon">
			<svg width="64" height="64" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
				<circle cx="32" cy="32" r="28" stroke="#C5000C" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
				<circle cx="24.5" cy="25.5" r="1.5" fill="#C5000C"/>
				<circle cx="39.5" cy="25.5" r="1.5" fill="#C5000C"/>
				<path d="M24 44.5906C27.5 40.0005 34.5 37 41 38" stroke="#C5000C" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
			</svg>
		</span>
		<div class="nextiva-one__content">
			<p><strong><?php esc_html_e( 'Whoops, something went wrong', 'nexone' ); ?></strong></p>
			<p><?php esc_html_e( 'Feel free to try again or go back and try any of the other contact options we have available.', 'nexone' ); ?></p>
			<button type="button" class="nextiva-one__button" data-js="nexone-form-back"><?php esc_html_e( 'Try again', 'nexone' ); ?></button>
		</div>
	</div>
	<?php do_action( 'nextivaone/form/contact_form/after' ); ?>
</div>
