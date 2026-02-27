<?php
/**
 * Footer template.
 *
 * @package AziumeHumor
 */
?>
</main>
<footer class="site-footer">
	<div class="container">
		<?php wp_nav_menu( [ 'theme_location' => 'footer', 'container' => false, 'fallback_cb' => false ] ); ?>
		<p>&copy; <?php echo esc_html( gmdate( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?></p>
	</div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
