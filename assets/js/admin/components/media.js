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
     */
    initialize($el) {
        this.$el = $($el);
        this.$document = $(document);

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
    onReady() {  }
}

web.registerComponent('media', Media);