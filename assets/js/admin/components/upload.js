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
     */
    initialize($el) {
        this.$el = $el;
        this.$document = $(document);

        this.classDropzoneFrom = 'js-dropzone';

        this.bindListeners();
        this.onReady();
    }

    /**
     * Binds event listeners.
     */
    bindListeners() {
        console.log('Upload starting');
    }

    /**
     * Ready.
     */
    onReady() {
        Dropzone.autoDiscover = false;
        let myDropzone = new Dropzone("." + this.classDropzoneFrom, {
            url: "/api/media/add"
        });
    }
}

web.registerComponent('upload', Upload);
