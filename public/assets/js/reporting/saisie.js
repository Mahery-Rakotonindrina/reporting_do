$(document).ready(function(){
    $(document).on('change', '#date_saisi_reporting', function(){
            crtl_date();
    })

    $(document).on('change', '#date_saisi_reporting-edit', function(){
        var text = '-edit'
        crtl_date(text);
    })

    $(document).on('click', '.btn-search_date', function(){
        var mod = $(this).attr('data-mod');
        var text = '';
        mod == 'saisie-rep' ?
            text = '':
            text = '-edit';
        var data = getdata(text);
        var route = '';
        mod == 'saisie-rep' ?
            route = $('#route_interface_saisi').val():
            route = $('#route_edit_saisi').val();
        var url = base_url() + route;

        $.ajax({
            type: 'POST',
            url :  url,
            data: data,
            data_type: 'html',
            success: (response) => {
                var interf = '';
                mod == 'saisie-rep' ?
                    interf = '#table_interface':
                    interf = '#table_edit_interface';
                if(interf == '#table_interface') {
                    $(interf).show();
                    $(interf).html(response);
                }else{
                    reload_table();
                }
            }
        })
    })
    $(document).on('click', '.btn_interface_saisie', function(){
        crtl_date()
        var value = $(this).attr('data-id');
        $('#id_parametrage').val(value);
    })

    $(document).on('click', '.btn-edit-reporting', function(){
        var text = '-edit'
        crtl_date(text);
        var value = $(this).attr('data-id');
        $('#id_parametrage-edit').val(value);
        
    })

    $(document).on('change', '.form-input', function(){
        var url = $('#route_insert_saisi').val();
        var id_parametrage = '';
        $('#route_insert_saisi').attr("data-mod") != 'edit-rep' ?
            id_parametrage = $('#id_parametrage').val():
            id_parametrage = $('#id_parametrage-edit').val();

        $(this).each(function(){
           var id = $(this).attr('id');
           var dd = id.split(".");
           var col = dd[0];
           var date = dd[1];
           var value = $(this).val();
           
           $.ajax({
            type: 'POST',
            url: url,
            data:{col : col, date:date, value:value, id_param:id_parametrage},
            data_type:'json',
            success: (response) => {
                if($('#route_insert_saisi').attr("data-mod") == 'edit-rep'){
                    const url_2 = base_url() + '/saisie/updateJPlus';
                    $.ajax({
                        type:'POST',
                        url:url_2,
                        data:{date_J:date, param:id_parametrage},
                        success:(response) => {
                            console.log(response);
                        }
                    })
                    reload_table()
                }
            }
           })
        })
    })
    
    $(document).on('click', '.btn-fermer_saisie', function(){
        $('.form-input').val('');
        $('#table_interface').hide();
        $('#table_edit_interface').hide();
        $("#date_saisi_reporting").val('j');
        $("#date_saisi_reporting-edit").val('j');

        chargerReporting()
    })

    $(document).on('click', '#visu_saisie', function(){
        load_data_saisie();
    })

    $(document).on("keyup", "#recherche_visu_client", function(){
        load_data_saisie();
    })

    $(document).on("keyup", "#recherche_visu_projet", function(){
        load_data_saisie();
    })

})

function crtl_date( text = ''){//gestion du champ date
    var chx_date = $("#date_saisi_reporting"+text).val();
    if(chx_date == "d"){
        $("#date1"+text).show();
        $("#date2"+text).hide();
    }else if (chx_date == "dd") {
        $("#date1"+text).show();
        $("#date2"+text).show();
    }else{
        $("#date1"+text).hide();
        $("#date2"+text).hide();
    }
}

function getdata(text = ''){
    var data = {};
    data.chx_date = $("#date_saisi_reporting" + text).val();
    data.date_1 = $("#date_1" + text).val();
    data.date_2 = $("#date_2" + text).val();
    data.id_param =$("#id_parametrage" + text).val(); 
    return data;
}

var datatable_saise = () => {
    $('#table_saisi-edit').dataTable({
        responsive: true,
        language: {
            "url": "//cdn.datatables.net/plug-ins/1.11.4/i18n/fr_fr.json"
        },
        alphabetSearch: {
            column: 2
        }
    });
}


var reload_table = () => {
    var text = '-edit';
    var data = getdata(text);

    route = $('#route_edit_saisi').val();
    var url = base_url() + route;

    $.ajax({
        type: 'POST',
        url :  url,
        data: data,
        data_type: 'html',
        success: (response) => {
        // console.log(response);
        $('#table_edit_interface').show();
        $('#table_edit_interface').html(response)
        datatable_saise();
        }
    });
}

var load_data_saisie = () => {
    var url = base_url() + "/saisie/visu";
    var client = $("#recherche_visu_client").val();
    var projet = $("#recherche_visu_projet").val();

    $.ajax({
        type:'POST',
        url: url,
        data: {client:client, projet:projet},
        data_type: 'json',
        success: (response) => {
            $('#liste_saisie').show();
            $("#liste_saisie").html(response);
            datatable_visu_saisie();
        }
    })
}

var datatable_visu_saisie= () => {
    $('#table_visu_saisie').dataTable({
        responsive: true,
        language: {
            "url": "//cdn.datatables.net/plug-ins/1.11.4/i18n/fr_fr.json"
        },
        alphabetSearch: {
            column: 2
        }
    });
}