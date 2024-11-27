<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<<link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid@4.2.0/main.js"></script>
<style>
    html,
    body {
        margin: 0;
        padding: 0;
        font-family: Arial, Helvetica Neue, Helvetica, sans-serif;
        font-size: 14px;
    }

    #calendar {
        max-width: 1100px;
        margin: 40px auto;
    }

    @media (max-width: 767px) {

        /* Adjust calendar styles for screens smaller than 768px width */
        #calendar {
            max-width: 100% !important;
            margin: 10px auto;
        }
    }
</style>




<?php
//  var_dump($view_data['events_list']);
//  die;
?>
<div class="col-sm-12  col-md-12 main">

    <div class="row">
        <!-- <a href="<? //base_url()
                        ?>gestionconge" class="btn btn-primary right" >Liste des congés et absences</a> -->

        <div class="col-sm-3 left">
            <!-- salariés -->
            <div class="form-group">
                <label for="filter"><?= lang('application.applicationsalarie'); ?>(e)</label>
                <select id="filter" class="chosen-select">
                    <option value="all" selected>Tous les salariés</option>
                    <?php foreach ($view_data['salaries'] as $salarie) { ?>
                        <option
                            value="<?= esc($salarie['nom'] . ' ' . $salarie['prenom']) ?>"
                            <?= (isset($item) && $item->id_salarie == $salarie->id) ? 'selected' : '' ?>>
                            <?= esc($salarie['nom'] . ' ' . $salarie['prenom']) ?>
                        </option>
                    <?php } ?>
                </select>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="table-head"><?= lang('application.application_calendar'); ?></div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="table-div table-responsive!important">
            <div id='fullcalendar'></div>
        </div>
    </div>
</div>
<?php

if (cookie('fc2language') != "") {
    $systemlanguage = cookie('fc2language');
} else {
    $systemlanguage = $view_data['core_settings']['language'];
}
switch ($systemlanguage) {
    case "english":
        $lang = "en";
        break;
    case "dutch":
        $lang = "nl";
        break;
    case "french":
        $lang = "fr";
        break;
    case "german":
        $lang = "de";
        break;
    case "italian":
        $lang = "it";
        break;
    case "norwegian":
        $lang = "no";
        break;
    case "polish":
        $lang = "pl";
        break;
    case "portuguese":
        $lang = "pt";
        break;
    case "russian":
        $lang = "ru";
        break;
    case "spanish":
        $lang = "es";
        break;
    default:
        $lang = "fr";
        break;
}


?>
<script type="text/javascript">
document.addEventListener('DOMContentLoaded', function() {
    // Initialize the calendar
    var calendarEl = document.getElementById('fullcalendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        locale: 'en',  // FullCalendar uses 'locale' instead of 'lang'
        nextDayThreshold: '08:00:00',
        headerToolbar: {  // FullCalendar 5+ uses headerToolbar instead of 'header'
            left: 'month,agendaWeek,agendaDay,listMonth,listWeek',
            center: 'title',
            right: 'prev,today,next'
        },
        googleCalendarApiKey: '<?php echo isset($view_data['core_settings']['calendar_google_api_key']) && !empty($view_data['core_settings']['calendar_google_api_key']) ? $view_data['core_settings']['calendar_google_api_key'] : '' ?>',
        weekends: false,
        minTime: "08:00:00",
        maxTime: "19:00:00",
        events: <?php echo $view_data['events_list'] ?? []; ?>,  // Make sure to properly encode the PHP variable
        eventRender: function(info) {
            var filter = document.getElementById('filter').value || 'all';
            var showFilters = filter === 'all' || (info.event.title && info.event.title.toLowerCase().includes(filter.toLowerCase()));
            if (!showFilters) return false;

            info.el.setAttribute('title', info.event.extendedProps.description || '');
            if (info.event.extendedProps.modal === 'true') {
                info.el.setAttribute('data-toggle', "mainmodal");
            }

            if (info.event.extendedProps.description) {
                var tooltip = new bootstrap.Tooltip(info.el, {
                    container: "body",
                    trigger: 'hover',
                    delay: { show: 300, hide: 50 }
                });
            }
        },
        eventClick: function(info) {
            if (info.event.url && info.event.extendedProps.modal === 'true') {
                NProgress.start();
                fetch(info.event.url)
                    .then(response => response.text())
                    .then(data => {
                        var mainModal = document.getElementById('mainModal');
                        mainModal.innerHTML = data;
                        var bootstrapModal = new bootstrap.Modal(mainModal);
                        bootstrapModal.show();
                    })
                    .finally(() => NProgress.done());
            }
            return false;
        }
    });

    calendar.render();

    // Event listener for filter change
    var filterElement = document.getElementById('filter');
    filterElement.addEventListener('change', function() {
        calendar.refetchEvents();  // This is used to re-render events in FullCalendar 5+
    });
});


</script>

<?= $this->endSection() ?>