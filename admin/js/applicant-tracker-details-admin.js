(function ($) {
  "use strict";
  $(function () {
    $(".sort").on("click", function () {
      $("a.sort i.material-icons").toggleClass("down");
      if ($("a.sort i.material-icons").hasClass("down")) {
        $("a.sort i.material-icons").html("arrow_drop_down");
        var orderby = "DESC";
      } else {
        $("a.sort i.material-icons").html("arrow_drop_up");
        orderby = "ASC";
      }
      $.ajax({
        type: "POST",
        dataType: "json",
        url: plugin_admin_data.admin_ajax_url,
        data: {
          action: "applicant_form_sort",
          orderby: orderby,
          nonce: plugin_admin_data.admin_nonce,
        },
        success: function (response) {
          $("#submit").prop("disabled", false);
          $("table.result tbody").html(" ");
          $("table.result tbody").html(response.data);
        },
        error: function () {
          alert("error");
        },
      });
    });
    $("#search").on("keyup", function (e) {
      var search = this.value;
      $.ajax({
        type: "POST",
        dataType: "json",
        url: plugin_admin_data.admin_ajax_url,
        data: {
          action: "applicant_form_search",
          search: search,
          nonce: plugin_admin_data.admin_nonce,
        },
        success: function (response) {
          $("#submit").prop("disabled", false);
          $("table.result tbody").html(" ");
          $("table.result tbody").html(response.data);
        },
        error: function () {
          alert("error");
        },
      });
    });
    $(".delete").on("click", function () {
      var id = $(this).attr("href");
      var itemId = id.substring(1, id.length);
      Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
      }).then((result) => {
        if (result.isConfirmed) {
			$.ajax({
				type: "POST",
				dataType: "json",
				url: plugin_admin_data.admin_ajax_url,
				data: {
				action: "applicant_form_delete",
				id: itemId,
				nonce: plugin_admin_data.admin_nonce,
				},
				success: function (response) {
				$("#submit").prop("disabled", false);
				$("table.result tbody").html(" ");
				$("table.result tbody").html(response.data);
				setTimeout(function () {
					location.reload(true);
				  }, 1000);
			
				},
				error: function () {
				alert("error");
				},
			});
        }
      });
    });
  });
})(jQuery);
