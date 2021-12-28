<?php
  /**
   * The template for displaying 404 pages (not found)
   *
   * @link https://codex.wordpress.org/Creating_an_Error_404_Page
   */
?>


<?php get_header(); ?>

  <main id="primary" class="site-main">
    <h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'fire' ); ?></h1>
    <a class="mt-8 button button-primary" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">Back Home</a>
  </main>

<?php get_footer(); ?>