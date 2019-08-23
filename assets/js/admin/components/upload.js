import web from 'massive-web';
import $ from 'jquery';
import Dropzone from 'Dropzone';


/**
 * Upload component.
 */
class Upload {
    /**
     * Initialize component.
     *
     * @param {Object} $el
     * @param {Object} options
     */
    initialize($el, options) {
        this.$el = $el;
        this.$document = $(document);
        this.options = options;

        this.classDropzoneFrom = 'js-dropzone';

        this.bindListeners();
        this.onReady();
    }

    /**
     * Binds event listeners.
     */
    bindListeners() {  }

    /**
     * Ready.
     */
    onReady() {
        Dropzone.autoDiscover = false;
        let myDropzone = new Dropzone("." + this.classDropzoneFrom, {
            url: "/api/media/upload"
        });

        myDropzone.on('sending', (file, xhr, formData) => {
            formData.append('folderId', this.options.folderId);
        });
    }
}

web.registerComponent('upload', Upload);