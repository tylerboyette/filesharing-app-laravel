import $ from "jquery";

class RegistrationForm {
    constructor() {
        this.registrationForm = $("#register-form");
        this.closeButton = this.registrationForm.find(".close");
        this.events();
    }

    events() {
        this.registrationForm.submit(this.handleFormSubmission.bind(this));
        this.closeButton.click(this.clearErrors.bind(this));
    }

    handleFormSubmission(event) {
        let self = this;
        event.preventDefault();

        let formData = this.grabFormData();

        $.ajax({
            type: "POST",
            url: "/register",
            data: formData,
            dataType: "json",
            beforeSend: self.clearErrors.bind(self),
            encode: true,
            success: function(response) {
                window.location.href = "/";
            }
        })
            .fail(function(data) {
               self.handleValidationErrors(data.responseJSON.errors);
            });
    }

    grabFormData() {
        return {
            "username": $("#username").val(),
            "email": $("#email").val(),
            "password": $("#password").val(),
            "password_confirmation": $("#password_confirmation").val(),
        }
    }

    handleValidationErrors(errors) {
        let errorNames = Object.keys(errors);

        errorNames.forEach( (errorName) => {
            $(`#${errorName}`).addClass("is-invalid");
            this.registrationForm.find(`.${errorName}-error`).fadeIn(1000, function() {
                $(this).text(`${errors[errorName]}`);
            })
        });
    }

    clearErrors() {
        this.registrationForm.find(".invalid-feedback").fadeOut();
        this.registrationForm.find("input").removeClass("is-invalid");
    }
}

export default RegistrationForm;



