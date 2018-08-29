import $ from "jquery";

class CommentForm {
    constructor() {
        this.commentForm = $("#comment-form");
        this.replyLinks = $(".reply-link");
        this.events();
    }

    events() {
        this.commentForm.submit(this.handleFormSubmission.bind(this));
        this.replyLinks.each(function() {
            $(this).click(function() {
               $(this).siblings(".reply-form").toggleClass("reply-form--is-visible");
            });
        })
    }

    handleFormSubmission(event) {
        let self = this;
        event.preventDefault();

        let formData = this.grabFormData();

        $.ajax({
            type: "POST",
            url: "/comments",
            data: formData,
            dataType: "json",
            beforeSend: self.clearErrors.bind(self),
            encode: true,
            success: function(response) {
                console.log("All fine");
            }
        })
            .fail(function(data) {
                self.handleValidationErrors(data.responseJSON.errors);
            });
    }

    handleValidationErrors(errors) {
        let errorNames = Object.keys(errors);

        errorNames.forEach( (errorName) => {
            $(`#comment-${errorName}`).addClass("is-invalid");
            this.commentForm.find(`.comment-${errorName}-error`).fadeIn(1000, function() {
               $(this).text(`${errors[errorName]}`);
            });
        });
    }

    clearErrors() {
        this.commentForm.find(".invalid-feedback").fadeOut();
        this.commentForm.find("textarea").removeClass("is-invalid");
    }

    grabFormData() {
        return {
            "content": $("#comment-content").val(),
            "file_id": $("#comment-file_id").val()
        }
    }
}

export default CommentForm;