<script>
    /* Open Contact Model */
    function openContactModal( user_id, model_selector ='.contact-model') {
        openModal(model_selector);
        jQuery(model_selector +" form.contact-form #contact_model_user_id").val(user_id);
    }

    /* Send Message Ajax Call */
    jQuery("form.contact-form").submit(function (event) {
        event.preventDefault();
        if (jQuery(this).parsley().validate()) {
            var ajax_data = new FormData();
            ajax_data.append('user_id', jQuery("#contact_model_user_id").val());
            ajax_data.append('message', jQuery("#contact_model_message").val());
            AjaxCall({
                _url : window.sendContactMailUrl,
                _data : ajax_data,
                _is_show_msg : true,
                _is_page_reload : true,
            });
        }
    });
    /* Contact form end */
</script>
