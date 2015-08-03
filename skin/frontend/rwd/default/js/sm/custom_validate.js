/**
 * Created by Computer on 8/2/2015.
 */
Validation.add('validate-email-exist', 'Email exist.', function(v) {
    var url = '/customvalidate/index/checkExistEmail/?email=' + encodeURIComponent(v);
    var ok = false;
    new Ajax.Request(url, {
        method: 'get',
        asynchronous: false,
        onSuccess: function(transport) {
            var obj = transport.responseText;
            if (obj == 1) {
                ok = false;
            } else {
                ok = true; /* return true or false */
            }
        },
        onFailure: function(){ alert('something wrong') },
        onComplete: function() {
            if ($('advice-validate-email-email')) {
                $('advice-validate-email-email').remove();
            }
            if ($('advice-validate-email-email_address')) {
                $('advice-validate-email-email_address').remove();
            }
            if ($('advice-validate-email-_accountemail')) {
                $('advice-validate-email-_accountemail').remove();
            }
        }
    });
    return ok;
});

jQuery(document).ready(function(){
        if(jQuery(".configurable-swatch-list").length) {
            jQuery('.btn-cart').attr('disabled', 'disabled');
        }
    jQuery(".configurable-swatch-list li a span").click(function() {
        var ok = 0;
        setTimeout(function(){
            jQuery(".configurable-swatch-list").each(function(v){
                jQuery(this).find('li').each(function(i){
                    if(jQuery(this).hasClass('selected')){
                        ok++;
                        return false;
                    }
                });
            });
            if(ok == jQuery(".configurable-swatch-list").length){
                jQuery('.btn-cart').removeAttr('disabled');
            }
        },100);
    });
});
