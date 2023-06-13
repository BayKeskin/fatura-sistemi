$( document ).ready(function( $ ) {
    $(".telefoninput").mask("(999) 999 99 99",{placeholder:"(___) ___ __ __"});
    $(".ibanno").mask("TR 9999 9999 9999 9999 9999 9999",{placeholder:"TR ____ ____ ____ ____ ____ ____"});
});

$(document).ready(function(){
    $('.ajaxFormFalse').validationForm({'ajaxType':false});
    $('.ajaxFormTrue').validationForm({'ajaxType':true,'ajaxRefreshPage':true});
})
$(function()
{
    $('.currency').mask("#.##0,00", {reverse : true});
})


function openNav() {
    document.getElementById("mySidenav").style.width = "250px";
}

function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
}

$(".true_false_select").change(function (){
    var div = $(this).attr('data-div');
    if($(this).val()==1)
    {
        $("."+div+"").show();
    }else
    {
        $("."+div+"").hide();
    }
})

$('.customer_check_id').each(function () {
    if(this.checked)
    {
        var val = $(this).val();
        $(".faturamodal").append('<input type="hidden" name="customer_id[]" value="'+val+'">');

    }
});
$(".tax_exemption").change(function () {
    if($(this).val()==0)
    {
        $('.tax_rate').show();
    }else
    {
        $('.tax_rate').hide();
    }
})