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
        event.preventDefault();

        let formData = {
            "username": $("input[name=username]").val(),
            "email": $("input[name=email]").val(),
            "password": $("input[name=password]").val(),
            "password_confirmation": $("input[name=password_confirmation]").val(),
            "_token": $("input[name=_token]").val()
        };

        $.ajax({
            type: "POST",
            url: "/register",
            data: formData,
            dataType: "json",
            encode: true
        })
            .done(function (data) {
                console.log(data);
            })
            .fail(function(data) {
                let errors = data.responseJSON;
                console.log(errors.errors.email);
            });
    }
}

export default RegistrationForm;



