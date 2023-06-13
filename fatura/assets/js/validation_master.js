$(document).ready(function(){

    var vErrorMessage = {

        'vRequired' : vRequired_message,
        'vMinTar' : vMinTar_message,
        'vMaxTar' : vMaxTar_message,
        'vCheckMinTar' : vCheckMinTar_message,
        'vNumeric' : vNumeric_message,
        'vNumericNot' : vNumericNot_message,
        'vEmailFilter' : vEmailFilter_message,
        'vMinchar' : vMaxchar_message,
        'vMaxchar' : vMinchar_message,
        'vPasswordConfirm' :vPasswordConfirm_message,
        'vCheckRequired' : vCheckRequired_message,
        'vCheckRequiredmin' : vCheckRequiredmin_message,
        'vCheckRequiredmax' :vCheckRequiredmax_message,
        'vTcRequired' :vTcRequired_message,
        'vYoutube' : vYoutube_message,
        'vFileSize' :vFileSize_message

    };
    var RequiredClass = [

        'vRequired',
        'vMinTar',
        'vMaxTar',
        'vCheckMinTar',
        'vNumeric',
        'vNumericNot',
        'vEmailFilter',
        'vMinchar',
        'vMaxchar',
        'vYoutube',
        'vFileSize'

    ];


    $('.vEmailFilter').attr({'autocorrect':'off','autocapitalize':'none'});
    $('.vEmailFilter').keyup(function(){
        $(this).css({'text-transform':'lowercase'});
        return $(this).val($(this).val().toLowerCase());
    });
    $.fn.validationForm = function(options){
        var option = $.extend({
            ajaxType: false,
            ajaxReturnPage : false,
            ajaxHideType : false,
            ajaxRefreshPage : false,
            ajaxScrollBottom : true
        }, options );
        var selectForm = this;
        $(selectForm).attr('error','true');
        this.find(':input:not(:submit,:button)').focusout(function(){
            $(this).trigger('change');
        });
        this.find('input:checkbox,input:radio').change(function(){

            if($(this).hasClass('vCheckRequired') === true){

                $(this).parents('.vCheckRequired').find('.vError').remove();

                var vError = [];
                var vSuccess = [];

                var Classes = $(this).parent('.vCheckRequired').attr('class').split(' ');

                if($(this).is(':checked') === false){

                    $(this).parents('.vCheckRequired').append('<div class="vError"><p class="vErrorIn">'+ vErrorMessage.vCheckRequired +'</p></div>');

                }else{

                    $(this).parents('.vCheckRequired').find('.vError').remove();
                    $(this).css({'background':'#dff0d8','border-color':'#d6e9c6'});

                }

            }

        });
        this.find('input:checkbox,input:radio').change(function(){

            if($(this).hasClass('vCheckRequiredmin') === true){

                $(this).parents('.vCheckRequiredmin').find('.vError').remove();

                var vError = [];
                var vSuccess = [];

                var Classes = $(this).parent('.vCheckRequiredmin').attr('class').split(' ');

                if($(this).is(':checked') === false){

                    $(this).parents('.vCheckRequiredmin').append('<div class="vError"><p class="vErrorIn">'+ vErrorMessage.vCheckRequiredmin +'</p></div>');

                }else{

                    $(this).parents('.vCheckRequiredmin').find('.vError').remove();
                    $(this).css({'background':'#dff0d8','border-color':'#d6e9c6'});

                }

            }

        });
        this.find('input:checkbox,input:radio').change(function(){

            if($(this).hasClass('vCheckRequiredmax') === true){

                $(this).parents('.vCheckRequiredmax').find('.vError').remove();

                var vError = [];
                var vSuccess = [];

                var Classes = $(this).parent('.vCheckRequiredmax').attr('class').split(' ');

                if($(this).is(':checked') === false){

                    $(this).parents('.vCheckRequiredmax').append('<div class="vError"><p class="vErrorIn">'+ vErrorMessage.vCheckRequiredmin +'</p></div>');

                }else{

                    $(this).parents('.vCheckRequiredmax').find('.vError').remove();
                    $(this).css({'background':'#dff0d8','border-color':'#d6e9c6'});

                }

            }

        });
        this.find(':input:not(:submit,:button,:checkbox,:radio)').change(function(){

            var vError = [];
            var vSuccess = [];

            $(this).parent('.vError').find('p.vErrorIn').remove();

            var input = $(this);

            var Classes = $(this).attr('class').split(' ');

            $.each(Classes,function(cKey,cItem){


                if(required($(input),cItem) === false){

                    vError.push({
                        'type':cItem,
                        'input' : input,
                        'parent' : input.data('parent')
                    });

                    $(selectForm).attr('error','true');

                    return false;

                }else if(required($(input),cItem) === true){

                    vSuccess.push({
                        'input' : input
                    });

                    $(selectForm).removeAttr('error');

                }


            });

            if(vError.length > 0){

                $.each(vError,function(key,value){

                    //$(vError[key].input).parents('.vError').find('p.vErrorIn').remove();
                    //$(vError[key].input).parents('.form-floating').contents().unwrap();

                    if(!vError[key].parent){
                        //wrap('<div class="vError4"></div>');
                        //$(vError[key].input).parents('.form-floating').addClass('vError'); //
                        $(vError[key].input).parents('.form-floating').addClass('vError');
                    }else{
                        $(vError[key].input).parents(vError[key].parent).eq(0).wrap('<div class="vError"></div>');
                    }

                    if(vError[key].type == "vMinchar"){
                        $(vError[key].input).parents('.vError').append('<p class="vErrorIn">'+ vErrorMessage[vError[key].type].replace('%c',$(vError[key].input).data('minchar')) +'</p>');
                    }else if(vError[key].type == "vMaxchar"){
                        $(vError[key].input).parents('.vError').append('<p class="vErrorIn">'+ vErrorMessage[vError[key].type].replace('%c',$(vError[key].input).data('maxchar')) +'</p>');
                    }else if(vError[key].type == "vFileSize"){
                        $(vError[key].input).parents('.vError').append('<p class="vErrorIn">'+ vErrorMessage[vError[key].type].replace('%c',$(vError[key].input).data('size')  / 1024) +'</p>');
                    }else{
                        $(vError[key].input).parents('.vError').append('<p class="vErrorIn">'+ vErrorMessage[vError[key].type] +'</p>');
                    }
                    $(vError[key].input).css({'background':'none'});
                });

                return false;
            }else if(vSuccess.length > 0){
                $.each(vSuccess,function(key,value){

                   $(vSuccess[key].input).parents('.vError').find('p.vErrorIn').remove();
                   //        $(vSuccess[key].input).parents('.vError').contents().unwrap();
                    $(vSuccess[key].input).parents('.form-floating').removeClass('vError')


                });
            }else{
                return true;
            }

        });
        this.submit(function(ev){

            if(option.ajaxType === true){
                ev.preventDefault();
            }

            var vError = [];
            var vSuccess = [];

            $(this).find('.vError').find('p.vErrorIn').remove();
            $(this).find('.vError').each(function(){
                $(this).find(':input').parents('.vError').contents().unwrap();
            });
            var form = this;

            $(form).find('.vCheckRequired').each(function(){

                if($(this).find(':input').is(':checked') === false){
                    vError.push({
                        'type': 'vCheckRequired',
                        'input' : $(this),
                        'parent' : $(this).data('parent'),
                        'checked' : true
                    });

                    $(selectForm).attr('error','true');

                }

            });
            $(form).find('.vCheckRequiredmin').each(function(){
                var sayi = $('[name="calendarDay[]"]:checked').length
                if(sayi <5){
                    vError.push({
                        'type': 'vCheckRequiredmin',
                        'input' : $(this),
                        'parent' : $(this).data('parent'),
                        'checked' : true
                    });

                    $(selectForm).attr('error','true');

                }

            });
            $(form).find('.vCheckRequiredmax').each(function(){
                var sayi = $('[name="UrunID[]"]:checked').length
                if(sayi <3 || sayi >4 ){
                    vError.push({
                        'type': 'vCheckRequiredmax',
                        'input' : $(this),
                        'parent' : $(this).data('parent'),
                        'checked' : true
                    });

                    $(selectForm).attr('error','true');

                }

            });
            $(form).find(':input:not(:submit,:button,:checkbox)').each(function(e){

                var input = $(this);

                if($(this).attr('class')){

                    var Classes = $(this).attr('class').split(' ');

                    $.each(Classes,function(cKey,cItem){

                        if(required($(input),cItem) === false){

                            vError.push({
                                'type':cItem,
                                'input' : input,
                                'parent' : input.data('parent')
                            });

                            return false;
                            ev.preventDefault();

                        }else{

                            vSuccess.push({
                                'input' : input
                            });

                        }

                    });

                }else{

                    // ev.preventDefault();
                    return true;

                }

            });

            if(vError.length > 0){

               $(selectForm).find('.vError').contents().unwrap();

                var count = 0;

                $.each(vError,function(key,value){

                    count++;

                    if(count == 1){
                        $('html,body').animate({
                                scrollTop: $(selectForm).offset().top-10},
                            'slow');
                    }



                    if(vError[key].checked === true){
                        $(vError[key].input).append('<div class="vError"><p class="vErrorIn">'+ vErrorMessage[vError[key].type] +'</p></div>');
                    }else if(!vError[key].parent){
                        $(vError[key].input).wrap('<div class="vError"></div>');
                    }else{
                        $(vError[key].input).parents(vError[key].parent).eq(0).wrap('<div class="vError"></div>');
                    }

                    if(vError[key].type == "vMinchar"){
                        $(vError[key].input).parents('.vError').append('<p class="vErrorIn">'+ vErrorMessage[vError[key].type].replace('%c',$(vError[key].input).data('minchar')) +'</p>');
                    }else if(vError[key].type == "vMaxchar"){
                        $(vError[key].input).parents('.vError').append('<p class="vErrorIn">'+ vErrorMessage[vError[key].type].replace('%c',$(vError[key].input).data('maxchar')) +'</p>');
                    }else if(vError[key].type == "vFileSize"){
                        $(vError[key].input).parents('.vError').append('<p class="vErrorIn">'+ vErrorMessage[vError[key].type].replace('%c',$(vError[key].input).data('size')  / 1024) +'</p>');
                    }else{
                        $(vError[key].input).parents('.vError').append('<p class="vErrorIn">'+ vErrorMessage[vError[key].type] +'</p>');
                    }
                    $(vError[key].input).css({'background':'none','border-color':'inherit'});


                });

                if(vSuccess.length > 0){
                    $.each(vSuccess,function(key,value){
                        if(vSuccess[key].type == 'vRequired' && vSuccess[key].type == 'vNumeric'){
                            $(vSuccess[key].input).css({'background':'#dff0d8','border-color':'#d6e9c6'});
                        }
                    });
                }

                ev.preventDefault();
                return false;
            }else{
                if(option.ajaxType === true){

                    thisForm = $(this);
                    if ($(thisForm).hasClass("loading")) {
                        $(thisForm).find(".load").show();
                    }
                    /*
                    $('.vAjaxErrors').append('<div class="alerts alert-info"> İşleminiz Gerçekleştiriliyor. Lütfen bekleyiniz <div class="alert-loading"><img src="https://www.asansorhizmet.com/lib/images/loading.gif"/></div></div>');
                    */
                    $.ajax({
                        type:"POST",
                        url:$(this).attr('action'),
                        data: new FormData(this),
                        contentType: false,
                        cache: false,
                        processData:false,
                        success: function(sonuc){
                            $(thisForm).find(".vAjaxErrors").html(sonuc);
                            if ($(thisForm).hasClass("btnhide")) {
                                $(thisForm).find("button").hide();
                            }
                        }
                    });
                    return false;
                    ev.preventDefault();
                }else{
                    return true;
                }
            }

        });
        $(this).find(':input.vCharLimit').each(function(){

            $(this).wrap('<div class="charWrap"></div>');
            $(this).parents('.charWrap').append('<div class="charlimit">'+ $(this).data('maxchar') +'</div>');
            $(this).keyup(function(){
                $(this).css({'padding-right':$(this).parents('.charWrap').find('.charlimit').width()+30});
                var maxchar = $(this).data('maxchar');
                var keychar = $(this).val().length;
                var endchar = maxchar-keychar;
                if(endchar < 0){
                    maxchar = maxchar;
                    $(this).val($(this).val().substr(0,maxchar));
                }else{
                    $(this).parents('.charWrap').find('.charlimit').html(endchar);
                }
            });

        });
        function isEmptyInput(value) {
            return typeof value == 'string' && !value.trim() || typeof value == 'undefined' || value === null;
        }
        function required(item,control){

            switch (control) {

                case "vFileSize":

                    if($(item)[0].files[0].size < $(item).data('size')){
                        return true;
                    }else{
                        return false;
                    }

                    break;

                case 'vRequired':

                    if($(item).hasClass('cellphone') === true){

                        if($(item).val() === "0(5__) ___ ____" || $(item).val() === ""){
                            return false;
                        }else{
                            return true;
                        }

                    }else if($(item).hasClass('selectstyle') === true){

                        if( item.children('option').length <= 0 ){
                            return false;
                        }else{
                            return true;
                        }

                    }else{
                        if(isEmptyInput($(item).val())){
                            return false;
                        }else{
                            return true;
                        }

                    }


                    break;




                case 'vNumeric':

                    if($.isNumeric($(item).val()) === false){
                        return false;
                    }else{
                        return true;
                    }

                    break;

                case 'vNumericNot':

                    patterns = /^[a-zA-Z_-İıŞşĞğÇçÖöÜüÖö ]*$/;

                    // console.log(typeof $(item).val());

                    if(!patterns.test($(item).val())){
                        return false;
                    }else{
                        return true;
                    }

                    break;

                case 'vPasswordConfirm':

                    if($(item).val() !== $(selectForm).find('.vPassword').val()){
                        return false;
                    }else{
                        return true;
                    }

                    break;
                case 'vMinTar':
                    var today = new Date();
                    var dd = String(today.getDate()).padStart(2, '0');
                    var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
                    var yyyy = today.getFullYear();
                    today = mm + '/' + dd + '/' + yyyy;
                    var tarih =$(item).val();

                    if(Date.parse(tarih)<Date.parse(today))
                    {
                        return false;
                    }else{
                        return true;
                    }
                    break;
                case 'vMaxTar':
                    var today = new Date();
                    var dd = String(today.getDate()).padStart(2, '0');
                    var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
                    var yyyy = today.getFullYear();
                    today = mm + '/' + dd + '/' + yyyy;
                    var tarih =$(item).val();

                    if(Date.parse(tarih)<Date.parse(today))
                    {
                        return false;
                    }else{
                        return true;
                    }
                    break;
                case 'vCheckMinTar':
                    var today = new Date();
                    var dd = String(today.getDate()).padStart(2, '0');
                    var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
                    var yyyy = today.getFullYear();
                    today = mm + '/' + dd + '/' + yyyy;
                    var tarih =$(item).val();
                    var baslangic = $(selectForm).find('.vMinTar').val();

                    if(Date.parse(tarih)<Date.parse(baslangic))
                    {
                        return false;
                    }else{
                        return true;
                    }

                    break;

                case 'vEmailFilter':

                    var pattern = /^\b[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b$/i;

                    if(!pattern.test($(item).val())){

                        return false;

                    }else{
                        return true;
                    }

                    break;

                case 'vMinchar':

                    if($(item).val().trim().length < $(item).data('minchar')){
                        return false;
                    }else{
                        return true;
                    }


                    break;

                case 'vMaxchar':

                    if($(item).val().trim().length > $(item).data('maxchar')){
                        return false;
                    }else{
                        return true;
                    }


                    break;

                case 'vCheckRequired':

                    if($(item).is(':checked') === false){
                        return false;
                    }else{
                        return true;
                    }

                    break;

                case 'vCheckRequiredmin':

                    if($(item).is(':checked') === false){
                        return false;
                    }else{
                        return true;
                    }

                    break;
                case 'vCheckRequiredmax':

                    if($(item).is(':checked') === false){
                        return false;
                    }else{
                        return true;
                    }

                    break;



                case 'vYoutube':

                    var str = $(item).val();

                    var n = str.indexOf("https://www.youtube.com/watch?v");

                    if(n == -1){
                        return false;
                    }else{
                        return true;
                    }

                    break;

                case 'vTcRequired':

                    var checkTcNum = function(value) {
                        value = value.toString();
                        var isEleven = /^[0-9]{11}$/.test(value);
                        var totalX = 0;
                        for (var i = 0; i < 10; i++) {
                            totalX += Number(value.substr(i, 1));
                        }
                        var isRuleX = totalX % 10 == value.substr(10,1);
                        var totalY1 = 0;
                        var totalY2 = 0;
                        for (var i = 0; i < 10; i+=2) {
                            totalY1 += Number(value.substr(i, 1));
                        }
                        for (var i = 1; i < 10; i+=2) {
                            totalY2 += Number(value.substr(i, 1));
                        }
                        var isRuleY = ((totalY1 * 7) - totalY2) % 10 == value.substr(9,0);
                        return isEleven && isRuleX && isRuleY;
                    };


                    var isValid = checkTcNum($(item).val());
                    if (isValid) {
                        return true;
                    }
                    else {
                        return false;
                    }

                    break;


                default:

            }

        }

        return this;
    };


});