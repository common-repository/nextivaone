<?php declare(strict_types=1);

/**
 * @var string $url The path to hide the plugin notification
 * @var string $admin_banner_cutout_uri The URI for the admin banner cutout image
 */
?>
<div class="wrap nextiva-one__admin-banner">
	<div class="nextiva-one__admin-banner--title">
		<span class="title-text">
			<?php echo esc_html__( 'NextivaONE for Wordpress has been added!', 'nextivaone' ); ?>
		</span>
		<?php printf(
			'<span class="%s"><a href="%s" class="%s"><span class="icon">%s</span><span class="text">%s</span></a></span>',
			'title-dismiss',
			esc_url( $url ),
			'title-dismiss--link',
			'<svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg" class="object-fit contain"><path d="M13 1L1 13" stroke="white"/><path d="M1 1L13 13" stroke="white"/></svg>',
			esc_html__( 'Dismiss', 'nextivaone' )
		); ?>
	</div>
	<div class="nextiva-one__admin-banner--content">
		<div class="image">
			<img src="<?php echo esc_url( $admin_banner_cutout_uri ); ?>" alt="NextiveOne image" class="object-fit contain">
		</div>
		<div class="content">
			<h1 class="nextiva-one__logo">
				<svg width="266" height="74" viewBox="0 0 266 74" fill="none" xmlns="http://www.w3.org/2000/svg">
					<g clip-path="url(#clip0_6_109)">
						<mask id="mask0_6_109" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="0" y="0" width="266" height="74">
							<path d="M265.433 0H0V74H265.433V0Z" fill="white"/>
						</mask>
						<g mask="url(#mask0_6_109)">
							<path d="M105.353 27.6636C112.981 27.6636 119.164 21.4709 119.164 13.8318C119.164 6.19269 112.981 0 105.353 0C97.7254 0 91.5421 6.19269 91.5421 13.8318C91.5421 21.4709 97.7254 27.6636 105.353 27.6636Z" fill="#FFB800"/>
							<path d="M26.112 30.8188H0V73.9567H12.2973V40.0682H23.0448C24.2703 40.0682 25.4457 40.5555 26.3128 41.4228C27.1797 42.2901 27.6675 43.4667 27.669 44.6939V74.0002H39.9663V44.6939C39.9752 42.8693 39.6229 41.0611 38.9298 39.3737C38.2368 37.6862 37.2165 36.1531 35.9283 34.8629C34.64 33.5727 33.1091 32.5509 31.4242 31.8568C29.7394 31.1627 27.9339 30.8099 26.112 30.8188Z" fill="white"/>
							<path d="M161.504 64.6638H153.433C152.269 64.5759 151.181 64.0499 150.388 63.1919C149.596 62.3339 149.157 61.2071 149.16 60.038V40.0247H161.457V30.7753H149.16V15.3442H136.862V30.739H131.468L124.56 39.9759H136.857V60.0797C136.855 61.8965 137.211 63.696 137.904 65.3751C138.598 67.0542 139.615 68.5797 140.898 69.8645C142.181 71.1491 143.704 72.1679 145.38 72.8624C147.057 73.5569 148.853 73.9134 150.668 73.9114H161.415V68.7732L161.502 64.6673L161.504 64.6638Z" fill="white"/>
							<path d="M128.443 30.8186H114.588L105.396 43.1344L96.1605 30.8186H82.2627L98.4482 52.3441L82.2627 73.9565H96.1605L105.396 61.5937L114.588 73.9565H128.443L112.301 52.3441L128.443 30.8186Z" fill="white"/>
							<path d="M213.768 30.8186L203.021 58.2665L192.276 30.8186H179.931L196.892 73.9565H209.15L226.069 30.8186H213.768Z" fill="white"/>
							<path d="M176.868 30.8186H164.567V73.9565H176.868V30.8186Z" fill="white"/>
							<path d="M176.868 15.3876H164.567V27.7071H176.868V15.3876Z" fill="white"/>
							<path d="M64.5674 64.6636C60.6829 64.6636 57.4024 61.4651 56.0225 56.9698H85.6302C85.9586 55.4495 86.1319 53.8997 86.1474 52.3443C86.1474 48.0784 84.8843 43.9081 82.5178 40.3611C80.1513 36.8141 76.7877 34.0496 72.8526 32.417C68.9173 30.7846 64.5868 30.3574 60.4091 31.1897C56.2315 32.0218 52.394 34.0761 49.3821 37.0927C46.3701 40.1091 44.3189 43.9523 43.488 48.1363C42.657 52.3202 43.0835 56.6572 44.7135 60.5982C46.3437 64.5395 49.104 67.9081 52.6456 70.2782C56.1873 72.6482 60.3513 73.9132 64.6108 73.9132H79.1995L86.1059 64.6636H64.5674ZM64.5674 40.0682C68.4519 40.0682 71.7324 43.2667 73.1123 47.762H55.9773C57.4024 43.2232 60.7263 40.0682 64.5674 40.0682Z" fill="white"/>
							<path d="M251.577 30.8186H229.135L225.518 40.068H248.485C249.709 40.0695 250.882 40.5574 251.749 41.4245C252.615 42.2917 253.103 43.4674 253.103 44.6938V47.7618H234.656V47.8053C231.331 48.0016 228.208 49.4623 225.923 51.8888C223.64 54.3153 222.367 57.5243 222.367 60.8593C222.367 64.1943 223.64 67.4031 225.923 69.8297C228.208 72.2562 231.331 73.717 234.656 73.9131V73.9565H265.427V44.6503C265.414 40.9792 263.95 37.4627 261.354 34.8705C258.759 32.2783 255.242 30.8214 251.577 30.8186ZM237.73 57.0568C237.944 57.0133 238.205 57.0133 238.377 56.9698H253.093V64.6636H238.377C238.159 64.6588 237.943 64.6296 237.73 64.5767C236.867 64.3931 236.092 63.9207 235.534 63.2373C234.974 62.5537 234.666 61.6999 234.656 60.8167C234.68 59.9374 234.994 59.091 235.55 58.4106C236.108 57.73 236.875 57.2538 237.73 57.0568Z" fill="white"/>
						</g>
					</g>
					<defs>
						<clipPath id="clip0_6_109">
							<rect width="266" height="74" fill="white"/>
						</clipPath>
					</defs>
				</svg>
				<span class="sr-only">NextivaOne</span>
			</h1>
			<div class="nextiva-one__content white">
				<p class="size-xlarge"><?php echo esc_html__( 'Turn your website visitors into meaningful conversations', 'nextivaone' ); ?></p>
				<p class="size-large">
					<?php printf(
						'%s <strong>%s</strong>, %s',
						esc_html__( 'Use this simple plugin to add', 'nextivaone' ),
						esc_html__( 'click to call functionality to your website', 'nextivaone' ),
						esc_html__( 'turning your web traffic into conversations and creating new contacts', 'nextivaone' )
					); ?>
				</p>
			</div>
			<div class="nextiva-one__actions inline">
				<span><a href="https://www.nextiva.com/x/nextiva-for-wordpress/?utm_source=Wordpress&utm_medium=Partner+&utm_campaign=Freemium_wordpress" class="nextiva-one__button navy" target="_blank"><?php echo esc_html__( 'Create Account', 'nextivaone' ); ?></a></span>
				<span><a href="<?php echo $settings_url; ?>" class="nextiva-one__button white"><?php echo esc_html__( 'Setup Plugin', 'nextivaone' ); ?></a></span>
			</div>
			<div class="nextiva-one__content white bottom-content">
				<p class="size-small">
					<?php printf(
						'%s. <span class="color-gold">%s</span>',
						esc_html__( 'This will take you to Nextiva.com where you can sign up for the ultimate business phone system', 'nextivaone' ),
						esc_html__( 'And it’s free', 'nextivaone' )
					); ?>
				</p>
			</div>
		</div>
	</div>
</div>
