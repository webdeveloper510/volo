"use strict";

$(document).on("click", ".local_calender .fc-daygrid-event", function (e) {
    // if (!$(this).hasClass('project')) {
    e.preventDefault();
    var event = $(this);
    var title = $(this).find(".fc-event-title").html();
    var size = "md";
    var url = $(this).attr("href");
    $("#commonModal .modal-title").html(title);
    $("#commonModal .modal-dialog").addClass("modal-" + size);

    $.ajax({
        url: url,
        success: function (data) {
            $("#commonModal .modal-body").html(data);
            $("#commonModal").modal("show");
        },
        error: function (data) {
            data = data.responseJSON;
            toastrs("Error", data.error, "error");
        },
    });
    // }
});

select2();

$(document).ready(function () {
    // $('.list-group-item').on('click', function () {
    //     var href = $(this).attr('data-href');
    //     // console.log(href);
    //     $('.tabs-card').addClass('d-none');
    //     $(href).removeClass('d-none');
    //     $('#tabs .list-group-item').removeClass('text-primary');
    //     $(this).addClass('text-primary');
    // });

    $(document).ready(function () {
        $(".custom-list-group-item").on("click", function () {
            var href = $(this).attr("data-href");
            $(".tabs-card").addClass("d-none");
            $(href).removeClass("d-none");
            $("#tabs .custom-list-group-item").removeClass("text-primary");
            $(this).addClass("text-primary");
        });
    });
    $(function () {
        // $(document).on("click", ".show_confirm", function () {
        $(".show_confirm").click(function (event) {
            event.preventDefault();
            var parentTR = $(this).closest("tr");
            // var form = $(this).closest("form");
            var url = $(this).data("url");
            var token = $(this).data("token");
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: "btn btn-success",
                    cancelButton: "btn btn-danger",
                },
                buttonsStyling: false,
            });
            swalWithBootstrapButtons
                .fire({
                    title: "Are you sure?",
                    text: "This action can not be undone. Do you want to continue?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Yes",
                    cancelButtonText: "No",
                    reverseButtons: true,
                })
                .then((result) => {
                    if (result.isConfirmed) {
                        // form.submit();
                        $.ajax({
                            type: "DELETE",
                            url: url,
                            data: {
                                _token: token,
                            },
                            success: function (result) {
                                console.log(result);
                                console.log(result.msg);
                                console.log(`new log`);
                                if (result.success == true) {
                                    swal.fire("Done!", result.msg, "success");
                                    parentTR.remove();
                                } else {
                                    swal.fire("Error!", result.msg, "error");
                                }
                            },
                        });
                    }
                });
        });
    });
    $(".event_show_confirm").click(function (event) {
        event.preventDefault();
        var parentSpan = $(this).closest("span.badge");
        var url = $(this).data("url");
        var badgeContainer = $(this).closest(".badge");
        var badgeText = badgeContainer.text().trim();
        var token = $(this).data("token");
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: "btn btn-success",
                cancelButton: "btn btn-danger",
            },
            buttonsStyling: false,
        });
        swalWithBootstrapButtons
            .fire({
                title: "Are you sure?",
                text: "This action can not be undone. Do you want to continue?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes",
                cancelButtonText: "No",
                reverseButtons: true,
            })
            .then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: {
                            badge: badgeText,
                            _token: token,
                        },
                        success: function (result) {
                            // console.log(result);
                            if (result == true) {
                                swal.fire("Done!", result.message, "success");
                                // setTimeout(function(){
                                // },1000);
                                parentSpan.remove();
                            } else {
                                swal.fire("Error!", result.message, "error");
                            }
                        },
                    });
                }
            });
    });
    $(".venue_show_confirm").click(function (event) {
        event.preventDefault();
        var parentSpan = $(this).closest("span.badge");
        var url = $(this).data("url");
        var badgeContainer = $(this).closest(".badge");
        var badgeText = badgeContainer.text().trim();
        var token = $(this).data("token");
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: "btn btn-success",
                cancelButton: "btn btn-danger",
            },
            buttonsStyling: false,
        });
        swalWithBootstrapButtons
            .fire({
                title: "Are you sure?",
                text: "This action can not be undone. Do you want to continue?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes",
                cancelButtonText: "No",
                reverseButtons: true,
            })
            .then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: {
                            badge: badgeText,
                            _token: token,
                        },
                        success: function (result) {
                            // console.log(result);
                            if (result == true) {
                                swal.fire("Done!", result.message, "success");
                                parentSpan.hide();
                            } else {
                                swal.fire("Error!", result.message, "error");
                            }
                        },
                    });
                }
            });
    });
    $(".function_package_show_confirm").click(function (event) {
        event.preventDefault();
        var parentSpan = $(this).closest("span.badge");
        var url = $(this).data("url");
        var val = $(this).data("id");
        var badgeContainer = $(this).closest(".badge");
        var badgeText = badgeContainer.text().trim();
        var token = $(this).data("token");
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: "btn btn-success",
                cancelButton: "btn btn-danger",
            },
            buttonsStyling: false,
        });
        swalWithBootstrapButtons
            .fire({
                title: "Are you sure?",
                text: "This action can not be undone. Do you want to continue?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes",
                cancelButtonText: "No",
                reverseButtons: true,
            })
            .then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: {
                            badge: badgeText,
                            value: val,
                            _token: token,
                        },
                        success: function (result) {
                            // console.log(result);
                            if (result == true) {
                                swal.fire("Done!", result.message, "success");
                                parentSpan.hide();
                            } else {
                                swal.fire("Error!", result.message, "error");
                            }
                        },
                    });
                }
            });
    });
    $(".function_show_confirm").click(function (event) {
        event.preventDefault();
        var parentSpan = $(this).closest("li.badge");
        var url = $(this).data("url");
        var val = $(this).data("id");
        var badgeContainer = $(this).closest(".badge");
        var badgeText = badgeContainer.text().trim();
        var token = $(this).data("token");
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: "btn btn-success",
                cancelButton: "btn btn-danger",
            },
            buttonsStyling: false,
        });
        swalWithBootstrapButtons
            .fire({
                title: "Are you sure?",
                text: "This action can not be undone. Do you want to continue?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes",
                cancelButtonText: "No",
                reverseButtons: true,
            })
            .then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: {
                            badge: badgeText,
                            value: val,
                            _token: token,
                        },
                        success: function (result) {
                            if (result == true) {
                                swal.fire("Done!", result.message, "success");
                                parentSpan.hide();
                            } else {
                                swal.fire("Error!", result.message, "error");
                            }
                        },
                    });
                }
            });
    });
    $(".bar_show_confirm").click(function (event) {
        event.preventDefault();
        var parentSpan = $(this).closest("li.badge");
        var url = $(this).data("url");
        var val = $(this).data("id");
        var badgeContainer = $(this).closest(".badge");
        var badgeText = badgeContainer.text().trim();
        var token = $(this).data("token");
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: "btn btn-success",
                cancelButton: "btn btn-danger",
            },
            buttonsStyling: false,
        });
        swalWithBootstrapButtons
            .fire({
                title: "Are you sure?",
                text: "This action can not be undone. Do you want to continue?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes",
                cancelButtonText: "No",
                reverseButtons: true,
            })
            .then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: {
                            badge: badgeText,
                            value: val,
                            _token: token,
                        },
                        success: function (result) {
                            // console.log(result);
                            if (result == true) {
                                swal.fire("Done!", result.message, "success");
                                parentSpan.hide();
                            } else {
                                swal.fire("Error!", result.message, "error");
                            }
                        },
                    });
                }
            });
    });
    $(".bar_package_show_confirm").click(function (event) {
        event.preventDefault();
        var parentSpan = $(this).closest("span.badge");
        var url = $(this).data("url");
        var val = $(this).data("id");
        var badgeContainer = $(this).closest(".badge");
        var badgeText = badgeContainer.text().trim();
        var token = $(this).data("token");
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: "btn btn-success",
                cancelButton: "btn btn-danger",
            },
            buttonsStyling: false,
        });
        swalWithBootstrapButtons
            .fire({
                title: "Are you sure?",
                text: "This action can not be undone. Do you want to continue?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes",
                cancelButtonText: "No",
                reverseButtons: true,
            })
            .then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: {
                            badge: badgeText,
                            value: val,
                            _token: token,
                        },
                        success: function (result) {
                            // console.log(result);
                            if (result == true) {
                                swal.fire("Done!", result.message, "success");
                                parentSpan.hide();
                            } else {
                                swal.fire("Error!", result.message, "error");
                            }
                        },
                    });
                }
            });
    });
    $(function () {
        $(document).on("click", ".duplicate_confirm", function () {
            var form = $(this).closest("form");
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: "btn btn-success",
                    cancelButton: "btn btn-danger",
                },
                buttonsStyling: false,
            });
            swalWithBootstrapButtons
                .fire({
                    title: "You want to confirm this action",
                    text: "Press Yes to continue or No to go back",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Yes",
                    cancelButtonText: "No",
                    reverseButtons: true,
                })
                .then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
        });
    });
    $(".campaign_show_confirm").click(function (event) {
        event.preventDefault();
        var parentSpan = $(this).closest("span.badge");
        var url = $(this).data("url");
        var badgeContainer = $(this).closest(".badge");
        var badgeText = badgeContainer.text().trim();
        var token = $(this).data("token");
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: "btn btn-success",
                cancelButton: "btn btn-danger",
            },
            buttonsStyling: false,
        });
        swalWithBootstrapButtons
            .fire({
                title: "Are you sure?",
                text: "This action can not be undone. Do you want to continue?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes",
                cancelButtonText: "No",
                reverseButtons: true,
            })
            .then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: {
                            badge: badgeText,
                            _token: token,
                        },
                        success: function (result) {
                            // console.log(result);
                            if (result == true) {
                                swal.fire("Done!", result.message, "success");
                                parentSpan.hide();
                            } else {
                                swal.fire("Error!", result.message, "error");
                            }
                        },
                    });
                }
            });
    });
    $(function () {
        $(document).on("click", ".convert_confirm", function () {
            var form = $(this).closest("form");
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: "btn btn-success",
                    cancelButton: "btn btn-danger",
                },
                buttonsStyling: false,
            });
            swalWithBootstrapButtons
                .fire({
                    title: "You want to confirm convert to sales order.",
                    text: "Press Yes to continue or No to go back",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Yes",
                    cancelButtonText: "No",
                    reverseButtons: true,
                })
                .then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
        });
    });
    $(".additional_show_confirm").click(function (event) {
        event.preventDefault();

        // Get the value of the data-function attribute
        var functionval = $(this).data("function");
        var packageval = $(this).data("package");
        var itemval = $(this).data("item");
        var url = $(this).data("url");
        var token = $(this).data("token");
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: "btn btn-success",
                cancelButton: "btn btn-danger",
            },
            buttonsStyling: false,
        });
        swalWithBootstrapButtons
            .fire({
                title: "Are you sure?",
                text: "This action can not be undone. Do you want to continue?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes",
                cancelButtonText: "No",
                reverseButtons: true,
            })
            .then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: {
                            functionval: functionval,
                            packageval: packageval,
                            itemval: itemval,
                            _token: token,
                        },
                        success: function (result) {
                            if (result == true) {
                                swal.fire("Done!", result.message, "success");
                                setTimeout(function () {
                                    location.reload();
                                }, 1000);
                            } else {
                                swal.fire("Error!", result.message, "error");
                            }
                        },
                    });
                }
            });
    });
    $(document).ready(function () {
        // $('#myTable').DataTable();
        if ($("#myTable").length > 0) {
            $("#myTable").dataTable({
                language: dataTabelLang,
            });
        }
        if ($(".dataTable").length > 0) {
            $(".dataTable").dataTable({
                language: dataTabelLang,
            });
        }

        if ($(".datepicker").length) {
            $(".datepicker").daterangepicker({
                singleDatePicker: true,
                format: "yyyy-mm-dd",
                locale: date_picker_locale,
            });
        }
    });

    select2();
    var Select = (function () {
        var e = $('[data-toggle="select"]');
        e.length &&
            e.each(function () {
                $(this).select2({
                    minimumResultsForSearch: -1,
                });
            });
    })();
});

function select2() {
    if ($(".select2").length > 0) {
        $($(".select2")).each(function (index, element) {
            var id = $(element).attr("id");
            var multipleCancelButton = new Choices("#" + id, {
                removeItemButton: true,
            });
        });
    }
}

$(document).on(
    "click",
    'a[data-ajax-popup="true"], button[data-ajax-popup="true"], div[data-ajax-popup="true"]',
    function () {
        var title = $(this).data("title");
        var size = $(this).data("size") == "" ? "md" : $(this).data("size");
        var url = $(this).data("url");
        $("#commonModal .modal-title").html(title);
        $("#commonModal .modal-dialog").addClass("modal-" + size);
        $.ajax({
            url: url,
            success: function (data) {
                $("#commonModal .modal-body").html(data);
                $("#commonModal").modal("show");
                taskCheckbox();
                // common_bind("#commonModal");
                // common_bind_select("#commonModal");
                select2();
            },
            error: function (data) {
                data = data.responseJSON;
                // console.log(data.error);
                show_toastr("Error", data.error, "error");
            },
        });
    }
);
function arrayToJson(form) {
    var data = $(form).serializeArray();
    var indexed_array = {};

    $.map(data, function (n, i) {
        indexed_array[n["name"]] = n["value"];
    });

    return indexed_array;
}

$(document).on("submit", "#commonModalOver form", function (e) {
    e.preventDefault();
    var data = arrayToJson($(this));
    data.ajax = true;

    var url = $(this).attr("action");
    $.ajax({
        url: url,
        data: data,
        type: "POST",
        success: function (data) {
            show_toastr("Success", data.success, "success");
            $(data.target).append(
                '<option value="' +
                    data.record.id +
                    '">' +
                    data.record.name +
                    "</option>"
            );
            $(data.target).val(data.record.id);
            $(data.target).trigger("change");
            $("#commonModalOver").modal("hide");

            $(".selectric").selectric({
                disableOnMobile: false,
                nativeOnMobile: false,
            });
        },
        error: function (data) {
            data = data.responseJSON;
            show_toastr("Error", data.error, "error");
        },
    });
});

function common_bind(selector = "body") {
    var $datepicker = $(selector + " .datepicker");
    if ($(".datepicker").length) {
        $(".datepicker").daterangepicker({
            singleDatePicker: true,
            format: "yyyy-mm-dd",
            locale: date_picker_locale,
        });
    }
    if ($(".custom-datepicker").length) {
        $(".custom-datepicker").daterangepicker({
            singleDatePicker: true,
            format: "Y-MM",
            locale: {
                format: "Y-MM",
            },
        });
    }
}

function common_bind_select(selector = "body") {
    if (jQuery().selectric) {
        $(".selectric").selectric({
            disableOnMobile: false,
            nativeOnMobile: false,
        });
    }
    if ($(".jscolor").length) {
        jscolor.installByClassName("jscolor");
    }

    var Select = (function () {
        var e = $('[data-toggle="select"]');
        e.length &&
            e.each(function () {
                $(this).select2({
                    minimumResultsForSearch: -1,
                });
            });
    })();
}

function common_bind_confirmation() {
    $("[data-confirm]").each(function () {
        var me = $(this),
            me_data = me.data("confirm");

        me_data = me_data.split("|");
        me.fireModal({
            title: me_data[0],
            body: me_data[1],
            buttons: [
                {
                    text: me.data("confirm-text-yes") || "Yes",
                    class: "btn btn-danger btn-shadow",
                    handler: function () {
                        eval(me.data("confirm-yes"));
                    },
                },
                {
                    text: me.data("confirm-text-cancel") || "Cancel",
                    class: "btn btn-secondary",
                    handler: function (modal) {
                        $.destroyModal(modal);
                        eval(me.data("confirm-no"));
                    },
                },
            ],
        });
    });
}

function taskCheckbox() {
    var checked = 0;
    var count = 0;
    var percentage = 0;

    count = $("#check-list input[type=checkbox]").length;
    checked = $("#check-list input[type=checkbox]:checked").length;
    percentage = parseInt((checked / count) * 100, 10);
    if (isNaN(percentage)) {
        percentage = 0;
    }
    $(".custom-label").text(percentage + "%");
    $("#taskProgress").css("width", percentage + "%");

    $("#taskProgress").removeClass("bg-warning");
    $("#taskProgress").removeClass("bg-primary");
    $("#taskProgress").removeClass("bg-success");
    $("#taskProgress").removeClass("bg-danger");

    if (percentage <= 15) {
        $("#taskProgress").addClass("bg-danger");
    } else if (percentage > 15 && percentage <= 33) {
        $("#taskProgress").addClass("bg-warning");
    } else if (percentage > 33 && percentage <= 70) {
        $("#taskProgress").addClass("bg-primary");
    } else {
        $("#taskProgress").addClass("bg-success");
    }
}

(function ($, window, i) {
    // Bootstrap 4 Modal
    $.fn.fireModal = function (options) {
        var options = $.extend(
            {
                size: "modal-md",
                center: false,
                animation: true,
                title: "Modal Title",
                closeButton: true,
                header: true,
                bodyClass: "",
                footerClass: "",
                body: "",
                buttons: [],
                autoFocus: true,
                created: function () {},
                appended: function () {},
                onFormSubmit: function () {},
                modal: {},
            },
            options
        );

        this.each(function () {
            i++;
            var id = "fire-modal-" + i,
                trigger_class = "trigger--" + id,
                trigger_button = $("." + trigger_class);

            $(this).addClass(trigger_class);

            // Get modal body
            let body = options.body;

            if (typeof body == "object") {
                if (body.length) {
                    let part = body;
                    body = body
                        .removeAttr("id")
                        .clone()
                        .removeClass("modal-part");
                    part.remove();
                } else {
                    body =
                        '<div class="text-danger">Modal part element not found!</div>';
                }
            }

            // Modal base template
            var modal_template =
                '   <div class="modal' +
                (options.animation == true ? " fade" : "") +
                '" tabindex="-1" role="dialog" id="' +
                id +
                '">  ' +
                '     <div class="modal-dialog ' +
                options.size +
                (options.center ? " modal-dialog-centered" : "") +
                '" role="document">  ' +
                '       <div class="modal-content">  ' +
                (options.header == true
                    ? '         <div class="modal-header">  ' +
                      '           <h5 class="modal-title">' +
                      options.title +
                      "</h5>  " +
                      (options.closeButton == true
                          ? '           <button type="button" class="close" data-dismiss="modal" aria-label="Close">  ' +
                            '             <span aria-hidden="true">&times;</span>  ' +
                            "           </button>  "
                          : "") +
                      "         </div>  "
                    : "") +
                '         <div class="modal-body">  ' +
                "         </div>  " +
                (options.buttons.length > 0
                    ? '         <div class="modal-footer">  ' +
                      "         </div>  "
                    : "") +
                "       </div>  " +
                "     </div>  " +
                "  </div>  ";

            // Convert modal to object
            var modal_template = $(modal_template);

            // Start creating buttons from 'buttons' option
            var this_button;
            options.buttons.forEach(function (item) {
                // get option 'id'
                let id = "id" in item ? item.id : "";

                // Button template
                this_button =
                    '<button type="' +
                    ("submit" in item && item.submit == true
                        ? "submit"
                        : "button") +
                    '" class="' +
                    item.class +
                    '" id="' +
                    id +
                    '">' +
                    item.text +
                    "</button>";

                // add click event to the button
                this_button = $(this_button)
                    .off("click")
                    .on("click", function () {
                        // execute function from 'handler' option
                        item.handler.call(this, modal_template);
                    });
                // append generated buttons to the modal footer
                $(modal_template).find(".modal-footer").append(this_button);
            });

            // append a given body to the modal
            $(modal_template).find(".modal-body").append(body);

            // add additional body class
            if (options.bodyClass)
                $(modal_template)
                    .find(".modal-body")
                    .addClass(options.bodyClass);

            // add footer body class
            if (options.footerClass)
                $(modal_template)
                    .find(".modal-footer")
                    .addClass(options.footerClass);

            // execute 'created' callback
            options.created.call(this, modal_template, options);

            // modal form and submit form button
            let modal_form = $(modal_template).find(".modal-body form"),
                form_submit_btn = modal_template.find("button[type=submit]");

            // append generated modal to the body
            $("body").append(modal_template);

            // execute 'appended' callback
            options.appended.call(this, $("#" + id), modal_form, options);

            // if modal contains form elements
            if (modal_form.length) {
                // if `autoFocus` option is true
                if (options.autoFocus) {
                    // when modal is shown
                    $(modal_template).on("shown.bs.modal", function () {
                        // if type of `autoFocus` option is `boolean`
                        if (typeof options.autoFocus == "boolean")
                            modal_form.find("input:eq(0)").focus();
                        // the first input element will be focused
                        // if type of `autoFocus` option is `string` and `autoFocus` option is an HTML element
                        else if (
                            typeof options.autoFocus == "string" &&
                            modal_form.find(options.autoFocus).length
                        )
                            modal_form.find(options.autoFocus).focus(); // find elements and focus on that
                    });
                }

                // form object
                let form_object = {
                    startProgress: function () {
                        modal_template.addClass("modal-progress");
                    },
                    stopProgress: function () {
                        modal_template.removeClass("modal-progress");
                    },
                };

                // if form is not contains button element
                if (!modal_form.find("button").length)
                    $(modal_form).append(
                        '<button class="d-none" id="' +
                            id +
                            '-submit"></button>'
                    );

                // add click event
                form_submit_btn.on("click", function () {
                    modal_form.submit();
                });

                // add submit event
                modal_form.submit(function (e) {
                    // start form progress
                    form_object.startProgress();

                    // execute `onFormSubmit` callback
                    options.onFormSubmit.call(
                        this,
                        modal_template,
                        e,
                        form_object
                    );
                });
            }

            $(document).on("click", "." + trigger_class, function () {
                $("#" + id).modal("show");

                return false;
            });
        });
    };

    // Bootstrap Modal Destroyer
    $.destroyModal = function (modal) {
        modal.modal("hide");
        modal.on("hidden.bs.modal", function () {});
    };
})(jQuery, this, 0);

var Charts = (function () {
    // Variable

    var $toggle = $('[data-toggle="chart"]');
    var mode = "light"; //(themeMode) ? themeMode : 'light';
    var fonts = {
        base: "Open Sans",
    };

    // Colors
    var colors = {
        gray: {
            100: "#f6f9fc",
            200: "#e9ecef",
            300: "#dee2e6",
            400: "#ced4da",
            500: "#adb5bd",
            600: "#8898aa",
            700: "#525f7f",
            800: "#32325d",
            900: "#212529",
        },
        theme: {
            default: "#172b4d",
            primary: "#5e72e4",
            secondary: "#f4f5f7",
            info: "#11cdef",
            success: "#2dce89",
            danger: "#f5365c",
            warning: "#fb6340",
        },
        black: "#12263F",
        white: "#FFFFFF",
        transparent: "transparent",
    };

    // Methods

    // Chart.js global options
    function chartOptions() {
        // Options
        var options = {
            defaults: {
                global: {
                    responsive: true,
                    maintainAspectRatio: false,
                    defaultColor:
                        mode == "dark" ? colors.gray[700] : colors.gray[600],
                    defaultFontColor:
                        mode == "dark" ? colors.gray[700] : colors.gray[600],
                    defaultFontFamily: fonts.base,
                    defaultFontSize: 13,
                    layout: {
                        padding: 0,
                    },
                    legend: {
                        display: false,
                        position: "bottom",
                        labels: {
                            usePointStyle: true,
                            padding: 16,
                        },
                    },
                    elements: {
                        point: {
                            radius: 0,
                            backgroundColor: colors.theme["primary"],
                        },
                        line: {
                            tension: 0.4,
                            borderWidth: 4,
                            borderColor: colors.theme["primary"],
                            backgroundColor: colors.transparent,
                            borderCapStyle: "rounded",
                        },
                        rectangle: {
                            backgroundColor: colors.theme["warning"],
                        },
                        arc: {
                            backgroundColor: colors.theme["primary"],
                            borderColor:
                                mode == "dark"
                                    ? colors.gray[800]
                                    : colors.white,
                            borderWidth: 4,
                        },
                    },
                    tooltips: {
                        enabled: true,
                        mode: "index",
                        intersect: false,
                    },
                },
                doughnut: {
                    cutoutPercentage: 83,
                    legendCallback: function (chart) {
                        var data = chart.data;
                        var content = "";

                        data.labels.forEach(function (label, index) {
                            var bgColor =
                                data.datasets[0].backgroundColor[index];

                            content += '<span class="chart-legend-item">';
                            content +=
                                '<i class="chart-legend-indicator" style="background-color: ' +
                                bgColor +
                                '"></i>';
                            content += label;
                            content += "</span>";
                        });

                        return content;
                    },
                },
            },
        };

        // yAxes
        Chart.scaleService.updateScaleDefaults("linear", {
            gridLines: {
                borderDash: [2],
                borderDashOffset: [2],
                color: mode == "dark" ? colors.gray[900] : colors.gray[300],
                drawBorder: false,
                drawTicks: false,
                drawOnChartArea: true,
                zeroLineWidth: 0,
                zeroLineColor: "rgba(0,0,0,0)",
                zeroLineBorderDash: [2],
                zeroLineBorderDashOffset: [2],
            },
            ticks: {
                beginAtZero: true,
                padding: 10,
                callback: function (value) {
                    if (!(value % 10)) {
                        return value;
                    }
                },
            },
        });

        // xAxes
        Chart.scaleService.updateScaleDefaults("category", {
            gridLines: {
                drawBorder: false,
                drawOnChartArea: false,
                drawTicks: false,
            },
            ticks: {
                padding: 20,
            },
            maxBarThickness: 10,
        });

        return options;
    }

    // Parse global options
    function parseOptions(parent, options) {
        for (var item in options) {
            if (typeof options[item] !== "object") {
                parent[item] = options[item];
            } else {
                parseOptions(parent[item], options[item]);
            }
        }
    }

    // Push options
    function pushOptions(parent, options) {
        for (var item in options) {
            if (Array.isArray(options[item])) {
                options[item].forEach(function (data) {
                    parent[item].push(data);
                });
            } else {
                pushOptions(parent[item], options[item]);
            }
        }
    }

    // Pop options
    function popOptions(parent, options) {
        for (var item in options) {
            if (Array.isArray(options[item])) {
                options[item].forEach(function (data) {
                    parent[item].pop();
                });
            } else {
                popOptions(parent[item], options[item]);
            }
        }
    }

    // Toggle options
    function toggleOptions(elem) {
        var options = elem.data("add");
        var $target = $(elem.data("target"));
        var $chart = $target.data("chart");

        if (elem.is(":checked")) {
            // Add options
            pushOptions($chart, options);

            // Update chart
            $chart.update();
        } else {
            // Remove options
            popOptions($chart, options);

            // Update chart
            $chart.update();
        }
    }

    // Update options
    function updateOptions(elem) {
        var options = elem.data("update");
        var $target = $(elem.data("target"));
        var $chart = $target.data("chart");

        // Parse options
        parseOptions($chart, options);

        // Toggle ticks
        toggleTicks(elem, $chart);

        // Update chart
        $chart.update();
    }

    // Toggle ticks
    function toggleTicks(elem, $chart) {
        if (
            elem.data("prefix") !== undefined ||
            elem.data("prefix") !== undefined
        ) {
            var prefix = elem.data("prefix") ? elem.data("prefix") : "";
            var suffix = elem.data("suffix") ? elem.data("suffix") : "";

            // Update ticks
            $chart.options.scales.yAxes[0].ticks.callback = function (value) {
                if (!(value % 10)) {
                    return prefix + value + suffix;
                }
            };

            // Update tooltips
            $chart.options.tooltips.callbacks.label = function (item, data) {
                var label = data.datasets[item.datasetIndex].label || "";
                var yLabel = item.yLabel;
                var content = "";

                if (data.datasets.length > 1) {
                    content +=
                        '<span class="popover-body-label mr-auto">' +
                        label +
                        "</span>";
                }

                content +=
                    '<span class="popover-body-value">' +
                    prefix +
                    yLabel +
                    suffix +
                    "</span>";
                return content;
            };
        }
    }

    //chatgpt
    $(document).on(
        "click",
        'a[data-ajax-popup-over="true"], button[data-ajax-popup-over="true"], div[data-ajax-popup-over="true"]',
        function () {
            var validate = $(this).attr("data-validate");
            var id = "";
            if (validate) {
                id = $(validate).val();
            }

            var title = $(this).data("title");
            var size = $(this).data("size") == "" ? "md" : $(this).data("size");
            var url = $(this).data("url");

            $("#commonModalOver .modal-title").html(title);
            $("#commonModalOver .modal-dialog").addClass("modal-" + size);

            $.ajax({
                url: url + "?id=" + id,
                success: function (data) {
                    $("#commonModalOver .modal-body").html(data);
                    $("#commonModalOver").modal("show");
                    taskCheckbox();
                },
                error: function (data) {
                    data = data.responseJSON;
                    show_toastr("Error", data.error, "error");
                },
            });
        }
    );

    // Events

    // Parse global options
    if (window.Chart) {
        parseOptions(Chart, chartOptions());
    }

    // Toggle options
    $toggle.on({
        change: function () {
            var $this = $(this);

            if ($this.is("[data-add]")) {
                toggleOptions($this);
            }
        },
        click: function () {
            var $this = $(this);

            if ($this.is("[data-update]")) {
                updateOptions($this);
            }
        },
    });

    // Return

    return {
        colors: colors,
        fonts: fonts,
        mode: mode,
    };
})();
