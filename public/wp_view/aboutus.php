<?php
include('wp/wp-load.php');
require_once("wp/wp-blog-header.php");
echo "<title>About us | Kidrend</title>";
get_header();

global $wpdb,$wp_query,$post;
$page_id = 10;
$about_us_section = get_field('about_us_section', $page_id);
?>
<main role="main">

        <div class="container">

            <h1 class="about-title wow fadeIn" data-wow-delay="0.2s"><?php the_field('title_sec1'); ?></h1>
 		<?php $count = 1; foreach($about_us_section as $value){ ?>
            <div class="row no-gutters abt-row wow fadeInUp row_section<?php echo $count; ?>" data-wow-delay="0.5s">

                <div class="col-lg-6 div_col1">
                    <div class="about-col-img" id="section-<?php echo $count; ?>-image" style="background:url('<?php echo $value['image_abt']; ?>') no-repeat center center;background-size:cover;"></div>
                </div>

                <div class="col-lg-6 d-flex align-items-center div_col2">
                    <div class="about-content">
                        <?php if(!empty($value['title_abt'])){ ?><h2><?php echo $value['title_abt']; ?></h2><?php } ?>
                         <?php if(!empty($value['description_abt'])){ ?><?php echo $value['description_abt']; ?><?php } ?>
                    </div>
                </div>

            </div>
		<?php $count++; } ?>
            <div class="about-bottom-cta wow fadeIn">

                <?php the_field('description_sec2'); ?>
               <div class="divapp_storeimage">
               	<a class="appstore_btn" href="<?php the_field('app_store_button_link'); ?>" target="_blank"><img src="<?php the_field('app_store_image'); ?>" /></a>
                <a class="googlestore_btn" href="<?php the_field('google_play_store_button_link'); ?>" target="_blank"><img src="<?php the_field('google_play_store_image'); ?>" /></a>
               </div> 
               
               <?php /*?> <a href="<?php the_field('button_link_sec2'); ?>" class="btn btn-black"><?php the_field('button_label_sec2'); ?></a><?php */?>

            </div>

        </div>

    </main>
<style>
.row_section2 .div_col1, .row_section4 .div_col1 {order: 2 !important;}
.row_section2 .div_col2, .row_section4 .div_col2 {order: 1 !important;}
.about-page {background: url('<?php the_field('page_background_image'); ?>') no-repeat center bottom;background-size: cover;}
.divapp_storeimage {margin-top:10px;margin-bottom:10px;}
.divapp_storeimage a img {max-width: 220px;}
.divapp_storeimage a {margin-left: 5px;margin-right: 5px;}
@media(max-width:767px){
	.divapp_storeimage a img{margin-bottom:10px !important;}
}
</style>
<?php get_footer(); exit;?>
