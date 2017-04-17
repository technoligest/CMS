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
                    identical:{
                        field: 'user_password',
                        message: 'Passwords don\'t match'
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
             forSaleBy: {
                validators: {
                    notEmpty: {
                        message: 'The gender is required'
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
});