<?php header("Content-type: application/javascript"); ?>

    $(document).ready(function () {
    $('#contact_form').bootstrapValidator({
        // To use feedback icons, ensure that you use Bootstrap v3.1.0 or later
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            user_firstname: {
                validators: {
                    stringLength: {
                        min: 2,
                    },
                    notEmpty: {
                        message: 'Please supply your first name'
                    }
                }
            },
            user_lastname: {
                validators: {
                    stringLength: {
                        min: 2,
                    },
                    notEmpty: {
                        message: 'Please supply your last name'
                    }
                }
            },
            user_email: {
                validators: {
                    notEmpty: {
                        message: 'Please supply your email address'
                    },
                    emailAddress: {
                        message: 'Please supply a valid email address'
                    }
                }
            },
            user_phone: {
                validators: {
                    notEmpty: {
                        message: 'Please supply your phone number'
                    },
                    phone: {
                        country: 'US',
                        message: 'Please supply a vaild phone number with area code'
                    }
                }
            },
            user_address: {
                validators: {
                    stringLength: {
                        min: 8,
                    },
                    notEmpty: {
                        message: 'Please supply your street address'
                    }
                }
            },
            user_city: {
                validators: {
                    stringLength: {
                        min: 4,
                    },
                    notEmpty: {
                        message: 'Please supply your city'
                    }
                }
            },
            user_province: {
                validators: {
                    notEmpty: {
                        message: 'Please select your province'
                    }
                }
            },
            user_role: {
                validators: {
                    notEmpty: {
                        message: 'Please select a role'
                    }
                }
            },
            postalCode: {
                validators: {
                    notEmpty: {
                        message: 'Please supply your postal code code'
                    },
                    zipCode: {
                        country: 'CA',
                        message: 'Please supply a vaild postal code code'
                    }
                }
            },
            comment: {
                validators: {
                    stringLength: {
                        min: 10,
                        max: 200,
                        message: 'Please enter at least 10 characters and no more than 200'
                    },
                    notEmpty: {
                        message: 'Please supply a description of your project'
                    }
                }
            },
            user_username: {
                validators:{
                    stringLength:{
                        min:5,
                        max:25,
                        message: 'Please input a username thats between 5 and 25 characters'
                    },
                    notEmpty: {
                        message: 'Please supply a username'
                    }
                }
            },
            user_password:{
                validators:{
                    stringLength:{
                        min:8,
                        message:'Please input a password that\'s at least 8 characters'
                    },
                    regexp:{
                        regexp: '^(?=.*?[a-z])(?=.*?[A-Z])(?=.*?[$@$!%*?&])(?=.*?[0-9]).{8,}$',
                        message: 'Make sure password includes lowercase, uppercase, number and special character'
                    },
                    identical:{
                        field: 'user_confirm_password',
                        message: 'Passwords don\'t match'
                    },
                    notEmpty:{
                        message: 'Please input a password'
                    }
                }
            },
            user_confirm_password:{
                validators:{
                    stringLength:{
                        min:8,
                        message:'Please input a password that\'s at least 8 characters'
                    },
                    regexp:{
                        regexp: '^(?=.*?[a-z])(?=.*?[A-Z])(?=.*?[$@$!%*?&])(?=.*?[0-9]).{8,}$',
                        message: 'Make sure password includes lowercase, uppercase, number and special character'
                    },
                    notEmpty:{
                        message: 'Please input a password'
                    }
                }
            },
            user_image:{
                validators:{
                    file:{
                        extension: 'JPG,jpg,JPEG,jpeg,PNG,png',
                        message: 'only extenstions allowd are jpg and png, max size is 2MB',
                        maxSize: 1024*1024*2,
                    }
                }
            }
        }
    })
        .on('success.form.bv', function (e) {
        $('#success_message').slideDown({ opacity: "show" }, "slow") // Do something ...
        $('#contact_form').data('bootstrapValidator').resetForm();

        // Prevent form submission
        e.preventDefault();

        // Get the form instance
        var $form = $(e.target);

        // Get the BootstrapValidator instance
        var bv = $form.data('bootstrapValidator');

        // Use Ajax to submit form data
        $.post($form.attr('action'), $form.serialize(), function (result) {
            console.log(result);
        }, 'json');
    });
    $('#post_ad_form').bootstrapValidator({
        framework: 'bootstrap',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        // Since the Bootstrap Button hides the radio and checkbox
        // We exclude the disabled elements only
        excluded: ':disabled',
        // To use feedback icons, ensure that you use Bootstrap v3.1.0 or later
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            ad_type:{
                validators:{
                    notEmpty:{
                        message: 'Please choose are you selling or buying'
                    }
                }
            },
            ad_price: {
                validators: {
                    greaterThan: {
                        value:0,
                        message: 'Please enter a valid price.'
                    },
                    notEmpty: {
                        message: 'Please enter a price.'
                    }
                }
            },
            for_sale_by: {
                validators: {
                    notEmpty: {
                        message: 'Please choose if you are a business or individual'
                    }
                }
            },
            ad_title:{
                validators:{
                    notEmpty:{
                        message: 'Plase input a title for your ad'
                    }
                }
            },
            ad_description:{
                validators:{
                    notEmpty:{
                        message: 'Please input a description for your ad'
                    }
                }
            },
            ad_location:{
                validators:{
                    notEmpty:{
                        message: 'Please select a city for you ad'
                    }
                }
            },
            ad_email: {
                validators: {
                    notEmpty: {
                        message: 'Please supply your email address'
                    },
                    emailAddress: {
                        message: 'Please supply a valid email address'
                    }
                }
            },
            ad_phone: {
                validators: {
                    notEmpty: {
                        message: 'Please supply your phone number'
                    },
                    phone: {
                        country: 'US',
                        message: 'Please supply a vaild phone number with area code'
                    }
                }
            }
        }
    })
        .on('success.form.bv', function (e) {
        $('#success_message').slideDown({ opacity: "show" }, "slow") // Do something ...
        $('#contact_form').data('bootstrapValidator').resetForm();

        // Prevent form submission
        e.preventDefault();

        // Get the form instance
        var $form = $(e.target);

        // Get the BootstrapValidator instance
        var bv = $form.data('bootstrapValidator');

        // Use Ajax to submit form data
        $.post($form.attr('action'), $form.serialize(), function (result) {
            console.log(result);
        }, 'json');
    });
    $('#login_form').bootstrapValidator({
        // To use feedback icons, ensure that you use Bootstrap v3.1.0 or later
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            username: {
                validators: {
                    emailAddress: {
                        message: 'Please supply a valid email'
                    }
                }
            },
            password: {
                validators: {
                    notEmpty: {
                        message: 'Please supply your password'
                    }
                }
            }
        }
    })
        .on('success.form.bv', function (e) {
        $('#success_message').slideDown({ opacity: "show" }, "slow") // Do something ...
        $('#contact_form').data('bootstrapValidator').resetForm();

        // Prevent form submission
        e.preventDefault();

        // Get the form instance
        var $form = $(e.target);

        // Get the BootstrapValidator instance
        var bv = $form.data('bootstrapValidator');

        // Use Ajax to submit form data
        $.post($form.attr('action'), $form.serialize(), function (result) {
            console.log(result);
        }, 'json');
    });

    $('#signup_form').bootstrapValidator({
        // To use feedback icons, ensure that you use Bootstrap v3.1.0 or later
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            username: {
                validators: {
                    emailAddress: {
                        message: 'Please supply a valid email'
                    }
                }
            },
            password: {
                validators: {
                    stringLength:{
                        min:8,
                        message:'Please input a password that\'s at least 8 characters'
                    },
                    regexp:{
                        regexp: '^(?=.*?[a-z])(?=.*?[A-Z])(?=.*?[$@$!%*?&])(?=.*?[0-9]).{8,}$',
                        message: 'Make sure password includes lowercase, uppercase, number and special character'
                    },
                    notEmpty:{
                        message: 'Please input a password'
                    }
                }
            },
            password2: {
                validators: {
                    notEmpty: {
                        message: 'Please supply your password'
                    },
                    identical:{
                        field: 'password',
                        message: 'Passwords don\'t match'
                    }
                }
            }
        }
    })
        .on('success.form.bv', function (e) {
        $('#success_message').slideDown({ opacity: "show" }, "slow") // Do something ...
        $('#contact_form').data('bootstrapValidator').resetForm();

        // Prevent form submission
        e.preventDefault();

        // Get the form instance
        var $form = $(e.target);

        // Get the BootstrapValidator instance
        var bv = $form.data('bootstrapValidator');

        // Use Ajax to submit form data
        $.post($form.attr('action'), $form.serialize(), function (result) {
            console.log(result);
        }, 'json');
    });

    // enable fileuploader plugin
    $('input[name="files"]').fileuploader({
        changeInput: '<div class="fileuploader-input">' +
        '<div class="fileuploader-input-inner">' +
        '<img src="filer-uploader/images/fileuploader-dragdrop-icon.png">' +
        '<h3 class="fileuploader-input-caption"><span>Drag and drop files here</span></h3>' +
        '<p>or</p>' +
        '<div class="fileuploader-input-button"><span>Browse Files</span></div>' +
        '</div>' +
        '</div>',
        theme: 'dragdrop',
        upload: {
            url: 'filer-uploader/php/upload_pictures.php',
            data: null,
            type: 'POST',
            enctype: 'multipart/form-data',
            start: true,
            synchron: true,
            beforeSend: null,
            onSuccess: function(result, item) {
                var data = JSON.parse(result);

                // if success
                if (data.isSuccess && data.files[0]) {
                    item.name = data.files[0].name;
                }

                // if warnings
                if (data.hasWarnings) {
                    for (var warning in data.warnings) {
                        alert(data.warnings);
                    }

                    item.html.removeClass('upload-successful').addClass('upload-failed');
                    // go out from success function by calling onError function
                    // in this case we have a animation there
                    // you can also response in PHP with 404
                    return this.onError ? this.onError(item) : null;
                }

                item.html.find('.column-actions').append('<a class="fileuploader-action fileuploader-action-remove fileuploader-action-success" title="Remove"><i></i></a>');
                setTimeout(function() {
                    item.html.find('.progress-bar2').fadeOut(400);
                }, 400);
            },
            onError: function(item) {
                var progressBar = item.html.find('.progress-bar2');

                if(progressBar.length > 0) {
                    progressBar.find('span').html(0 + "%");
                    progressBar.find('.fileuploader-progressbar .bar').width(0 + "%");
                    item.html.find('.progress-bar2').fadeOut(400);
                }

                item.upload.status != 'cancelled' && item.html.find('.fileuploader-action-retry').length == 0 ? item.html.find('.column-actions').prepend(
                    '<a class="fileuploader-action fileuploader-action-retry" title="Retry"><i></i></a>'
                ) : null;
            },
            onProgress: function(data, item) {
                var progressBar = item.html.find('.progress-bar2');

                if(progressBar.length > 0) {
                    progressBar.show();
                    progressBar.find('span').html(data.percentage + "%");
                    progressBar.find('.fileuploader-progressbar .bar').width(data.percentage + "%");
                }
            },
            onComplete: null,
        },
        onRemove: function(item) {
            $.post('filer-uploader/php/remove_pictures.php', {
                file: item.name
            });
        },
        captions: {
            feedback: 'Drag and drop files here',
            feedback2: 'Drag and drop files here',
            drop: 'Drag and drop files here'
        },
    });
});