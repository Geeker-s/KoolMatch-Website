//input mask init

$(function(){
// date format
    $("#inputmask_1").inputmask("mm/dd/yyyy", {
        autoUnmask: true
    });

    // custom placeholder
    $("#inputmask_2").inputmask("dd/mm/yyyy", {
        "placeholder": "*"
    });

    // phone number format
    $("#inputmask_3").inputmask("mask", {
        "mask": "+ (999) 999-9999"
    });

    // empty placeholder
    $("#inputmask_4").inputmask({
        "mask": "99-9999999",
        placeholder: "" // remove underscores from the input mask
    });

    // repeating mask
    $("#inputmask_5").inputmask({
        "mask": "9",
        "repeat": 10,
        "greedy": false
    }); // ~ mask "9" or mask "99" or ... mask "9999999999"

    // right align
    $("#inputmask_6").inputmask('decimal', {
        rightAlignNumerics: false
    });

    // currency format
    $("#inputmask_7").inputmask('$ 999.999.999,99', {
        numericInput: true
    }); //123456  =>  $ ___.__1.234,56

    //ip address
    $("#inputmask_8").inputmask({
        "mask": "999.999.999.999"
    });

    //email address
    $("#inputmask_9").inputmask({
        mask: "*{1,20}[.*{1,20}][.*{1,20}][.*{1,20}]@*{1,20}[.*{2,6}][.*{1,2}]",
        greedy: false,
        onBeforePaste: function (pastedValue, opts) {
            pastedValue = pastedValue.toLowerCase();
            return pastedValue.replace("mailto:", "");
        },
        definitions: {
            '*': {
                validator: "[0-9A-Za-z!#$%&'*+/=?^_`{|}~\-]",
                cardinality: 1,
                casing: "lower"
            }
        }
    });

});



