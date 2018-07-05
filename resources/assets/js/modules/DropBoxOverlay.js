import $ from "jquery";

class DropBoxOverlay {
    constructor() {
        this.dropZone = $("body").addClass("dropzone");
        this.dropBoxOverlay = $(".dropbox-overlay");
        this.fileInput = $("#file-input");
        this.events();
    }

    events() {
        this.dropZone.on("dragenter dragover dragleave drop", this.preventDefaults.bind(this));
        this.dropZone.on("dragenter dragleave drop", this.toggleDropBoxOverlayVisibility.bind(this));
        this.dropZone.on("drop", this.handleFileDrop.bind(this));
    }

    toggleDropBoxOverlayVisibility () {
        this.dropBoxOverlay.toggleClass("dropbox-overlay--visible")
    }

    handleFileDrop(e) {
        let file = e.originalEvent.dataTransfer.files[0];

        this.fileInput.fileinput("readFiles", [file]);
    }

    preventDefaults(e) {
        e.preventDefault();
        e.stopPropagation();
    }
}

export default DropBoxOverlay;