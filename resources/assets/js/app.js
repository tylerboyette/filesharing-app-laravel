
/**
 * First, we will load all of this project's Javascript utilities and other
 * dependencies. Then, we will be ready to develop a robust and powerful
 * application frontend using useful Laravel and JavaScript libraries.
 */

require('./bootstrap');
import RegistrationForm from "./modules/RegistrationForm";
import LoginForm from "./modules/LoginForm";
import DropBoxOverlay from "./modules/DropBoxOverlay";
import DetailsTable from "./modules/DetailsTable";
import CommentForm from "./modules/CommentForm";

$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
    }
});
let registrationForm = new RegistrationForm();
let loginForm = new LoginForm();

if ($(".details-table").length) {
    let detailsTable = new DetailsTable();
}

if ($("#comment-form").length) {
    let commentForm = new CommentForm();
}

let isAdvancedUpload = function() {
    let div = document.createElement("div");
    return (('draggable' in div) ||
            ('ondragstart' in div && 'ondrop' in div))
            && 'FormData' in window
            && 'FileReader' in window;
}();

if ($(".dropbox-overlay").length && isAdvancedUpload) {
    let dropBoxOverlay = new DropBoxOverlay();
}

$("#file-input").fileinput({
    theme: "fas",
    uploadUrl: "/upload",
    showUploadedThumbs: false,
    showPreview: false,
    elErrorContainer: ".file-upload-errors",
    maxFileCount: 1
});

$("audio").mediaelementplayer({
    alwaysShowControls: true,
    audioVolume: 'horizontal',
    audioHeight: 40,
    audioWidth: "100%"
});

$("video").mediaelementplayer({
    stretching: "fill"
});
