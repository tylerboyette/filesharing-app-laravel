import $ from "jquery";

class CommentForm {
    constructor() {
        this.commentForms = $(".comment-form");
        this.replyLinks = $(".reply-link");
        this.events();
    }

    events() {
        this.commentForms.each((index, form) => {
            $(form).submit(this.preventDefaults);
            $(form).submit(this.handleFormSubmission.bind(this));
        });
        this.replyLinks.each(function() {
            $(this).click(function() {
               $(this).siblings(".reply-form").toggleClass("reply-form--is-visible");
            });
        });
    }

    handleFormSubmission(event) {
        this.targetForm = $(event.target);
        console.log(this.targetForm);
        let self = this;
        let formData = this.grabFormData();

        $.ajax({
            type: "POST",
            url: "/comments",
            data: formData,
            dataType: "json",
            beforeSend: self.clearErrors.bind(self),
            encode: true,
            success: function(response) {
                self.handleSuccess(formData.file_id)
            }
        })
            .fail(function(data) {
                self.handleValidationErrors(data.responseJSON.errors);
            });
    }

    handleSuccess(fileId) {
        this.targetForm.find(".comment-content").val("");
        $(".comment-list-container").load(`/files/${fileId}/comments`, () => {
            this.refreshCommentForms.call(this);
            this.refreshReplyLinks.call(this);
        });
    }

    handleValidationErrors(errors) {
        let errorNames = Object.keys(errors);

        errorNames.forEach( (errorName) => {
            this.targetForm.find(`.comment-${errorName}`).addClass("is-invalid");
            this.targetForm.find(`.comment-${errorName}-error`).fadeIn(1000, function() {
               $(this).text(`${errors[errorName]}`);
            });
        });
    }

    clearErrors() {
        this.targetForm.find(".invalid-feedback").fadeOut();
        this.targetForm.find("textarea").removeClass("is-invalid");
    }

    grabFormData() {
        return {
            "content": this.targetForm.find(".comment-content").val(),
            "file_id": this.targetForm.find(".comment-file_id").val(),
            "parent_id": this.targetForm.find(".comment-parent_id").val() || null
        }
    }

    refreshReplyLinks() {
        this.replyLinks = $(".reply-link");
        this.replyLinks.each(function() {
            $(this).click(function() {
                $(this).siblings(".reply-form").toggleClass("reply-form--is-visible");
            });
        });
    }

    refreshCommentForms() {
        this.commentForms = $(".comment-list-container").find(".comment-form");
        this.commentForms.each((index, form) => {
            $(form).submit(this.preventDefaults);
            $(form).submit(this.handleFormSubmission.bind(this));
        });
    }

    preventDefaults(e) {
       e.stopPropagation();
       e.preventDefault();
    }
}

export default CommentForm;