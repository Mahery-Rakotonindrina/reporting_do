$(document).ready(function() {
    chargerReporting();

    $(document).on('click', '#recherche_rep', function() {
        chargerReporting();
    })

    $(document).on('change', '#datepicker1', function() {
        change_date1();
    })

    $(document).on('change', '#datepicker2', function() {
        change_date();
    })

    //TODO: create interface_saisi controller and create route to get get the interface view
    $(document).on('click', '#btn_interface_saisie', function() {
        var id = $(this).attr('data-id');
        var URL = base_url() + 'route_interface saisie';
        $.ajax({
            type: 'POST',
            url: URL,
            data: { id: id },
            data_type: 'json',
            success: function(response) {

            }
        })
    })
})

function chargerReporting() {
    var date_debut = $("#datepicker1").val();
    var date_fin = $("#datepicker2").val();
    $(".loader").css({
        "position": "absolute",
        "top": "50%",
        "left": "50%",
        "margin-top": "50px",
        "margin-left": "-50px"
    })
    $(".loader").show();
    $("#liste_reporting").hide();
    var route = $('.route_acc').val();
    var URL = base_url() + route;

    $.ajax({
        type: 'POST',
        url: URL,
        data: { date_debut: date_debut, date_fin: date_fin },
        data_type: 'html',
        success: function(data) {
            $("#liste_reporting").show();
            $("#liste_reporting").html(data);
            $(".loader").hide();
            datatable();

        }
    })
}

function datatable() {
    $('#Table_data').dataTable({
        responsive: true,
        language: {
            "url": "//cdn.datatables.net/plug-ins/1.11.4/i18n/fr_fr.json"
        },
        alphabetSearch: {
            column: 2
        }
    });
}

function change_date() {
    var date_debut = $('#datepicker1').val().split('/');
    var date_fin = $('#datepicker2').val().split('/');

    var debut = new Date(date_debut[2], date_debut[1] - 1, date_debut[0]);
    var fin = new Date(date_fin[2], date_fin[1] - 1, date_fin[0]);

    if (fin < debut) {
        $('#datepicker1').val($('#datepicker2').val())
    }
}

function change_date1() {
    var date_debut = $('#datepicker1').val().split('/');
    var date_fin = $('#datepicker2').val().split('/');

    var debut = new Date(date_debut[2], date_debut[1] - 1, date_debut[0]);
    var fin = new Date(date_fin[2], date_fin[1] - 1, date_fin[0]);

    if (debut > fin) {
        $('#datepicker2').val($('#datepicker1').val())
    }
}