<?php
include('wp/wp-load.php');
require_once("wp/wp-blog-header.php");
echo "<title>Kidrend</title>";
get_header();

global $wpdb,$wp_query,$post;
$page_id = 8;
$background_image_sec1 = get_field('background_image_sec1', $page_id);
$content_banner_image = get_field('content_banner_image', $page_id);
$title_sec1 = get_field('title_sec1', $page_id);
$description_sec1 = get_field('description_sec1', $page_id);
?>
<div class="jumbotron jumbotron-fluid home" style="background:#ef5023 url('<?php the_field('background_image_sec1'); ?>') no-repeat center bottom;">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-xl-6">
        <div class="jumbotron-content">
          <h1><?php the_field('title_sec1'); ?></h1>
          <p class="lead"><?php the_field('description_sec1'); ?></p>
          <div class="d-block"> <a href="<?php the_field('app_store_link'); ?>" class="app-store-btn" target="_blank">App store</a>
          <a href="<?php the_field('google_play_link'); ?>" class="play-store-btn" target="_blank">Google play</a> </div>
        </div>
      </div>
      <div class="col-xl-6 col-sm-10 text-xl-right text-center"> <img src="<?php the_field('content_banner_image'); ?>" alt="mobile-mockup-hero" class="img-fluid"> </div>
    </div>
  </div>
</div>
<main role="main" class="site-main-content home-bg" style="background:url('<?php the_field('page_back_image'); ?>') no-repeat center -500px;">
  <div class="container">
    <section class="home-section-1">
      <div class="row justify-content-center">
        <div class="col-md-7 d-flex align-items-center order-md-2">
          <div class="app-side-content pl-lg-60 wow fadeInRight" data-wow-delay="0.2s">
            <h2><?php the_field('title_sec2'); ?></h2>
            <p><?php the_field('description_sec2'); ?></p>
          </div>
        </div>
      <div class="col-xl-3 col-md-5 col-7 text-center order-md-1 mt-md-0 mt-4"> <img src="<?php the_field('image_sec2'); ?>" class="img-fluid" alt="Notifications Mockup"> </div>
      </div>
    </section>
<?php $features_section2 = get_field('app_features_section', $page_id); ?>
    <section class="home-section-2">
      <div class="row justify-content-center">
        <?php foreach($features_section2 as $value){ ?>
        <div class="col-xl-4 col-md-6 d-flex mb-4">
          <div class="app-features wow fadeInUp" data-wow-delay="0.4s">
            <div class="feature-icon"> <img src="<?php echo $value['image_features']; ?>" alt="time" class="img-fluid"> </div>
            <h3><?php echo $value['title_features']; ?></h3>
            <p><?php echo $value['description_features']; ?></p>
          </div>
        </div>
        <?php }?>
      </div>
    </section>
    <section class="home-section-3">
      <div class="row justify-content-center">
        <div class="col-md-5 d-flex align-items-center">
          <div class="app-side-content wow fadeInLeft" data-wow-delay="0.2s">
            <h2><?php the_field('title_sec4'); ?></h2>
            <p><?php the_field('description_sec4'); ?></p>
          </div>
        </div>
        <div class="col-xl-5 col-md-6 double-mock">
          <div> <img src="<?php the_field('image1_sec4'); ?>" class="img-fluid" alt="mobile-mockup-students"> </div>
          <div> <img src="<?php the_field('image2_sec4'); ?>" class="img-fluid mt-5" alt=""> </div>
        </div>
      </div>
    </section>
<?php $services_section = get_field('services_section', $page_id); ?>
    <section class="home-section-4">
      <div class="row no-gutters">
      <?php $count = 1;
	  foreach($services_section as $value){

		  $borderbottom = '';
	 	 if($count == 1 || $count == 2 || $count == 3) {
			$borderbottom = "brd-btm";
			}

		   ?>
        <div class="col-lg-4 col-md-6 divservicecol">
          <div class="<?php echo $borderbottom; ?> icon-hover-box  brd-right mainiconbox <?php echo $value['hover_background_color']; ?>" id="hover-box-<?php echo $count; ?>" data-hoverbox=<?php echo $value['service_hover_image']; ?> data-boxcnt=<?php echo $count; ?> data-serviceimag=<?php echo $value['image_services']; ?>>
            <div class="wow fadeIn" data-wow-delay="0.2s">
              <div class="icon" style="background:url('<?php echo $value['image_services']; ?>') no-repeat center center;"></div>
              <h3><?php echo $value['title_services']; ?></h3>
              <p><?php echo $value['description_services']; ?></p>
            </div>
          </div>
        </div>
        <?php $count++; }?>
      </div>
    </section>
    <section class="home-section-5">
<?php $business_profile = get_field('business_profile', $page_id); ?>
 <?php $count = 1;
	  foreach($business_profile as $value){
	  $order2 = '';
	  if($count == 1) {
				 $order2 = "order-md-2";
			 }
	  ?>
      <div class="row justify-content-center row_section<?php echo $count; ?>">
        <div class="col-md-5 d-flex align-items-center mb-4 <?php echo $order2;?>">
          <div class="app-side-content wow fadeInLeft" data-wow-delay="0.2s">
            <h2><?php echo $value['title_business']; ?></h2>
            <p><?php echo $value['description_business']; ?></p>
          </div>
        </div>
        <div class="col-md-4 col-7 text-center mb-4"> <img src="<?php echo $value['image_business']; ?>" class="img-fluid" alt="Feed Mockup"> </div>
      </div>
       <?php $count++; }?>
    </section>
    <section class="home-section-6">
      <div class="row justify-content-center">
        <div class="col-xl-6 col-md-8 d-flex align-items-center order-md-2">
          <div class="app-side-content wow fadeInRight" data-wow-delay="0.4s">
            <h2><?php the_field('title_sec7'); ?></h2>
            <p><?php the_field('description_sec7'); ?></p>
          </div>
        </div>
        <div class="col-md-4 col-8 text-md-left text-center order-md-1 mt-md-0 mt-4"> <img src="<?php the_field('image_sec7'); ?>" alt="Menu Mockup" class="img-fluid"> </div>
      </div>
    </section>
  </div>
  <div class="download-app" style="background:url('<?php the_field('background_image_dwnapp'); ?>') no-repeat center center;" id="download_app">
    <div class="download-banner-content" >
      <h2 class="h1 mb-4 wow fadeInUp" data-wow-delay="0.2s"><?php the_field('title_dwnapp'); ?></h2>
      <p class="wow fadeInUp" data-wow-delay="0.4s"><?php the_field('desctiprion_dwnapp'); ?></p>
      <div class="d-block mt-5 wow fadeInUp" data-wow-delay="0.6s"> <a href="<?php the_field('app_store_link'); ?>" class="app-store-btn" target="_blank">App store</a>
      <a href="<?php the_field('google_play_link'); ?>" class="play-store-btn" target="_blank">Google play</a> </div>
    </div>
  </div>
</main>
<?php get_footer(); exit;?>
