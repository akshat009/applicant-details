(function ($) {
  "use strict";
  $(function () {
    $("#application_form").validate({
      rules: {
        firstname: {
          required: true,
          minlength: 2,
        },
        email: {
          required: true,
          email: true,
        },
        mobile: {
          number: true,
        },
        post_applied: {
          required: true,
        },
        cv_upload: {
          required: true,
          extension: "pdf|doc|docx",
        },
      },
      messages: {
        firstname: {
          required: "Please enter your name",
          minlength: "Enter a valid name",
        },
        email: {
          required: "Please enter your email",
          true: "Enter a valid email",
        },
        cv_upload: {
          required: "CV is required",
          extension: "only pdf,doc and docx format allowed",
        }, 
        number: "Please enter numbers only",
        post_applied: "Enter the post applied for",
       
      },
      submitHandler: function (event) {
        var formData = new FormData();
        var fname = $("#firstname").val();
        var lname = $("#lasttname").val() ?? '';
        var email = $("#email").val();
        var address = $("#address").val();
        var mobile = $("#mobile").val();
        var post_applied = $("#post_applied").val();
        var file = jQuery(document).find('input[type="file"]');
        var individual_file = file[0].files[0];
        var nonce = plugin_data.nonce;
        formData.append("action", "applicant_form_process");
        formData.append("fname", fname);
        formData.append("lname", lname);
        formData.append("email", email);
        formData.append("address", address);
        formData.append("mobile", mobile);
        formData.append("post_applied", post_applied);
        formData.append("cv", individual_file);
        formData.append("nonce", nonce);
        $.ajax({
          type: "post",
          url: plugin_data.ajax_url,
          data: formData,
          contentType: false,
          processData: false,
          beforeSend: function () {
            $("#application_form .row:last-child").hide();
          },
          success: function (response) {
            $("#submit").prop("disabled", false);
            $("#application_form").trigger('reset');
          },
          error: function () {
            alert("error");
          },
        });
      },
    });
  });
})(jQuery);
