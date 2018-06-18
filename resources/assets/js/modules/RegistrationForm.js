import $ from "jquery";

class RegistrationForm {
    constructor() {
        console.log("Здарова!");
        this.registrationForm = $(".register-form");
        this.events();
    }

    events() {
        this.registrationForm.submit(this.handleFormSubmission.bind(this));
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
            beforeSend: self.clearErrors,
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
            "username": $("input[name=username]").val(),
            "email": $("input[name=email]").val(),
            "password": $("input[name=password]").val(),
            "password_confirmation": $("input[name=password_confirmation]").val(),
            "_token": $("input[name=_token]").val()
        }
    }

    handleValidationErrors(errors) {
        let errorNames = Object.keys(errors);

        errorNames.forEach( (errorName) => {
            $(`input[name=${errorName}]`).addClass("is-invalid");
            $(`.${errorName}-error`).fadeIn(1000, function () {
                $(`.${errorName}-error`).text(`${errors[errorName]}`);
            })
        });
    }

    clearErrors() {
        $(".invalid-feedback").fadeOut();
        $(".register-form input").removeClass("is-invalid");
    }
}

export default RegistrationForm;



