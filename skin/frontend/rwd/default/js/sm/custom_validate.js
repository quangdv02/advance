/**
 * Created by Computer on 8/2/2015.
 */
Validation.add('validate-email-exist', 'Email exist.', function(v) {
    var url = '/customvalidate/index/checkExistEmail/email?email=' + encodeURIComponent(v);
    var ok = false;
    new Ajax.Request(url, {
        method: 'get',
        asynchronous: false,
        onSuccess: function(transport) {
            //alert(transport.responseText);
            console.log(transport.responseText);
            var obj = response = eval('(' + transport.responseText + ')');
            validateTrueEmailMsg = obj.status_desc;
            if (obj.ok === false) {
                Validation.get('validate-email').error = validateTrueEmailMsg;
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