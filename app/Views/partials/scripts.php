<!-- Bootstrap core JavaScript -->
<link rel="stylesheet" href="<?= base_url('assets/blueline/js/bootstrap.min.js') ?>">
<!-- Combined JavaScript at the End of Body -->

<!-- Font Awesome -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/js/all.min.js"></script>

<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script
    src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/3.4.0/js/bootstrap-colorpicker.min.js"></script>

<script type="text/javascript"
    src="<?= base_url() ?>assets/blueline/js/plugins/jquery-labelauty.js?ver=<?= $view_data['core_settings']['version']; ?>"></script>
<!-- jQuery Knob -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-knob/1.2.13/jquery.knob.min.js"></script>

<!-- Chosen (jQuery plugin for select boxes) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js"></script>

<!-- jqBootstrapValidation -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqBootstrapValidation/1.3.7/jqBootstrapValidation.min.js"></script>

<!-- NProgress (Progress Bar) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/nprogress/0.2.0/nprogress.min.js"></script>

<!-- Validator.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.9/validator.min.js"></script>

<!-- Timer (jQuery Timer) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/timer.jquery/1.0.1/timer.jquery.min.js"></script>


<!-- Velocity.js (for animations) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/velocity/2.0.6/velocity.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/velocity/2.0.6/velocity.ui.min.js"></script>

<!-- Chart.js -->
<script type="text/javascript"
    src="<?= base_url() ?>assets/blueline/js/plugins/chart.min.js?ver=<?= $view_data['core_settings']['version']; ?>"></script>

<!-- Inputmask Bundle -->
<script type="text/javascript"
    src="<?= base_url() ?>assets/blueline/js/plugins/jquery.inputmask.bundle.min.js?ver=<?= $view_data['core_settings']['version']; ?>"></script>


<!-- jQuery GanttView -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-gantt-view/1.1.0/jquery.ganttView.min.js"></script>

<!-- Dropzone.js (File Upload) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.js"></script>

<!-- Flatpickr (Date Picker) -->
<script type="text/javascript"
    src="<?= base_url() ?>assets/blueline/js/plugins/flatpickr.min.js?ver=<?= $view_data['core_settings']['version']; ?>"></script>

<!-- Bootstrap Editable (for inline editing) -->
<script
    src="https://cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.1/bootstrap-editable/js/bootstrap-editable.min.js"></script>

<!-- Blazy.js (Lazy Loading) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/blazy/1.8.2/blazy.min.js"></script>

<script src="<?= base_url() ?>assets/blueline/css/super-panel.js"></script>
<script src="<?= base_url() ?>assets/blueline/css/accordion-menu.js"></script>
<script src="<?= base_url() ?>assets/blueline/js/message.js"></script>

<!-- Plugins -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/velocity/2.0.6/velocity.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/velocity/2.0.6/velocity.ui.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

<script type="text/javascript"
    src="<?= base_url() ?>assets/blueline/js/plugins/countUp.min.js?ver=<?= $view_data['core_settings']['version']; ?>"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/blazy/1.8.2/blazy.min.js"></script>

<script type="text/javascript"
    src="<?= base_url() ?>assets/blueline/js/plugins/jquery.easypiechart.min.js?ver=<?= $view_data['core_settings']['version']; ?>"></script>
<script type="text/javascript"
    src="<?= base_url() ?>assets/blueline/js/plugins/jquery.nanoscroller.min.js?ver=<?= $view_data['core_settings']['version']; ?>"></script>

<script type="text/javascript"
    src="<?= base_url() ?>assets/blueline/js/plugins/moment-with-locales.min.js?ver=<?= $view_data['core_settings']['version']; ?>"></script>
<!-- FullCalendar JavaScript -->
<script type="text/javascript"
    src="<?= base_url() ?>assets/blueline/js/plugins/fullcalendar/fullcalendar.min.js?ver=<?= $view_data['core_settings']['version']; ?>"></script>
<script type="text/javascript"
    src="<?= base_url() ?>assets/blueline/js/plugins/fullcalendar/gcal.js?ver=<?= $view_data['core_settings']['version']; ?>"></script>
<script type="text/javascript"
    src="<?= base_url() ?>assets/blueline/js/plugins/fullcalendar/lang-all.js?ver=<?= $view_data['core_settings']['version']; ?>"></script>


<!--<script type="text/javascript" src="<?= base_url() ?>assets/blueline/js/plugins/jquery.sparkline.min.js?ver=<?= $view_data['core_settings']['version']; ?>"></script> -->

<!-- Blueline Js -->
<script type="text/javascript" src="<?= base_url() ?>assets/blueline/js/blueline.js"></script>


<script type="text/javascript" charset="utf-8">

    function afficheMenu(obj) {

        var idMenu = obj.id;
        var idSousMenu = 'sous' + idMenu;
        var sousMenu = document.getElementById(idSousMenu);
        for (var i = 1; i <= 4; i++) {
            if (document.getElementById('sousmenu' + i) && document.getElementById('sousmenu' + i) != sousMenu) {
                document.getElementById('sousmenu' + i).style.display = "none";

            }
        }
        if (sousMenu) {
            if (sousMenu.style.display == "block") {
                sousMenu.style.display = "none";
            } else {
                sousMenu.style.display = "block";
            }
        }

    }

    function flatdatepicker(activeform) {

        flatpickr.init.prototype.defaultConfig.prevArrow = "<i class='ion-chevron-left'></i>";
        flatpickr.init.prototype.defaultConfig.nextArrow = "<i class='ion-chevron-right'></i>";
        var required = "required";
        if (!$('.datepicker').hasClass("required")) {
            required = "";
        }

        var datepicker = flatpickr('.datepicker', {
            dateFormat: 'Y-m-d',
            timeFormat: '<?= $view_data['timeformat']; ?>',
            time_24hr: <?= $view_data['time24hours']; ?>,
            altInput: true,
            static: true,
            altFormat: '<?= $view_data['dateformat'] ?>',
            altInputClass: 'form-control ' + required,
            onChange: function (d) {
                if (activeform && !$(".datepicker").hasClass("not-required")) {
                    activeform.validator('validate');
                }
                if ($(".datepicker-linked")[0]) {
                    datepickerLinked.calendars[0].set("minDate", d.fp_incr(0));
                }
            }
        });
        var required = "required";
        if ($(".datepicker-time").hasClass("not-required")) {
            required = "";
        }
        var datepicker = flatpickr('.datepicker-time', {
            //dateFormat: 'U',
            timeFormat: '<?= $view_data['timeformat']; ?>',
            time_24hr: <?= $view_data['time24hours']; ?>,
            altInput: true,
            static: true,
            altFormat: '<?= $view_data['dateformat'] ?> <?= $view_data['timeformat']; ?>',
            onChange: function (d) {
                if (activeform && !$(".datepicker").hasClass("not-required")) {
                    activeform.validator('validate');
                }
                if ($(".datepicker-linked")[0]) {
                    datepickerLinked.calendars[0].set("minDate", d.fp_incr(0));
                }
            }
        });
        if ($(".datepicker-linked").hasClass("not-required")) {
            var required = "";
        } else {
            var required = "required";
        }
        var datepickerLinked = flatpickr('.datepicker-linked', {
            dateFormat: 'Y-m-d',
            timeFormat: '<?= $view_data['timeformat']; ?>',
            time_24hr: <?= $view_data['time24hours']; ?>,
            altInput: true,
            altFormat: '<?= $view_data['dateformat'] ?>',
            static: true,
            altInputClass: 'form-control ' + required,
            onChange: function (d) {
                if (activeform && !$(".datepicker-linked").hasClass("not-required")) {
                    activeform.validator('validate');
                }
            }
        });
        //set dummyfields to be required
        $(".required").attr('required', 'required');

    }

    flatdatepicker();

    $(document).ready(function () {
        sorting_list("<?= base_url(); ?>");
        $("form").validator();

        $("#menu li a, .submenu li a").removeClass("active");
        if ("" == "<?php echo $view_data['act_uri_submenu']; ?>") {
            $("#sidebar li a").first().addClass("active");
        }
        <?php if ($view_data['act_uri_submenu'] != "0") { ?>$(".submenu li a#<?php echo $view_data['act_uri_submenu']; ?>").parent().addClass("active"); <?php } ?>
        $("#menu li#<?php echo $view_data['act_uri']; ?>").addClass("active");

        //Datatables

        var dontSort = [];
        $('.data-sorting thead th').each(function () {
            if ($(this).hasClass('no_sort')) {
                dontSort.push({ "bSortable": false });
            } else {
                dontSort.push(null);
            }
        });


        $('table.data').dataTable({
            "initComplete": function () {
                var api = this.api();
                api.$('td.add-to-search').click(function () {
                    api.search($(this).data("tdvalue")).draw();
                });
            },
            "iDisplayLength": 20,
            stateSave: true,
            "bLengthChange": false,
            "aaSorting": [[0, 'desc']],
            "oLanguage": {
                "sSearch": "",
                "sInfo": "<?= lang('application.application_showing_from_to'); ?>",
                "sInfoEmpty": "<?= lang('application.application_showing_from_to_empty'); ?>",
                "sEmptyTable": "<?= lang('application.application_no_data_yet'); ?>",
                "oPaginate": {
                    "sNext": '<i class="fa fa-arrow-right"></i>',
                    "sPrevious": '<i class="fa fa-arrow-left"></i>',
                }
            }
        });


        $('table.data-media').dataTable({
            "iDisplayLength": 15,
            stateSave: true,
            "bLengthChange": false,
            "bFilter": false,
            "bInfo": false,
            "aaSorting": [[0, 'desc']],
            "oLanguage": {
                "sSearch": "",
                "sInfo": "<?= lang('application.application_showing_from_to'); ?>",
                "sInfoEmpty": "<?= lang('application.application_showing_from_to_empty'); ?>",
                "sEmptyTable": " ",
                "oPaginate": {
                    "sNext": '<i class="fa fa-arrow-right"></i>',
                    "sPrevious": '<i class="fa fa-arrow-left"></i>',
                }
            }
        });
        $('table.data-no-search').dataTable({
            "iDisplayLength": 8,
            stateSave: true,
            "bLengthChange": false,
            "bFilter": false,
            "bInfo": false,
            "aaSorting": [[1, 'desc']],
            "oLanguage": {
                "sSearch": "",
                "sInfo": "<?= lang('application.application_showing_from_to'); ?>",
                "sInfoEmpty": "<?= lang('application.application_showing_from_to_empty'); ?>",
                "sEmptyTable": " ",
                "oPaginate": {
                    "sNext": '<i class="fa fa-arrow-right"></i>',
                    "sPrevious": '<i class="fa fa-arrow-left"></i>',
                }
            },
            fnDrawCallback: function (settings) {
                $(this).parent().toggle(settings.fnRecordsDisplay() > 0);
                if (settings._iDisplayLength > settings.fnRecordsDisplay()) {
                    $(settings.nTableWrapper).find('.dataTables_paginate').hide();
                }

            }

        });
        $('table.data-sorting').dataTable({
            "iDisplayLength": 20,
            "bLengthChange": false,
            "aoColumns": dontSort,
            "aaSorting": [[1, 'desc']],
            "oLanguage": {
                "sSearch": "",
                "sInfo": "<?= lang('application.application_showing_from_to'); ?>",
                "sInfoEmpty": "<?= lang('application.application_showing_from_to_empty'); ?>",
                "sEmptyTable": "<?= lang('application.application_no_data_yet'); ?>",
                "oPaginate": {
                    "sNext": '<i class="fa fa-arrow-right"></i>',
                    "sPrevious": '<i class="fa fa-arrow-left"></i>',
                }
            }
        });
        $('table.data-small').dataTable({
            "iDisplayLength": 5,
            "bLengthChange": false,
            "aaSorting": [[2, 'desc']],
            "oLanguage": {
                "sSearch": "",
                "sInfo": "<?= lang('application.application_showing_from_to'); ?>",
                "sInfoEmpty": "<?= lang('application.application_showing_from_to_empty'); ?>",
                "sEmptyTable": "<?= lang('application.application_no_data_yet'); ?>",
                "oPaginate": {
                    "sNext": '<i class="fa fa-arrow-right"></i>',
                    "sPrevious": '<i class="fa fa-arrow-left"></i>',
                }
            }
        });

        $('table.data-articles').dataTable({
            "iDisplayLength": 10,
            "bLengthChange": false,
            "aaSorting": [[4, 'asc']],
            "oLanguage": {
                "sSearch": "",
                "sInfo": "<?= lang('application.application_showing_from_to'); ?>",
                "sInfoEmpty": "<?= lang('application.application_showing_from_to_empty'); ?>",
                "sEmptyTable": "<?= lang('application.application_no_data_yet'); ?>",
                "oPaginate": {
                    "sNext": '<i class="fa fa-arrow-right"></i>',
                    "sPrevious": '<i class="fa fa-arrow-left"></i>',
                }
            }
        });
        $('table.data-devFact').dataTable({
            "iDisplayLength": 10,
            "bLengthChange": false,
            "aaSorting": [[1, 'desc']],
            "oLanguage": {
                "sSearch": "",
                "sInfo": "<?= lang('application.application_showing_from_to'); ?>",
                "sInfoEmpty": "<?= lang('application.application_showing_from_to_empty'); ?>",
                "sEmptyTable": "<?= lang('application.application_no_data_yet'); ?>",
                "oPaginate": {
                    "sNext": '<i class="fa fa-arrow-right"></i>',
                    "sPrevious": '<i class="fa fa-arrow-left"></i>',
                }
            }
        });

        $('table.data-reports').dataTable({
            "iDisplayLength": 30,
            colReorder: true,
            buttons: [
                'copyHtml5',
                'excelHtml5',
                'csvHtml5',
                'pdfHtml5'
            ],

            "bLengthChange": false,
            "order": [[1, 'desc']],
            "columnDefs": [
                { "orderable": false, "targets": 0 }
            ],
            "oLanguage": {
                "sSearch": "",
                "sInfo": "<?= lang('application.application_showing_from_to'); ?>",
                "sInfoEmpty": "<?= lang('application.application_showing_from_to_empty'); ?>",
                "sEmptyTable": "<?= lang('application.application_no_data_yet'); ?>",
                "oPaginate": {
                    "sNext": '<i class="fa fa-arrow-right"></i>',
                    "sPrevious": '<i class="fa fa-arrow-left"></i>',
                }
            }
        });

    });


</script>
<script>
    function validate() {
        if (document.getElementById('company').checked) {
            $("div.clientPersistant").hide();
            $("div.nomClient").show();
            document.getElementById("nomClient").required = true;
            $("div.timbre_fiscal").show();
            $("div.tva").show();
            $("div.guarantee").show();
            document.getElementById("addproject").className = "btn btn-primary tt addprojectClient";
            $('input[type=submit]').prop('disabled', false);
        } else {
            $("div.clientPersistant").show();
            $("div.nomClient").hide();
            $("div.timbre_fiscal").hide();
            $("div.tva").hide();
            $("div.guarantee").hide();
            document.getElementById("addproject").className = "btn btn-primary tt addproject";
        }
    }

</script>

<script>
    $('table.dataSorting').dataTable({
        "lengthMenu": [[20, 50, 100, -1], [20, 50, 100, "Tous"]],
        "aaSorting": [[1, 'desc']],
        "language": {
            "lengthMenu": "Affichage _MENU_ elements par page",
            "sSearch": "<?= lang('application.application_search'); ?>",
            "sInfo": "<?= lang('application.application_showing_from_to'); ?>",
            "sInfoEmpty": "<?= lang('application.application_showing_from_to_empty'); ?>",
            "sEmptyTable": "<?= lang('application.application_no_data_yet'); ?>",
            "oPaginate": {
                "sNext": '<i class="fa fa-arrow-right"></i>',
                "sPrevious": '<i class="fa fa-arrow-left"></i>',
            }
        }
    });

</script>

<script>


    function loadContactForm() {
        $(document).ready(function () {
            $('#contact_form').bootstrapValidator({
                // To use feedback icons, ensure that you use Bootstrap v3.1.0 or later
                feedbackIcons: {
                    valid: 'glyphicon glyphicon-ok',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                },
                fields: {

                    email: {
                        validators: {
                            notEmpty: {
                                message: 'Please supply your email address'
                            },
                            emailAddress: {
                                message: 'Please supply a valid email address'
                            }
                        }
                    },
                    phone: {
                        validators: {
                            notEmpty: {
                                message: 'Please supply your phone number'
                            },
                            phone: {
                                country: 'US',
                                message: 'Please supply a vaild phone number with area code'
                            }
                        }
                    },
                    comment: {
                        validators: {
                            stringLength: {
                                min: 10,
                                max: 200,
                                message: 'Please enter at least 10 characters and no more than 200'
                            },
                            notEmpty: {
                                message: 'Please supply a description of your project'
                            }
                        }
                    }
                }
            })
                .on('success.form.bv', function (e) {
                    $('#success_message').slideDown({ opacity: "show" }, "slow") // Do something ...
                    $('#contact_form').data('bootstrapValidator').resetForm();

                    // Prevent form submission
                    e.preventDefault();

                    // Get the form instance
                    var $form = $(e.target);

                    // Get the BootstrapValidator instance
                    var bv = $form.data('bootstrapValidator');

                    // Use Ajax to submit form data
                    $.post($form.attr('action'), $form.serialize(), function (result) {
                        console.log(result);
                    }, 'json');
                });
        });


    }
    function myFunction() {

        <?php if ($view_data['act_uri'] == 'forgotpass') { ?>
            $(".forgot-password").hide();
            $(".sidebar-bg").hide();
            $(".main-footer").hide();
            $(".mainnavbar").hide();
            $("body").css("background-image", "url('<?php echo base_url() ?>assets/blueline/images/backgrounds/field.jpg')");


        <?php } ?>


        var countTicket = document.getElementById('countTickets');
        if (typeof (countTicket) != 'undefined' && countTicket != null) {
            var url = "<?= base_url() ?>" + ('dashboard/CountItem/');
            $.ajax({
                type: 'POST',
                dataType: "text",
                url: url,
                success: function (response) {
                    if (response != "false") {
                        countTicket.textContent = response;
                    } else {
                        countTicket.textContent = "0";
                    }
                }
            });
        }
        var countMessages = document.getElementById('countMessages');
        if (typeof (countMessages) != 'undefined' && countMessages != null) {
            var url = "<?= base_url() ?>" + ('dashboard/CountMessage/');
            $.ajax({
                type: 'POST',
                dataType: "text",
                url: url,
                success: function (response) {
                    if (response != "false") {
                        countMessages.textContent = response;
                    } else {
                        countMessages.textContent = "0";
                    }
                }
            });
        }
    }

</script>