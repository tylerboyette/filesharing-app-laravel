import $ from "jquery";

class LoginForm {
    constructor() {
        this.loginForm = $("#login-form");
        this.closeButton = this.loginForm.find(".close");
        this.events();
    }

    events() {
        this.loginForm.submit(this.handleFormSubmission.bind(this));
        this.closeButton.click(this.clearErrors.bind(this));
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
            beforeSend: self.clearErrors.bind(self),
            encode: true
        })
            .done(function(response) {
                if (response.error) {
                    self.handleAuthenticationError(response.error);
                } else {
                    window.location.href = "/";
                }
            })
            .fail(function(data) {
                self.handleValidationErrors(data.responseJSON.errors);
            });
    }

    handleAuthenticationError(error) {
        this.loginForm.find(".auth-error").fadeIn(1000, function() {
            $(this).text(`${error}`);
        });
    }

    handleValidationErrors(errors) {
        let errorNames = Object.keys(errors);

        errorNames.forEach( (errorName) => {
            this.loginForm.find(`input[name=${errorName}]`).addClass("is-invalid");
            this.loginForm.find(`.${errorName}-error`).fadeIn(1000, function() {
               $(this).text(`${errors[errorName]}`);
            });
        });
    }

    grabFormData() {
        return {
            "email": $("#loginEmail").val(),
            "password": $("#loginPassword").val(),
        }
    }

    clearErrors() {
        this.loginForm.find(".invalid-feedback").fadeOut();
        this.loginForm.find("input").removeClass("is-invalid");
    }
}

export default LoginForm;