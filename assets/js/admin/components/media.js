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

        // Media File.
        this.$mediaFile = this.$el.find('.js-media-file');
        this.$mediaFileDelete = this.$el.find('.js-media-file-delete');

        //Folder.
        this.$addFolder = this.$el.find('.js-media-add-folder');
        this.$contentFormAddFolder = this.$el.find('.js-content-form-add-folder');
        this.$formAddFolder = this.$el.find('.js-form-add-folder');
        this.$allFolders = this.$el.find('.js-media-index-folders');
        this.$folderCopy = this.$el.find('.js-media-index-folder.copy');
        this.$folder = this.$el.find('.js-media-index-folder');

        //Class.
        this.classOpen = 'open';
        this.classCopy = 'copy';

        this.bindListeners();
        this.onReady();
    }

    /**
     * Binds event listeners.
     */
    bindListeners() {
        this.$mediaFileDelete.on('click', this.onMediaFileDelete.bind(this));
        this.$addFolder.on('click', this.onTogglerFormAddFolder.bind(this));
        this.$formAddFolder.on('submit', this.onFormAddFolderSubmit.bind(this));
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

    onTogglerFormAddFolder() {
        this.$contentFormAddFolder.toggleClass(this.classOpen);
    }

    /**
     * Delete media.
     *
     * @param {Object} e
     */
    onFormAddFolderSubmit(e) {
        e.preventDefault();

        let $form = $(e.currentTarget);
        let objData = $form.serialize();
        let $submit = $form.find('[type=submit]');

        let btnText = $submit.html();
        $submit.html('Sending...');

        $.ajax({
            url: '/api/folder',
            data: objData,
            type: 'POST',
            contentType: 'application/x-www-form-urlencoded',
            error: (data) => {
                /* eslint-disable */
                console.error(data);
                /* eslint-enable */

                $submit.html(btnText);
            },
            success: (data) => {
                if (data.success) {
                    $form.find('[name=name]').val('');
                    $submit.html(btnText);

                    this.$contentFormAddFolder.removeClass(this.classOpen);
                    this.appendFolderAfterSubmit(data);
                }
            }
        });
    }

    /**
     * Append folder in the page after submit.
     *
     * @param {Object} data
     */
    appendFolderAfterSubmit(data) {
        this.$allFolders.prepend(
            this.$folderCopy
                .clone(true)
                .removeClass(this.classCopy)
                .attr('data-id', data.folder.id)
        );

        // Set name.
        let $folder = this.$allFolders.find('[data-id=' + data.folder.id + ']');
        $folder.find('.js-media-index-folder-name').text(data.folder.name);

        // Set link.
        let $link = $folder.find('.js-media-index-folder-link');
        let $linkHref = $link.attr('href');
        $link.attr('href', $linkHref + '?folder=' + data.folder.id);
    }
}

web.registerComponent('media', Media);