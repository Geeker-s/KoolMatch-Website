
$(function(){
    $("input[name='demo']").TouchSpin({
        buttondown_class: 'btn btn-border',
        buttonup_class: 'btn btn-border'
    });

    $("input[name='demo1']").TouchSpin({
        min: 0,
        max: 100,
        step: 0.1,
        decimals: 2,
        boostat: 5,
        maxboostedstep: 10,
        postfix: '%',
        buttondown_class: 'btn btn-border',
        buttonup_class: 'btn btn-border'
    });

    $("input[name='demo2']").TouchSpin({
        min: -1000000000,
        max: 1000000000,
        stepinterval: 50,
        maxboostedstep: 10000000,
        prefix: '$',
        buttondown_class: 'btn btn-border',
        buttonup_class: 'btn btn-border'
    });

    $("input[name='demo_vertical']").TouchSpin({
        verticalbuttons: true,
        buttondown_class: 'btn btn-border',
        buttonup_class: 'btn btn-border',
        verticalupclass: 'fa fa-angle-up',
        verticaldownclass: 'fa fa-angle-down'
    });

    $("input[name='demo_vertical2']").TouchSpin({
        verticalbuttons: true,
        buttondown_class: 'btn btn-border',
        buttonup_class: 'btn btn-border',
        verticalupclass: ' ti-plus',
        verticaldownclass: ' ti-minus'
    });


});




