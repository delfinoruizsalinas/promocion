
var contactUsApp = function(){
    window.$contactForm = $('#contact_form');
    
    window.setTimeout(function(){
        $contactForm.attr('action','send_feed_back_kjhkdsjfh56546kbcx');
    },600);


    var showAlert = function(type,message){
        var alertTpl =  '<div id="contact_form_alert" class="alert alert-success" style="display: none"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><p></p></div>';

        if($('#contact_form_alert').size() == 0){
            $contactForm.prepend(alertTpl);
        }
        var $contactFormAlert = $('#contact_form_alert');
        $contactFormAlert.hide();
        $contactFormAlert.removeClass().addClass('alert alert-'+type);
        $contactFormAlert.find('p:first').text(
            message
        );
        $contactFormAlert.show();


    };

    var disableForm = function(disable,empty){
        if(disable){
            $contactForm.find('input , textarea , button').attr('disabled',true);
        }else{
            $contactForm.find('input , textarea , button').removeAttr('disabled');
        }

        if(!disable && empty){
            $contactForm.find('input , textarea').each(function(){
                $(this).val('');
            });
        }
    }

    $contactForm.submit(function(e){
        e.preventDefault();
        var action = $contactForm.attr('action');
        var fdata = $contactForm.serialize();
        disableForm(true,false);

        $.ajax({
            type : 'POST',
            url : action,
            data : fdata,
            success : function(data){
                data = data || {};

                if(data.status == 'ok'){
                    showAlert('success',data.message);
                    disableForm(false,true);

                }else{
                    showAlert('danger',data.message);
                    disableForm(false,false);
                }

            },
            error : function(){
                alert('something went wrong !');
                disableForm(false,false);
            }
        });

    });

};

var rss2jsonApp = function(){
    var STATUS = {READY : 0 , BUSY : 1};
    var CURR_STATUS = STATUS.READY;


    $.ajaxSetup({cache : false});

    var $mainForm = $('#main_form');
    var $getJsonBtn = $('#get_json_btn');
    var $rssUrl = $('#rss_url');
    var $outPut = $("#output");
    var $sourceCode = $("#source_code");
    var $modal = $('#main_modal');
    var $modalViewSource = $('#view-source');
    var $previewResult = $('#preview_result');

    var API_END_POINT = $mainForm.attr('action');

    function nowLoading(isLoading){
        if(isLoading){
            $getJsonBtn.attr('disabled','disabled');
            $rssUrl.attr('readonly',true);
            $previewResult.attr('disabled',true);
            $getJsonBtn.find('.now-loading img').show();
            $getJsonBtn.find('.current-status:first').text('Please wait ...');
        }else{
            $getJsonBtn.removeAttr('disabled');
            $rssUrl.removeAttr('readonly');
            $previewResult.removeAttr('disabled');
            $getJsonBtn.find('.now-loading img').hide();
            $getJsonBtn.find('.current-status:first').text('Convert to JSON');
        }
    }

    function fixModalHeight(){
        var possibleHeignt = $( window ).height() - 130;
        $sourceCode.css({height:(possibleHeignt-40)});
        $outPut.css({height:possibleHeignt});
    }
    function isUrl( value ) {
        return /^(?:(?:(?:https?):)?\/\/)(?:\S+(?::\S*)?@)?(?:(?!(?:10|127)(?:\.\d{1,3}){3})(?!(?:169\.254|192\.168)(?:\.\d{1,3}){2})(?!172\.(?:1[6-9]|2\d|3[0-1])(?:\.\d{1,3}){2})(?:[1-9]\d?|1\d\d|2[01]\d|22[0-3])(?:\.(?:1?\d{1,2}|2[0-4]\d|25[0-5])){2}(?:\.(?:[1-9]\d?|1\d\d|2[0-4]\d|25[0-4]))|(?:(?:[a-z\u00a1-\uffff0-9]-*)*[a-z\u00a1-\uffff0-9]+)(?:\.(?:[a-z\u00a1-\uffff0-9]-*)*[a-z\u00a1-\uffff0-9]+)*(?:\.(?:[a-z\u00a1-\uffff]{2,})).?)(?::\d{2,5})?(?:[/?#]\S*)?$/i.test( value );
    }


    function rss2json(rss_url,callback){
        if(CURR_STATUS == STATUS.BUSY){ return ;}
        CURR_STATUS = STATUS.BUSY;
        nowLoading(true);
        var data = {rss_url : rss_url};
        $.get(API_END_POINT,data,callback,'json')
            .fail(function(){
                alert('something went wrong !');
                nowLoading(false);
                CURR_STATUS = STATUS.READY;
            });
    }

    function resetModal(){
        $sourceCode.val('');
        $modalViewSource.find('span:first').text('View source');
        $sourceCode.fadeOut('fast',function(){
            $outPut.show();
        });
    }

    $modalViewSource.click(function(e){
        e.preventDefault();

        if($sourceCode.is(':visible')){
            resetModal();
        }else{
            $modalViewSource.find('span:first').text('Hide source');
            $sourceCode.val($outPut.data('jjson'));

            $outPut.fadeOut('fast',function(){
                $sourceCode.show();
                $sourceCode.select();
            });

        }

    });
    $mainForm.submit(function (e) {


        var rss_url = $.trim($rssUrl.val());

        if(!isUrl(rss_url)){
            alert('please enter a valid URL');
            $rssUrl.select();
            return false;
        }
        if($previewResult.is(':checked')){
            e.preventDefault();

            rss2json(rss_url,function(data){
                resetModal();
                $outPut.empty().jJsonViewer(data, {expanded: true});
                $modal.modal('show');
                nowLoading(false);
                CURR_STATUS = STATUS.READY;
            });
        }
    });

    $rssUrl.select();
    fixModalHeight();

    $(window).resize(function () {
        fixModalHeight();
    });


    var eml = [109, 111, 99, 46, 110, 111, 115, 106, 50, 115, 115, 114, 64, 111, 108, 108, 101, 104];
    if($('#email-here').size()>0){
        var emlStr = '';
        eml = eml.reverse();
        for(var i in eml){
            emlStr += String.fromCharCode(eml[i]);
        }

        var $a = $('<a>');
        $a.text(emlStr);
        $a.attr('href','mailto:'+emlStr);
        setTimeout(function(){
            $('#email-here').append($a);
        },2000)
    }


    $('#buy_coffee').on('click',function(){
        if(window.ga){
            window.ga('send', 'event', 'Buy coffee Button', 'click');
        }
        $.get('/bcbtn');
            
        
    });

    var getStoredVal = function(k,d){
        d = d || false;
        if(typeof localStorage == 'undefined' || typeof localStorage[k] == 'undefined'){
            return d;
        }

        return localStorage[k];

    }
    var setStoredVal = function(k,v){
        
        if(typeof localStorage == 'undefined'){
            return false;
        }

        localStorage[k] = v;

    }
    

    if(getStoredVal('last_seen',1) < (new Date()*1)){
        setStoredVal('last_seen',(new Date()*1) + (1000 * 60 * 30));
        setTimeout(function(){
            $('.donate_mug:first').addClass('open_mb');
            setTimeout(function(){
                $('.donate_mug:first').removeClass('open_mb');
            },8000)

        },500);

    }
    
    

    

};

var UXstuff = function(){

    $('body').scrollspy({ target: '#header', offset: 400});



    var fixHeader =  function(){
        if ($(window).scrollTop() > 50) {
            $('#header').addClass('navbar-fixed-top');
        }
        else {
            $('#header').removeClass('navbar-fixed-top');
        }
    };

    $(window).bind('scroll', fixHeader);

    fixHeader();


    $('a.scrollto').on('click', function(e){


        var target = this.hash;

        e.preventDefault();

        $('body').scrollTo(target, 800, {offset: -70, 'axis':'y', easing:'easeOutQuad'});

        if ($('.navbar-collapse').hasClass('in')){
            $('.navbar-collapse').removeClass('in').addClass('collapse');
        }

    });
};

jQuery(document).ready(function($) {

    UXstuff();
    rss2jsonApp();
    contactUsApp();

});