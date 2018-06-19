import $ from "jquery";

class LoginForm {
    constructor() {
        this.loginForm = $(".login-form");
        this.events();
    }

    events() {
        this.loginForm.submit(this.handleFormSubmission.bind(this));
    }

    handleFormSubmission(event) {
        event.preventDefault();

        let self = this;
        let formData = this.grabFormData();

        $.ajax({
            type: "POST",
            url: "/login",
            data: formData,
            dataType: "json",
            beforeSend: self.clearErrors,
            encode: true
        })
            .done(function(response) {
                if (response.error) {
                    self.handleAuthenticationError(response.error);
                }
            })
            .fail(function(data) {
                self.handleValidationErrors(data.responseJSON.errors);
            });
    }

    handleAuthenticationError(error) {
        $(".login-form .auth-error").fadeIn(1000, () => {
            $(".login-form .auth-error").text(`${error}`);
        });
    }

    handleValidationErrors(errors) {
        let errorNames = Object.keys(errors);

        errorNames.forEach( (errorName) => {
            $(`.login-form input[name=${errorName}]`).addClass("is-invalid");
            $(`.login-form .${errorName}-error`).fadeIn(1000, function () {
                $(`.login-form .${errorName}-error`).text(`${errors[errorName]}`);
            })
        });
    }

    grabFormData() {
        return {
            "email": $(".login-form input[name=email]").val(),
            "password": $(".login-form input[name=password]").val(),
            "_token": $(".login-form input[name=_token]").val()
        }
    }

    clearErrors() {
        $(".login-form .invalid-feedback").fadeOut();
        $(".login-form input").removeClass("is-invalid");
    }
}

export default LoginForm;