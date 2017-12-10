var ModDSEC = (function($) {
    'use strict';

    var DSECForms;

    var easyFormObject = function(id, params) {
        this.moduleId = id;
        this.params = params;
    }

    easyFormObject.prototype.initForms = function() {
        DSECForms = $('#ds-easy-contact-form-' + this.moduleId + '.easy-contact-form');
    };

    easyFormObject.prototype.submitForm = function(id, params) {
        DSECForms.each(function(index, item) {
            var form = $(item);

            form.submit(function(e) {
                e.preventDefault();

                var formData = form.serialize();
                formData += '&moduleId=' + id;
                formData += '&recipient=' + params.email_recipient;
                formData += '&fromEmail=' + params.from_email;
                formData += '&sendersname=' + params.from_email_name;
                formData += '&mySubject=' + params.email_subject;

                $.post(form.attr("action"), formData)
                    .done(function(resp) {
                        if (resp == 'OK') {
                            $(".modal-body .modal-ds-easy-contact-message").append("<div class=\'alert alert-success\'><button type=\'button\' data-dismiss=\'alert\' class=\'close\'>×</button><div>Thank you for your message!</div></div>");
                            $(".modal-body .ds-simple-contact-form").hide();
                            $("#modal-ds-easy-contact-box .close, .modal-backdrop").click(function() {
                                $(".modal-ds-easy-contact-message .alert").remove();
                                $(".modal-body .ds-simple-contact-form").show();
                            });
                        } else {
                            $(".modal-body .modal-ds-easy-contact-message").append("<div class=\'alert alert-error\'><button type=\'button\' data-dismiss=\'alert\' class=\'close\'>×</button><div>Error sending message!</div></div>");
                            $(".modal-body .ds-simple-contact-form").hide();
                            $("#modal-ds-easy-contact-box .close, .modal-backdrop").click(function() {
                                $(".modal-ds-easy-contact-message .alert").remove();
                                $(".modal-body .ds-simple-contact-form").show();
                            });
                        }
                    });
            });
        });
    };

    easyFormObject.prototype.init = function() {
        this.initForms();
        this.submitForm(this.moduleId, this.params);
    };

    return {
        easyFormObject: easyFormObject
    }

})(jQuery);