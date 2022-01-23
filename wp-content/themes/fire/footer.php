<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Fire
 */

?>

	<footer class="text-white bg-gray-500">
		<?php _e('Fire Theme', 'fire'); ?>
    <div class="flex items-center justify-start space-x-2">
      <?php require get_template_directory() . '/templates/components/social-links/social-links.php';?>
    </div>
	</footer>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
