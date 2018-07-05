
/**
 * First, we will load all of this project's Javascript utilities and other
 * dependencies. Then, we will be ready to develop a robust and powerful
 * application frontend using useful Laravel and JavaScript libraries.
 */

require('./bootstrap');
import $ from "jquery";
import RegistrationForm from "./modules/RegistrationForm";
import LoginForm from "./modules/LoginForm";
import DropBoxOverlay from "./modules/DropBoxOverlay";

$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
    }
});
let registrationForm = new RegistrationForm();
let loginForm = new LoginForm();

let isAdvancedUpload = function() {
    let div = document.createElement("div");
    return (('draggable' in div) ||
            ('ondragstart' in div && 'ondrop' in div))
            && 'FormData' in window
            && 'FileReader' in window;
}();

if ($(".dropbox-overlay").length && isAdvancedUpload) {
    let dropBoxOverlay = new DropBoxOverlay();
    console.log("hi");
}

$("#file-input").fileinput({
    theme: "fas",
    uploadUrl: "/upload",
    showUploadedThumbs: false,
    showPreview: false,
    elErrorContainer: ".file-upload-errors",
    maxFileCount: 1
});

