import $ from "jquery";

class DropBoxOverlay {
    constructor() {
        this.dropZone = $("body").addClass("dropzone");
        this.dropBoxOverlay = $(".dropbox-overlay");
        this.events();
    }

    events() {
        this.dropZone.on("dragenter dragover dragleave drop", this.preventDefaults.bind(this));
        this.dropZone.on("dragenter dragleave", this.toggleDropBoxOverlayVisibility.bind(this));
    }

    showDropBoxOverlay() {
        this.dropBoxOverlay.show();
    }

    hideDropBoxOverlay() {
        this.dropBoxOverlay.hide();
    }

    toggleDropBoxOverlayVisibility () {
        this.dropBoxOverlay.toggleClass("dropbox-overlay--visible")
    }

    preventDefaults(e) {
        e.preventDefault();
        e.stopPropagation();
    }
}

export default DropBoxOverlay;