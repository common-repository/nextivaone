<?php declare(strict_types=1);

use Tribe\NextivaOne\Settings\Button_Settings;
use Tribe\NextivaOne\Settings\Settings;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>
<?php $errors = get_settings_errors( Button_Settings::NEXTIVA_ONE_NUMBER ); ?>

<div class="wrap nextiva-one" data-js="nextiva-one">
	<?php require 'header.php'; ?>
	<?php if ( ! empty( $errors ) ) : ?>
		<div class="notice notice-error inline">
			<p>
				<?php echo $errors[0]['message']; ?>
			</p>
		</div>
	<?php endif; ?>
	<form method="post" action="options.php">
		<?php settings_fields( Settings::NEXTIVA_ONE_GROUP ); ?>
		<div class="nextiva-one__settings">
			<table class="form-table" role="presentation">
				<?php do_settings_fields( Settings::NEXTIVA_ONE_GROUP, Button_Settings::NEXTIVA_ONE_BUTTON_SECTION ); ?>
			</table>
		</div>

		<?php submit_button( esc_html__( 'Save Changes', 'nextivaone' ) );?>
	</form>
</div>
