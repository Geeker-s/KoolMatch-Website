
$(function(){

    // basic
    $("#option_s1").select2();

    // nested
    $('#option_s2').select2({
        placeholder: "Select a state"
    });

    // multi select
    $('#option_s3').select2({
        placeholder: "Select a state"
    });

    // placeholder
    $("#option_s4").select2({
        placeholder: "Select a State",
        allowClear: true
    });

    // placeholder
    $("#option_s5").select2({
        minimumInputLength: 2
    });

    // loading data from array
    var data = [{
        id: 0,
        text: 'Bootstrap 4'
    }, {
        id: 1,
        text: 'VectorLab'
    }, {
        id: 2,
        text: 'DashLab'
    }, {
        id: 3,
        text: 'FlatLab'
    }, {
        id: 4,
        text: 'MetroLab'
    },
        {
        id: 5,
        text: 'AdminLab'
    }];

    $('#option_s6').select2({
        placeholder: "Select a value",
        data: data
    });

    // disabled mode
    $('#option_s7').select2({
        placeholder: "Select an option"
    });

    // hiding the search box
    $('#option_s8').select2({
        placeholder: "Select hidden option",
        minimumResultsForSearch: Infinity
    });

    // tagging support
    $('#option_s9').select2({
        placeholder: "Add a tag",
        tags: true
    });

});



