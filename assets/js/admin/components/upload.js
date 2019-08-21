import web from 'massive-web';
import $ from 'jquery';
// import Dropzone from 'Dropzone';


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


        this.bindListeners();
    }

    /**
     * Binds event listeners.
     */
    bindListeners() {
        console.log('Upload starting');
    }
}

web.registerComponent('upload', Upload);
