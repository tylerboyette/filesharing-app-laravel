
/**
 * First, we will load all of this project's Javascript utilities and other
 * dependencies. Then, we will be ready to develop a robust and powerful
 * application frontend using useful Laravel and JavaScript libraries.
 */

require('./bootstrap');
import $ from "jquery";
import RegistrationForm from "./modules/RegistrationForm";
import LoginForm from "./modules/LoginForm";

$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
    }
});
let registrationForm = new RegistrationForm();
let loginForm = new LoginForm();

$("#file-upload-form").fileupload({
    dataType: 'json',
    add: function (e, data) {
        $(".upload-button").click( () => {
            data.submit();
        })
    },
    done: function (e, data) {
        console.log("success");
    }
});
