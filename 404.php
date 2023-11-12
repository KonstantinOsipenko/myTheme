<?php
/**
 * The template for displaying 404 pages (Not Found)
 */

get_header(); ?>
<!-- BEGIN of 404 page -->
<section class="error-section">
    <div class="bg-overlay bg-cover"></div>
    <div class="container not-found">
        <div class="row">
            <div class="col-md-12 text-center">
                <h1><?php _e('404', 'bwp'); ?></h1>
                <h3><?php _e('Opsss.. Something went wrong', 'bwp'); ?></h3>
                <p><?php printf(__(' <a class="btn" href="%1s">Back to Homepage</a>', 'bwp'), get_bloginfo('url')); ?></p>
            </div>
        </div>
    </div>
</section>
<!-- END of 404 page -->
<?php get_footer(); ?>
