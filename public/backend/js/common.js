window._ajax_error_msg_common = "Oops, Something went wrong.";
window._add_edit_model_element = ".add-edit-model";
window._filter_form = 'form.filter-form';
window._sorted_order = "._sorted_order";
window._sorted_by = "._sorted_by";

function setSortedBy(sorted_by){
    jQuery( window._filter_form +" "+ window._sorted_by ).val(sorted_by);
}
function setSortedOrder(sorted_order){
    jQuery( window._filter_form +" "+ window._sorted_order ).val(sorted_order);
}
function sortWithSearch(sorted_by){

    var current_sorted_by = jQuery(window._sorted_by).val();
    var current_sorted_order = jQuery(window._sorted_order).val();
    setSortedBy(sorted_by);
    if(sorted_by != current_sorted_by){
        setSortedOrder('ASC');
    }else{
        setSortedOrder(((current_sorted_order.toLowerCase() == ('DESC').toLowerCase()) ? 'ASC' : 'DESC'));
    }
    serialize_data = jQuery(window._filter_form).serialize().replace(/[^&]+=\.?(?:&|$)/g, '').replace(/&*jQuery/, "");
    window.location.href = jQuery(window._filter_form).attr('action')+'?'+serialize_data;
    //jQuery(window._filter_form).submit();
}

/* Hide Loader */
function hideLoader(){ jQuery("div#loader").hide(); }

/* show Loader */
function showLoader(){ jQuery("div#loader").show(); }

/* Open Model */
function openAddModal(model_selector = '.add-edit-model') {
    openModal(model_selector);
}

/* Img open */
jQuery(".select-file-btn").click(function(e) {
    if(jQuery(this).parent().find('input[type=file]').length > 0) {
        jQuery(this).parent().find('input[type=file]')[0].click();
    }
});
jQuery(".file-select").on('change', function(){
    var message_ele = jQuery(this).data('name');
    jQuery("."+ message_ele).text("Select file");
    if (this.files.length > 0 && this.files && this.files[0]) {
        jQuery("."+ jQuery(this).data('name')).text(this.files[0].name);
    }
});

/* Image end */

/* Open Model Event */
function openModal(model_element, form_ele = '',title ="Add"){
    if(jQuery(model_element+" .modal-title span.title").length > 0) {
        jQuery(model_element + " .modal-title span.title").html(title);
    }
    if(form_ele == '') { form_ele = jQuery(model_element).find('form')[0]; }
    form_ele.reset();
    jQuery(form_ele).find("[data-is-reset='1']").each(function(){
        var reset_value = "";
        if(jQuery(this).data("reset-value") != undefined) {
            reset_value = jQuery(this).data("reset-value");
        }
        jQuery(this).val(reset_value);
    });
    jQuery(form_ele).parsley().reset();
    jQuery(model_element).modal({
        backdrop: 'static',
        keyboard: false
    });
}

/* Document Ready */
jQuery(document).ready(function () {

    if(jQuery('[data-toggle="datepicker"]').length > 0) {

        jQuery('[data-toggle="datepicker"]').datepicker({
            autoHide: true,
            zIndex: 4048,
            format: 'dd-mm-yyyy',
            autoclose: true,
        });
    }

	if (jQuery('[data-toggle="timepicker"]').length > 0) {
        jQuery('[data-toggle="timepicker"]').timepicki({
            increase_direction:'up',
        });
    }

    if(jQuery('[data-toggle="datetimepicker"]').length > 0) {

        jQuery('[data-toggle="datetimepicker"]').datetimepicker({
            format: 'MM/DD/YYYY hh:00:00 A',
            formatTime: 'hh:00 A',
            minDate: 0,  // disable past date
            minTime: 0, // disable past time
        });

        jQuery.datetimepicker.setDateFormatter({
            parseDate: function (date, format) {
                var d = moment(date, format);
                return d.isValid() ? d.toDate() : false;
            },
            formatDate: function (date, format) {
                return moment(date).format(format);
            },
        });

    }

    jQuery(".start_date.date-field.hasDatepicker").change(function () {

        var start_date = jQuery(this).val();
        var end_date = jQuery(".end_date").val();

        if ((Date.parse(end_date) < Date.parse(start_date))) {
            alert("Start date should be less then than end date");
            jQuery(this).val("");
        }
    });

    jQuery(".end_date.date-field.hasDatepicker").change(function () {
        var start_date = jQuery(".start_date").val();
        var end_date = jQuery(this).val();

        if ((Date.parse(end_date) < Date.parse(start_date))) {
            alert("End date should be greater than start date");
            jQuery(this).val("");
        }
    });

    jQuery("#date_of_birth").change(function () {
        var dateOfBirth = document.getElementById("date_of_birth").value;
        var today = new Date();
        var todayDate = (today.getMonth()+1)+'/'+(today.getDate())+'/'+today.getFullYear();
        if(dateOfBirth != undefined && dateOfBirth != '') {
            if ((Date.parse(dateOfBirth) > Date.parse(todayDate))) {
                alert("date of birth should not be greater than today date");
                document.getElementById("date_of_birth").value = "";
            }
        }
    });

    /* eye toggle for password */
    jQuery(".toggle-password").click(function() {
        jQuery(this).toggleClass("fa-eye fa-eye-slash");
        var input = jQuery(jQuery(this).attr("toggle"));
        if (input.attr("type") == "password") {
            input.attr("type", "text");
        } else {
            input.attr("type", "password");
        }
    });

    /* Multi Select */
    if(jQuery('select[multiple].common').length > 0) {

        jQuery(form +' select[multiple].common').multiselect({
            columns: 1,
            placeholder: 'Select class',
            search: true,
            searchOptions: {
                'default': jQuery(this).attr('data-select-text')
            },
            selectAll: true
        });
    }

	jQuery(document).on("propertychange change keyup paste input",'.digitonly', function(){
	  this.value = this.value.replace(/\D/g,'');
	});

    /* word Count Validation */
    if( jQuery('[data-count-validation="word"]').length > 0 ) {
        jQuery('[data-count-validation="word"]').on("propertychange change keyup paste input", function () {
            var regex = /\s+/gi;
            var str = jQuery(this).val();
            var wordCount = jQuery(this).val().trim().replace(regex, ' ').split(' ').length;
            var totalWorldAccept = jQuery(this).attr('data-total-word-accept');
            var countrSelector = jQuery(this).attr('data-counter-selector');
            var remainWord = (totalWorldAccept - wordCount);
            jQuery(countrSelector).html( remainWord );
            jQuery(this).val(str.split(/\s+/).slice(0,totalWorldAccept).join(" "));
        });
    }

    /* parsley field name changes */
    $.listen('parsley:field:error', function(){
        $("form[data-parsley-validate]").each(function(k,e){
            var inputs = $(this).find('.parsley-error');
            $(inputs).each(function(){
                var error_lable_by = $(this).attr('data-parsley-id');
                var field = $(this).attr('data-field-label');
                if(typeof field === 'undefined'){
                    field = $(this).attr('type');
                }
                $('#parsley-id-'+error_lable_by).find("li").each(function(){
                    var text = $(this).html();
                    text = text.replace('This value', field);
                    $(this).html(text);
                })
            })
        });
    });
});
function AjaxCall(_options) {
    var defaults = {
        _url:'',
        _data: null,
        _method: 'POST',
        _enctype: 'multipart/form-data',
        _async: true,
        _dataType: 'JSON',
        _processData: false,
        _contentType: false,
        _cache: false,
        _is_show_msg: false,
        _is_page_reload: false,
        _callback_func: undefined
    };
    var options = $.extend({},defaults,_options,true);
    showLoader();
    jQuery.ajaxSetup({headers: {'X-CSRF-TOKEN': window._token}});
    jQuery.ajax({
        url: options._url,
        enctype: options._enctype,
        method: options._method,
        async: options._async,
        dataType: options._dataType,
        processData: options._processData,
        contentType: options._contentType,
        cache: options._cache,
        data: options._data,
        success: function (response) {
            if(options._is_show_msg) {
                if(response.success){

                    /* Message */
                    toastr.success(response.message);

                    /* Page reload */
                    if(options._is_page_reload) {
                        setTimeout(function () {
                            location.reload();
                        }, 2000);
                    }
                }else{
                    toastr.error(response.message);
                }
            }
            hideLoader();
            if(options._callback_func != undefined) {
                options._callback_func(response);
            }
        },
        error: function (xhr, status) {
            if(options._is_show_msg) {
                toastr.error(window._ajax_error_msg_common);
            }
            hideLoader();
            if(options._callback_func != undefined) {
                var response = new Object();
                response.success = false;
                response.message = window._ajax_error_msg_common;
                options._callback_func(response);
            }
        }
    });
}
function FormDataBind(form,data){
    jQuery.each(data, function( index, value ) {
        if(jQuery(form+" [name="+index+"]").length > 0) {
            jQuery(form + " [name=" + index + "]").val(value);
        }
    });
}
