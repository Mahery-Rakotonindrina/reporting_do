$(document).ready(function() {
    getlisteCLient();
    $(document).on('change', '#mail_check', function() {
        if ($(this).is(":checked")) {
            $('#mail').prop("disabled", false)
        } else {
            $('#mail').prop("disabled", true)
            $('#mail').val('')
        }
    })

    $(document).on('change', '#obj_med_check', function() {
        if ($(this).is(":checked")) {
            $('#obj_del_median').prop("disabled", false)
            $('#obj_med_unite_1').prop("disabled", false)
            $('#obj_med_unite_2').prop("disabled", false)
        } else {
            $('#obj_del_median').prop("disabled", true)
            $('#obj_med_unite_1').prop("disabled", true)
            $('#obj_med_unite_2').prop("disabled", true)
            $('#obj_del_median').val('')
        }
    })

    $(document).on('change', '#obj_moy_check', function() {
        if ($(this).is(":checked")) {
            $('#obj_del_moyen').prop("disabled", false)
            $('#obj_moy_unite_1').prop("disabled", false)
            $('#obj_moy_unite_2').prop("disabled", false)
        } else {
            $('#obj_del_moyen').prop("disabled", true)
            $('#obj_moy_unite_1').prop("disabled", true)
            $('#obj_moy_unite_2').prop("disabled", true)
            $('#obj_del_moyen').val('')
        }
    })

    $(document).on('change', '#taux2_check', function() {
        if ($(this).is(":checked")) {
            $('#t_resp_del2').prop("disabled", false)
        } else {
            $('#t_resp_del2').prop("disabled", true)
            $('#t_resp_del2').val('')
        }
    })

    $(document).on('change', '#client_select', function(e) {
        e.preventDefault();
        getlisteCode();
        getlisteProjet();

    })

    $(document).on('change', '#code_commande', function(e) {
        e.preventDefault();
        getlisteProjet();
    })

    $(document).on('change', '#projet', function(e) {
        e.preventDefault();
        getlisteCode();
    })

    $(document).on('submit', '#form-param_ajout', function(e) {
        e.preventDefault();
        var form = $(this);
        var formdata = new FormData(form[0]);
        var url = null;
        var type = form.attr("method");
        var mail =  $("#mail").val();
        if ($("#mail_check").is(":checked")) {
            var check = checkMail(mail);
            if(check == false){
                $("#invalid_email").show()
                return false;
            }else{
                $("#invalid_email").hide()  
            }
        }

        var id = $("#id_parameter").val();

        id == "" ?
            url = form.attr("action") :
            url = form.attr("data-modif_action");
        $.ajax({
            type: type,
            url: base_url() + url,
            data: formdata,
            data_type: 'json',
            processData: false,
            contentType: false,
            success: function(response) {
                var result = JSON.parse(response);
                if (result.message == "OK") {
                    $("#modal_param").modal('hide');
                    swal("Enregistrement r??ussi", {
                        icon: "success",
                    });
                    resetForm()
                }
                chargerReporting();
            }
        })
    })

    $(document).on('click', "#btn_show_param", function() {
        var id = $(this).attr('data-id');
        var route = $(this).attr('data-route');

        $.ajax({
            type: 'POST',
            url: base_url() + route,
            data: { id: id },
            data_type: 'json',
            success: function(response) {
                var result = JSON.parse(response);
                console.log(result);
                var date_deb_app = result.rep_date_debut_application
                $("#date_deb_show").html(date_deb_app);
                $("#client_show").html(result.nom_client);
                (result.rep_mail_client == '') ? $("#mail_if").hide(): $("#mail_if").show();
                $("#mail_show").html(result.rep_mail_client);
                $("#projet_show").html(result.nom_application);
                $("#code_show").html(result.rep_code);
                $("#unite_show").html(result.rep_unite);
                $("#obj_cadence_show").html(result.rep_objectif_cadence);
                $("#t_occupation_show").html(result.rep_taux_occupation);
                $("#dmt_show").html(result.rep_dmt);
                $("#reliquat_show").html(result.rep_reliquat_initial);
                (result.rep_objectif_delai_median == null) ? $("#median_if").hide(): $("#median_if").show();
                $("#obj_del_med_show").html(result.rep_objectif_delai_median);
                (result.rep_objectif_delai_moyen == null) ? $("#moyen_if").hide(): $("#moyen_if").show();
                $("#obj_del_moy_show").html(result.rep_objectif_delai_moyen);
                $("#t_controle_show").html(result.rep_taux_controle);
                $("#t_conformite_show").html(result.rep_taux_conformite);
                $("#obj_delai_1_show").html(result.rep_objectif_delai_1+'% ?? '+result.rep_obj_delai_unite_1)
                $("#obj_delai_2_show").html(result.rep_objectif_delai_2+'% ?? '+result.rep_obj_delai_unite_2)
            }
        })
    })

    $(document).on('click', "#btn_edit_param", function(e) {
        e.preventDefault();
        let saisie = $(this).attr('data-saisie');
        if(saisie != ""){
            swal({
                title: "Attention",
                text: "Vous ??tes sur le point de modifier un param??tre qui contient d??j?? une ou plusieurs donn??es",
                icon: "warning",
                buttons: ["Non", "Oui"],
            })
            .then((willChange) => {
                if (willChange) {
                    editParam(this);
                } else {
                    swal("Modification annul??e");
                }
            });
        }else{
            editParam(this);
        }
       
    })

    $(document).on("click", ".fermer-modal", function() {
        resetForm()
    })

    $(document).on('click', ".btn-delete", function() {
        var route = $(this).attr("data-route");
        var id = $(this).attr("data-id");

        swal({
                title: "Suppression",
                text: "??tes-vous s??r de vouloir supprimer ce param??tre?",
                icon: "warning",
                buttons: ["Non", "Oui"],
            })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        type: 'POST',
                        url: base_url() + route,
                        data: { id: id },
                        data_type: 'json',
                        success: (response) => {
                            var result = JSON.parse(response);
                            if (result.message == 'OK') {
                                swal("El??ment supprim?? avec succ??s", {
                                    icon: "success",
                                    buttons: 'Ok'
                                });
                            } else {
                                swal("error de suppression", {
                                    icon: "error",
                                    buttons: 'Ok'
                                });
                            }
                            chargerReporting();
                        }
                    })
                } else {
                    swal("Supression annul??e");
                }
            });
    })

    $(document).on('change', "#taux_occupation", function() {
        if($("#obj_cadence").val() != ""){
            calculDMT();
        }
        if($("#dmt").val() != ''){
            calculCadence();
        }
    })

    $(document).on('change', "#obj_cadence", function() {
        calculDMT();
    })

    $(document).on('change', "#dmt", function(){
        calculCadence();
    })

    $(document).on('click', ".btn-history", function() {
        var id = $(this).attr('data-id');
        var route = $(this).attr('data-route')

        var url = base_url() + route;

        $.ajax({
            type: 'POST',
            url: url,
            data: { id: id },
            data_type: 'html',
            success: function(response) {
                $("#liste_histoty").html(response);
                datatablehistory();
            }
        })
    })

    $(document).on('click', "#btn-visu_param", function(){
        getVisuParam();
    })

    $(document).on('change', '#datepicker3', function() {
        change_date_3();
    })

    $(document).on('change', '#datepicker4', function() {
        change_date_4();
    })

    $(document).on('click', '#recherche_parametrage', function(){
        getVisuParam();
    })

    $(document).on('change', '.check_column', function(){
        getVisuParam();
    })

    $(document).on('keyup','#recherche_client', function(){
        getVisuParam();
    })

    $(document).on('keyup','#recherche_projet', function(){
        getVisuParam();
    })

    $(document).on('keyup', '.form-number', function() {
        checkInputNumber();
    })

})

var checkMail = (email) => {
    var EmailRegex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return EmailRegex.test(email);
}

var getlisteCLient = () => {
    var url = base_url() + '/param/client';

    $.ajax({
        type: 'GET',
        url: url,
        data: {},
        data_type: 'html',
        success: function(response) {
            $("#select_client").html(response);

        }
    })
}

var getlisteProjet = () => {
    var url = base_url() + '/param/projet';
    var client = $('#client_select').val();
    var code = $('#code_commande').val();
    $('#projet').html("");

    $.ajax({
        type: 'POST',
        url: url,
        data: { client: client, code: code },
        data_type: 'json',
        success: function(response) {
            $('#projet').prop("disabled", false);
            $('#code_commande').prop("disabled", false);
            (code == null) ? $('#projet').append('<option value="0" >S??lectionner un projet</option>') : '';

            var result = null;
            if (response != '') {
                var result = JSON.parse(response);
            }
            if (result != null) {
                var selected = '';
                if (result.length == 1) {
                    selected = 'selected';
                }
                $.each(result, function(index, value) {
                    $('#projet').append('<option value="' + value.id_application + '"' + selected + '>' + value.nom_application + '</option>')
                });
            }
        }
    })
}

var getlisteCode = (code = null) => {
    var url = base_url() + '/param/code';
    var client = $('#client_select').val();
    var projet = $('#projet').val();
    $('#code_commande').html("");


    $.ajax({
        type: 'POST',
        url: url,
        data: { client: client },
        data_type: 'json',
        success: function(response) {
            if (projet == null) {
                $('#code_commande').append('<option value="0" selected disabled >S??lectionner un code commande</option>')
            }
            var result = null;
            if (response != '') {
                var result = JSON.parse(response);
            }

            if (result != null) {
                $.each(result, function(index, value) {
                    var selected = '';
                    if (projet == value.id_application) {
                        selected = 'selected'
                    }
                    $('#code_commande').append('<option value="' + value.code + '"' + selected +
                        '>' + value.code + '</option>')
                });
                if(code != null){
                    $('#code_commande').val(code).trigger('change');
                }
            }
        }
    })
}

var calculDMT = () => {
    var taux = $("#taux_occupation").val();
    var cadence = $("#obj_cadence").val();

    taux == '' || cadence == "" ?
        dmt = '' : 
        dmt = (3600 * taux / cadence)/100;
        
    dmt != '' ? 
        dmt = dmt.toFixed(2):
        dmt = '';
    $("#dmt").val(dmt);
}

var calculCadence = () => {
    var dmt = $("#dmt").val();
    var taux = $("#taux_occupation").val();
    
    taux == '' || dmt == '' ?
        cadence = '':
        cadence = (3600 * taux / dmt)/100;

    cadence != '' ?
        cadence = cadence.toFixed(2):
        cadence = '';

    console.log(taux);
    console.log(dmt);
    console.log(cadence);
    $("#obj_cadence").val(cadence);
}

var getVisuParam = () => {
    var date_deb = null
    var date_fin = null
    var route = $("#visu_param").val();
    var client = $("#recherche_client").val();
    var projet = $("#recherche_projet").val();
    var url = base_url() + route;

    var checks = $('input[type="checkbox"]:checked').map(function() {
        return $(this).val();
      }).get()
    //   var ck = 
    var ck = checks.toString();

    $.ajax({
        type:'POST',
        url: url,
        data:{date_deb:date_deb, date_fin:date_fin, client:client, projet:projet, check:ck},
        data_type:'html',
        success:function(response){
            $("#liste_parametrage").html(response);
            validateForm();
        }
    })
}

var change_date_3 = () => {
    var date_debut = $('#datepicker3').val().split('/');
    var date_fin = $('#datepicker4').val().split('/');

    var debut = new Date(date_debut[2], date_debut[1] - 1, date_debut[0]);
    var fin = new Date(date_fin[2], date_fin[1] - 1, date_fin[0]);

    if (fin < debut) {
        $('#datepicker4').val($('#datepicker3').val())
    }
}

var change_date_4 = () => {
    var date_debut = $('#datepicker3').val().split('/');
    var date_fin = $('#datepicker4').val().split('/');

    var debut = new Date(date_debut[2], date_debut[1] - 1, date_debut[0]);
    var fin = new Date(date_fin[2], date_fin[1] - 1, date_fin[0]);

    if (debut > fin) {
        $('#datepicker4').val($('#datepicker3').val())
    }
}

var validateForm = () => {
    var checks = $('input[type="checkbox"]:checked').map(function() {
      return $(this).val();
    }).get()
    console.log(checks);
    return false;
  }

var checkInputNumber = () => {
    $('.form-number').each(function(){
        var value  = $(this).val();
        !isNaN(value) ? 
            $(this).val(value): 
            $(this).val('')
    })
    
}

var resetForm = () => {
    $('.form-parameter').each(function() {
        $(this).val('');
    })
    $('.switch').hide();
    $("#check_is_active").attr('checked', true);
    $("#projet").prop('disabled', true)
    $("#projet").val('')
    $("#code_commande").prop('disabled', true)
    $("#code_commande").val('')
    $("#obj_del_inite_1_1").val('J');
    $("#obj_del_inite_1_2").val(0);
    
    $("#obj_del_inite_2_1").val('J');
    $("#obj_del_inite_2_2").val(1);

    $("#mail").prop('disabled', true)
    $("#mail_check").prop('checked', false)
    $("#mail").val('')
    $("#invalid_email").hide()
}

var editParam = (btn) => {
    $("#modal_param").modal('show');
    $('.switch').show();
    var id = $(btn).attr('data-id');
    var route = $(btn).attr('data-route');

    $.ajax({
        type: 'POST',
        url: base_url() + route,
        data: { id: id },
        data_type: 'json',
        success: function(response) {
            var result = JSON.parse(response);
            console.log(result.rep_statut);
            if(result.rep_statut == 1){
                $("#check_is_active").prop('checked', true);
            }else{
                $("#check_is_active").prop('checked', false)
            }
            $('#id_parameter').val(result.rep_id_parameter)
            $('#client_select').val(result.rep_id_client)

            if (result.rep_mail_client != '') {
                $("#mail_check").prop('checked', true)
                $("#mail").val(result.rep_mail_client)
                $("#mail").prop('disabled', false)
            } else {
                $("#mail").prop('disabled', true)
                $("#mail_check").prop('checked', false)
                $("#mail").val('')
            }
            getlisteCode(result.rep_code);
            $("#code_commande").prop('disabled', false)
            // $("#code_commande").val('VSR');

            getlisteProjet();
            $("#projet").prop('disables', false)
            $("#projet").val(result.rep_id_projet)

            $("#unite_volume").val(result.rep_unite)
            $("#obj_cadence").val(result.rep_objectif_cadence)
            $("#taux_occupation").val(result.rep_taux_occupation)

            $("#dmt").val(result.rep_dmt)
            $("#reliquat").val(result.rep_reliquat_initial)
            var date = new Date(result.rep_date_debut_application);
            date = (date.toLocaleString('en-UK'));
            date = date.split(',')
            date = date[0];
            $("#date_app").val(date)
                // $("#date_app").val(result.rep_date_creat)
            if (result.rep_objectif_delai_median != null) {
                $("#obj_med_check").prop('checked', true)
                $("#obj_del_median").prop('disabled', false)
                $("#obj_del_median").val(result.rep_objectif_delai_median)
            } else {
                $("#obj_med_check").prop('checked', false)
                $("#obj_del_median").val("")
                $("#obj_del_median").prop('disabled', true)
            }
            if (result.rep_objectif_delai_moyen != null) {

                $("#obj_moy_check").prop('checked', true)
                $("#obj_del_moyen").prop('disabled', false)
                $("#obj_del_moyen").val(result.rep_objectif_delai_moyen)
            } else {
                $("#obj_moy_check").prop('checked', false)
                $("#obj_del_moyen").prop('disabled', true)
                $("#obj_del_moyen").val('')
            }

            $("#t_ctrl").val(result.rep_taux_controle)
            $("#t_cnft").val(result.rep_taux_conformite)
            
            let objectif_delai_unite = result.rep_obj_delai_unite_1;
            let unite_1 = objectif_delai_unite.split("+");

            let unite1_1 = unite_1[0].trim();
            let unite1_2 = typeof(unite_1[1]) != "undefined" ? unite_1[1].trim() : 0;

            $("#obj_delai_1").val(result.rep_objectif_delai_1)
            $("#obj_del_inite_1_1").val(unite1_1)
            $("#obj_del_inite_1_2").val(unite1_2)

            let objectif_delai_unite_2 = result.rep_obj_delai_unite_2;
            let unite_2 = objectif_delai_unite_2.split("+");

            let unite2_1 = unite_2[0].trim();
            let unite2_2 = typeof(unite_2[1]) != "undefined" ? unite_2[1].trim() : 0;

            $("#obj_delai_2").val(result.rep_objectif_delai_2)
            $("#obj_del_inite_2_1").val(unite2_1)
            $("#obj_del_inite_2_2").val(unite2_2)
        }
    })
}

function datatablehistory() {
    $('#Table_history').dataTable({
        responsive: true,
        "scrollX": true,
        language: {
            "url": "//cdn.datatables.net/plug-ins/1.11.4/i18n/fr_fr.json"
        },
        pageLength: 25,
        alphabetSearch: {
            column: 2
        }
    });
}