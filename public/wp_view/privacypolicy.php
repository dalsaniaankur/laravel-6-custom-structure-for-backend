<?php
include('wp/wp-load.php');
require_once("wp/wp-blog-header.php");
echo "<title>Privacy Policy | Kidrend</title>";
get_header();

global $wpdb,$wp_query,$post;
$page_id = 14;
$content_post = get_post($page_id);
$content = $content_post->post_content;
$content = apply_filters('the_content', $content);
$content = str_replace(']]>', ']]&gt;', $content);
?>
<main role="main">
  <div class="terms-wrap">
    <?php echo $content; ?>
  </div>
</main>
<?php get_footer(); exit;?>
