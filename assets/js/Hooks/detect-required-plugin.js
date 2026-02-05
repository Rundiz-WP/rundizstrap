/* 
 * Work with `DetectRequiredPlugin` class.
 * 
 * @package bootstrap-basic-fse
 * @since 0.0.1
 * @license http://opensource.org/licenses/MIT MIT
 */


class BootstrapBasicFSEDetectRequiredPlugin {


    /**
     * Class constructor.
     * 
     * @since 0.0.1
     */
    constructor() {
        this.#moveAlertsToTop();
    }// constructor


    /**
     * Move alerts to top.
     * 
     * @since 0.0.1
     * @returns {undefined}
     */
    #moveAlertsToTop() {
        const alerts = document.querySelectorAll('.bootstrap-basic-fse-detect-required-plugin');
        const siteMainColumn = document.querySelector('.site-main-column');

        if (alerts && siteMainColumn) {
            alerts.forEach((item) => {
                siteMainColumn.insertAdjacentHTML('afterbegin', item.outerHTML);
                item.remove();
            });
        }

        if (!siteMainColumn) {
            console.warn('The HTML `.site-main-column` is not exists on this page.');
        }
    }// #moveAlerstToTop


}// BootstrapBasicFSEDetectRequiredPlugin


document.addEventListener('DOMContentLoaded', () => {
    new BootstrapBasicFSEDetectRequiredPlugin();
});
