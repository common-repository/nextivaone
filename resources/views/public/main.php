<?php declare(strict_types=1);

// check "plugin status" setting to see if we should show anything
if ( ! $show_plugin ) {
	return;
}

// check to make sure phone number is set
if ( empty( $phone_number ) ) {
	return;
}

// check where we should show the button
if ( $show_button === 'homepage' && ( ! is_home() || ! is_front_page() ) ) {
	return;
}

$classes = '';

if ( $fonts ) {
	$classes .= ' has-user-fonts';
}
?>
<div class="nextiva-one<?php esc_attr_e( $classes ); ?>" data-button-type="<?php echo esc_attr( $button_type ); ?>" data-button-position="<?php echo esc_attr( $button_position ); ?>" data-responsive="<?php echo esc_attr( $responsive_behavior ); ?>" data-popup-style="<?php echo esc_attr( $popup_style ); ?>" data-js="nexone" style="--nexone-font-color: <?php echo esc_attr( $fonts_color ); ?>; --nexone-header-color: <?php echo esc_attr( $header_color ); ?>; --nexone-header-bg: <?php echo esc_attr( $theme_color ); ?>;">
	<button type="button" class="nextiva-one__actions" data-js="nexone-overlay-toggle" tabindex="0">
		<span class="logo-icon<?php echo ( ! empty( $image ) ) ? ' has-user-image' : ''; ?>">
			<?php if ( ! empty( $image ) ) : ?>
				<img src="<?php echo esc_url( $image[0] ); ?>" alt="<?php esc_html_e( 'Logo Icon', 'nextivaone' ); ?>" class="object-fit contain">
			<?php else : ?>
				<svg width="11" height="16" viewBox="0 0 11 16" fill="none" xmlns="http://www.w3.org/2000/svg" class="object-fit contain">
					<path d="M5.41758 5.98751C7.07239 5.98751 8.41134 4.64586 8.41134 2.99376C8.41134 1.34166 7.06969 0 5.41758 0C3.76548 0 2.42383 1.34166 2.42383 2.99376C2.42383 4.64586 3.76548 5.98751 5.41758 5.98751Z" fill="#FFB800"/>
					<path d="M10.4253 6.6626H7.42073L5.42849 9.32971L3.42546 6.6626H0.420898L3.92216 11.322L0.420898 15.9921H3.42546L5.42849 13.325L7.42073 15.9921H10.4253L6.92402 11.322L10.4253 6.6626Z" fill="white"/>
				</svg>
				<span class="sr-only">
					<?php echo esc_html__( 'NextivaOne', 'nextivaone' ); ?>
				</span>
			<?php endif; ?>
		</span>
		<span class="title align-<?php esc_attr_e( $widget_label_align ); ?>">
			<?php echo esc_html__( $widget_label ); ?>
		</span>
		<span class="close-icon">
			<?php if ( ( $button_position === 'full-width' && $popup_style !== 'modal' ) || ( $button_type === 'static' && $popup_style === 'slide' ) ) : ?>
				<svg width="20" height="12" viewBox="0 0 20 12" fill="none" xmlns="http://www.w3.org/2000/svg" class="object-fit contain">
					<path d="M18 2L10 10L2 2" stroke="white" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
				</svg>
			<?php else : ?>
				<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg" class="object-fit contain">
					<path fill-rule="evenodd" clip-rule="evenodd" d="M12.6512 10.0001L19.8159 2.83545C19.8742 2.77766 19.9205 2.70889 19.9521 2.63312C19.9836 2.55735 19.9999 2.47607 19.9999 2.39398C19.9999 2.31189 19.9836 2.23061 19.9521 2.15484C19.9205 2.07907 19.8742 2.0103 19.8159 1.95251L18.049 0.184519C17.9912 0.126062 17.9223 0.0796543 17.8465 0.0479814C17.7706 0.0163085 17.6892 0 17.607 0C17.5248 0 17.4434 0.0163085 17.3675 0.0479814C17.2916 0.0796543 17.2228 0.126062 17.165 0.184519L10.0003 7.3492L2.83562 0.184519C2.77767 0.126316 2.70879 0.0801326 2.63294 0.0486196C2.55709 0.0171065 2.47576 0.000884361 2.39362 0.000884361C2.31149 0.000884361 2.23016 0.0171065 2.15431 0.0486196C2.07846 0.0801326 2.00958 0.126316 1.95162 0.184519L0.183634 1.95251C0.125464 2.01037 0.0793026 2.07916 0.0478037 2.15493C0.0163048 2.23069 8.93394e-05 2.31193 8.93394e-05 2.39398C8.93394e-05 2.47603 0.0163048 2.55727 0.0478037 2.63303C0.0793026 2.7088 0.125464 2.77759 0.183634 2.83545L7.34832 10.0001L0.183634 17.1648C0.125432 17.2228 0.0792483 17.2916 0.0477352 17.3675C0.0162221 17.4433 0 17.5247 0 17.6068C0 17.6889 0.0162221 17.7703 0.0477352 17.8461C0.0792483 17.922 0.125432 17.9909 0.183634 18.0488L1.95057 19.8157C2.0687 19.9313 2.22735 19.9959 2.39257 19.9959C2.55779 19.9959 2.71644 19.9313 2.83457 19.8157L9.99925 12.6511L17.1639 19.8157C17.2821 19.9313 17.4407 19.9959 17.6059 19.9959C17.7711 19.9959 17.9298 19.9313 18.0479 19.8157L19.8149 18.0488C19.8729 17.9908 19.919 17.9219 19.9504 17.846C19.9819 17.7702 19.9981 17.6889 19.9981 17.6068C19.9981 17.5247 19.9819 17.4434 19.9504 17.3676C19.919 17.2917 19.8729 17.2228 19.8149 17.1648L12.6512 10.0001Z" fill="white"/>
				</svg>
			<?php endif; ?>
			<span class="sr-only">
				<?php echo esc_html__( 'Close', 'nextivaone' ); ?>
			</span>
		</span>
	</button>
	<?php if ( $popup_style !== 'modal' ) : ?>
		<div class="nextiva-one__overlay" data-js="nexone-overlay" role="dialog" aria-label="Nextiva Contact Drawer">
			<div class="nextiva-one__overlay--body" data-js="nexone-overlay-body">
				<?php if ( ! empty( $intro_text ) ) : ?>
					<div class="content nextiva-one__content">
						<p><?php echo esc_html( $intro_text ); ?></p>
					</div>
				<?php endif; ?>
				<div class="buttons">
					<?php echo $buttons; ?>
				</div>
			</div>
			<?php echo $form; ?>
		</div>
	<?php endif; ?>
</div>

<?php if ( $popup_style === 'modal' ) : ?>
	<div class="nextiva-one__modal-wrap<?php esc_attr_e( $classes ); ?>" data-js="nexone-modal" role="dialog" aria-label="Nextiva Contact Overlay" style="--nexone-font-color: <?php echo esc_attr( $fonts_color ); ?>; --nexone-header-color: <?php echo esc_attr( $header_color ); ?>; --nexone-header-bg: <?php echo esc_attr( $theme_color ); ?>;">
		<div class="nextiva-one__overlay" data-js="nexone-overlay">
			<button type="button" class="nextiva-one__actions modal" data-js="nexone-overlay-toggle">
				<span class="logo-icon<?php echo ( ! empty( $image ) ) ? ' has-user-image' : ''; ?>">
					<?php if ( ! empty( $image ) ) : ?>
						<img src="<?php echo esc_url( $image[0] ); ?>" alt="<?php esc_html_e( 'Logo Icon', 'nextivaone' ); ?>" class="object-fit contain">
					<?php else : ?>
						<svg width="11" height="16" viewBox="0 0 11 16" fill="none" xmlns="http://www.w3.org/2000/svg" class="object-fit contain">
							<path d="M5.41758 5.98751C7.07239 5.98751 8.41134 4.64586 8.41134 2.99376C8.41134 1.34166 7.06969 0 5.41758 0C3.76548 0 2.42383 1.34166 2.42383 2.99376C2.42383 4.64586 3.76548 5.98751 5.41758 5.98751Z" fill="#FFB800"/>
							<path d="M10.4253 6.6626H7.42073L5.42849 9.32971L3.42546 6.6626H0.420898L3.92216 11.322L0.420898 15.9921H3.42546L5.42849 13.325L7.42073 15.9921H10.4253L6.92402 11.322L10.4253 6.6626Z" fill="white"/>
						</svg>
						<span class="sr-only">
							<?php echo esc_html__( 'NextivaOne', 'nextivaone' ); ?>
						</span>
					<?php endif; ?>
				</span>
				<span class="title align-<?php esc_attr_e( $widget_label_align ); ?>">
					<?php echo esc_html__( $widget_label ); ?>
				</span>
				<span class="close-icon">
					<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg" class="object-fit contain">
						<path fill-rule="evenodd" clip-rule="evenodd" d="M12.6512 10.0001L19.8159 2.83545C19.8742 2.77766 19.9205 2.70889 19.9521 2.63312C19.9836 2.55735 19.9999 2.47607 19.9999 2.39398C19.9999 2.31189 19.9836 2.23061 19.9521 2.15484C19.9205 2.07907 19.8742 2.0103 19.8159 1.95251L18.049 0.184519C17.9912 0.126062 17.9223 0.0796543 17.8465 0.0479814C17.7706 0.0163085 17.6892 0 17.607 0C17.5248 0 17.4434 0.0163085 17.3675 0.0479814C17.2916 0.0796543 17.2228 0.126062 17.165 0.184519L10.0003 7.3492L2.83562 0.184519C2.77767 0.126316 2.70879 0.0801326 2.63294 0.0486196C2.55709 0.0171065 2.47576 0.000884361 2.39362 0.000884361C2.31149 0.000884361 2.23016 0.0171065 2.15431 0.0486196C2.07846 0.0801326 2.00958 0.126316 1.95162 0.184519L0.183634 1.95251C0.125464 2.01037 0.0793026 2.07916 0.0478037 2.15493C0.0163048 2.23069 8.93394e-05 2.31193 8.93394e-05 2.39398C8.93394e-05 2.47603 0.0163048 2.55727 0.0478037 2.63303C0.0793026 2.7088 0.125464 2.77759 0.183634 2.83545L7.34832 10.0001L0.183634 17.1648C0.125432 17.2228 0.0792483 17.2916 0.0477352 17.3675C0.0162221 17.4433 0 17.5247 0 17.6068C0 17.6889 0.0162221 17.7703 0.0477352 17.8461C0.0792483 17.922 0.125432 17.9909 0.183634 18.0488L1.95057 19.8157C2.0687 19.9313 2.22735 19.9959 2.39257 19.9959C2.55779 19.9959 2.71644 19.9313 2.83457 19.8157L9.99925 12.6511L17.1639 19.8157C17.2821 19.9313 17.4407 19.9959 17.6059 19.9959C17.7711 19.9959 17.9298 19.9313 18.0479 19.8157L19.8149 18.0488C19.8729 17.9908 19.919 17.9219 19.9504 17.846C19.9819 17.7702 19.9981 17.6889 19.9981 17.6068C19.9981 17.5247 19.9819 17.4434 19.9504 17.3676C19.919 17.2917 19.8729 17.2228 19.8149 17.1648L12.6512 10.0001Z" fill="white"/>
					</svg>
					<span class="sr-only">
						<?php echo esc_html__( 'Close', 'nextivaone' ); ?>
					</span>
				</span>
			</button>
			<div class="nextiva-one__overlay--body" data-js="nexone-overlay-body">
				<?php if ( ! empty( $intro_text ) ) : ?>
					<div class="content nextiva-one__content">
						<p><?php echo esc_html( $intro_text ); ?></p>
					</div>
				<?php endif; ?>
				<div class="buttons">
					<?php echo $buttons; ?>
				</div>
			</div>
			<?php echo $form; ?>
		</div>
	</div>
<?php endif; ?>
