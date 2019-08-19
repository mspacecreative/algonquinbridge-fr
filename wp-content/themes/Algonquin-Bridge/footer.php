	<footer id="main-footer">
		<?php get_sidebar( 'footer' ); ?>

		<div id="footer-bottom">
			<div class="container clearfix">
				<ul id="et-social-icons">
				<?php if ( 'on' === et_get_option( 'divi_show_facebook_icon', 'on' ) ) : ?>
					<li class="et-social-icon et-social-facebook">
						<a href="<?php echo esc_url( et_get_option( 'divi_facebook_url', '#' ) ); ?>">
							<span><?php esc_html_e( 'Facebook', 'Divi' ); ?></span>
						</a>
					</li>
				<?php endif; ?>
				<?php if ( 'on' === et_get_option( 'divi_show_twitter_icon', 'on' ) ) : ?>
					<li class="et-social-icon et-social-twitter">
						<a href="<?php echo esc_url( et_get_option( 'divi_twitter_url', '#' ) ); ?>">
							<span><?php esc_html_e( 'Twitter', 'Divi' ); ?></span>
						</a>
					</li>
				<?php endif; ?>
				<?php if ( 'on' === et_get_option( 'divi_show_google_icon', 'on' ) ) : ?>
					<li class="et-social-icon et-social-google">
						<a href="<?php echo esc_url( et_get_option( 'divi_google_url', '#' ) ); ?>">
							<span><?php esc_html_e( 'Google', 'Divi' ); ?></span>
						</a>
					</li>
				<?php endif; ?>
				<?php if ( 'on' === et_get_option( 'divi_show_rss_icon', 'on' ) ) : ?>
				<?php
					$et_rss_url = '' !== et_get_option( 'divi_rss_url' )
						? et_get_option( 'divi_rss_url' )
						: get_bloginfo( 'comments_rss2_url' );
				?>
					<li class="et-social-icon et-social-rss">
						<a href="<?php echo esc_url( $et_rss_url ); ?>">
							<span><?php esc_html_e( 'RSS', 'Divi' ); ?></span>
						</a>
					</li>
				<?php endif; ?>
				</ul>

				<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/ail-intl-logo.png" align="left" class="intl-logo" />
				<p class="disclaimer">Algonquin Bridge est une division d'AIL International Inc.</p>
				<div style="padding-top: 55px;" class="clearfix">
					<?php echo et_get_footer_credits(); ?>
				<p id="footer-info">&copy; <?php echo date('Y'); ?> Algonquin Bridge&nbsp;&nbsp;|&nbsp;&nbsp;</p>
				</div>
			</div>	<!-- .container -->
		</div>
	</footer> <!-- #main-footer -->

	<?php wp_footer(); ?>
</body>
</html>
