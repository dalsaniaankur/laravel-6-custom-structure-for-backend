<?php
include('wp/wp-load.php');
require_once("wp/wp-blog-header.php");
echo "<title>Contact us | Kidrend</title>";
get_header();

global $wpdb,$wp_query,$post;
$page_id = 12;
$email_sec1 = get_field('email_sec1', $page_id);
$phone_number = get_field('phone_sec1', $page_id);
$address_contact = get_field('address_sec1', $page_id);
$select_contact_form = get_field('contact_form_sec1', $page_id);

$phone_number1 = $phone_number;
$new_phone = preg_replace('/[^0-9.]/', '',$phone_number1);
?>
<main role="main" class="contact-main">

        <div class="container">

            <div class="row">

                <div class="col-md-6 wow fadeInLeft">
                    <h3>Email:</h3>
                    <p class="mb-md-4"><a href="mailto:<?php echo $email_sec1; ?>" style="color:#565656;text-decoration:none;font-weight: 500;font-size: 20px;">
					<?php echo $email_sec1; ?></a></p>
                    <h3>Phone:</h3>
                    <p><a href="tel:<?php echo $new_phone; ?>" style="color:#565656;text-decoration:none;font-weight: 500;font-size: 20px;">
					<?php echo $phone_number; ?></a></p>
                </div>

                <div class="col-md-5 ml-auto mt-md-0 mt-5 wow fadeInRight">
                     <?php echo do_shortcode('[contact-form-7 id="'.$select_contact_form.'"]'); ?>
                </div>

            </div>

        </div>

    </main>
<?php get_footer(); exit;?>
