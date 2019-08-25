import web from 'massive-web';
import $ from 'jquery';

/**
 * Media component.
 */
class Media {
    /**
     * Initialize component.
     *
     * @param {Object} $el
     * @param {Object} options
     * @param {String} options.csrfToken
     */
    initialize($el, options) {
        this.$el = $($el);
        this.$document = $(document);
        this.options = options;

        this.$mediaFile = this.$document.find('.js-media-file');
        this.$mediaFileDelete = this.$document.find('.js-media-file-delete');

        this.bindListeners();
        this.onReady();
    }

    /**
     * Binds event listeners.
     */
    bindListeners() {
        this.$mediaFileDelete.on('click', this.onMediaFileDelete.bind(this));
    }

    /**
     * Ready.
     */
    onReady() {  }

    /**
     * Delete media.
     *
     * @param {Object} e
     */
    onMediaFileDelete(e) {
        let $btnFileDelete = $(e.currentTarget);
        let $mediaFile = $btnFileDelete.closest(this.$mediaFile);

        let objData = {mediaId: $mediaFile.data('id'), 'token': this.options.csrfToken};

        let btnText = $btnFileDelete.html();
        $btnFileDelete.html('Deleting...');

        $.ajax({
            url: '/api/media/delete',
            data: objData,
            type: 'DELETE',
            contentType: 'application/x-www-form-urlencoded',
            error: (data) => {
                /* eslint-disable */
                console.error(data);
                /* eslint-enable */

                $btnFileDelete.html(btnText);
            },
            success: (data) => {
                if (data.success) {
                    $mediaFile.remove();
                } else {
                    $btnFileDelete.html(btnText);
                }
            }
        });
    }
}

web.registerComponent('media', Media);