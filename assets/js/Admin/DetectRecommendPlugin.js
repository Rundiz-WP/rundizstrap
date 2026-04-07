/* 
 * Detect recommend plugin notice functional.
 * 
 * @package rundizstrap
 * @since 0.0.2
 */


class RundizStrapDetectRecommendPlugin {


    /**
     * Class constructor.
     */
    constructor() {
        this.#listenClickDismiss();
    }// constructor


    /**
     * Listen click dismiss notice about recommend plugin.
     */
    #listenClickDismiss() {
        document.addEventListener('click', async (event) => {
            const thisTarget = event.target;
            if (thisTarget.closest('#rundizstrap-dismiss-recommend-plugin .notice-dismiss')) {
                event.stopImmediatePropagation();
                const formData = new URLSearchParams();
                formData.append('action', 'rundizstrap_detect_recommend_plugin_dismiss');
                formData.append('nonce', RundizstrapHookDetectRecommendPluginObj.nonce);
                formData.append('dismiss', '1');

                try {
                    const response = await fetch(ajaxurl, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                        },
                        body: formData.toString(),
                    });

                    const result = await response.json();
                    console.debug('[rundizstrap]:' + result.data.message);

                    const noticeElement = thisTarget.closest('#rundizstrap-dismiss-recommend-plugin');
                    if (noticeElement) {
                        noticeElement.remove();
                    }
                } catch (error) {
                    console.error('[rundizstrap error]:', error);
                }
            }// endif;
        });
    }// #listenClickDismiss


}// RundizStrapDetectRecommendPlugin


// on dom ready. ================================
document.addEventListener('DOMContentLoaded', () => {
    new RundizStrapDetectRecommendPlugin();
});