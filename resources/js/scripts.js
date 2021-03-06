$(function () {

    // Initialize Select2 Elements
    $(".select2").select2({
        placeholder: function () {
            $(this).data("placeholder");
        }
    });

    // Initialize Select2 Elements
    $(".select2bs4").select2({
        theme: "bootstrap4",
        multiple: true,
        placeholder: function () {
            $(this).data("placeholder");
        }
    });

    $(function () {
        $('[data-toggle="tooltip"]').tooltip();
    })

    //Datemask dd/mm/yyyy
    $("#datemask").inputmask("dd/mm/yyyy", { placeholder: "dd/mm/yyyy" });

    //Datemask2 mm/dd/yyyy
    $("#datemask2").inputmask("mm/dd/yyyy", { placeholder: "mm/dd/yyyy" });

    //Money Euro
    $("[data-mask]").inputmask();

    // Toastr options config.
    toastr.options = {
        closeButton: false,
        debug: false,
        newestOnTop: false,
        progressBar: true,
        positionClass: "toast-top-right",
        preventDuplicates: false,
        onclick: null,
        showDuration: "300",
        hideDuration: "1000",
        timeOut: "2000",
        extendedTimeOut: "1000",
        showEasing: "swing",
        hideEasing: "linear",
        showMethod: "fadeIn",
        hideMethod: "fadeOut"
    };

    $(".dropdown-menu .dropdown-toggle").on("click", function (e) {
        if (
            !$(this)
                .next()
                .hasClass("show")
        ) {
            $(this)
                .parents(".dropdown-menu")
                .first()
                .find(".show")
                .removeClass("show");
        }
        var $subMenu = $(this).next(".dropdown-menu");
        $subMenu.toggleClass("show");

        $(this)
            .parents("li.nav-item.dropdown.show")
            .on("hidden.bs.dropdown", function (e) {
                $(".dropdown-submenu .show").removeClass("show");
            });

        return false;
    });
});

/** GET ALL LISTS TO APPEND SELECT */
function getSelectOptions(url, type, dataType, seletor) {
    return $.ajax({
        url: url,
        type: type,
        dataType: dataType,
        success: function (data) {
            $.each(data, function (i, d) {
                $(seletor).append(
                    '<option value="' + d.id + '">' + d.name + "</option>"
                );
            });
        }
    });
}

/** CLEAN FORM */
function cleanFormDB(selector) {
    document.querySelector(selector).reset();
    $('#name').val("").removeClass('is-invalid');
    $('#username').val("").removeClass('is-invalid');
    $('#email').val("").removeClass('is-invalid');
    $('#password').val("").removeClass('is-invalid');
    $('#content').val("").removeClass('is-invalid');
    $('#start').val("").trigger('change').removeClass('is-invalid');
    $('#type').val("").trigger('change').removeClass('is-invalid');
    $('#select-applications').val("").trigger('change').removeClass('is-invalid');
    $('#select-environments').val("").trigger('change').removeClass('is-invalid');
    $('#select-providers').val("").trigger('change').removeClass('is-invalid');
    $('#select-servers').val("").trigger('change').removeClass('is-invalid');
    $('#select-towers').val("").trigger('change').removeClass('is-invalid');
    $('#select-users').val("").trigger('change').removeClass('is-invalid');
}

/** ADD SPINNER IN BUTTON */
function addSpinner(selector, boolean) {
    $(selector)
        .prepend(`<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span> `)
        .attr("disabled", boolean);
}

/** ADD SPINNER IN BUTTON */
function removeSpinner(selector, text) {
    $(selector).html(text).attr("disabled", false);
}