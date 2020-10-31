class BasePopup {
    constructor(params, type) {
        /**
         * layoutIsSet - bool
         * layoutColor - rgba, string
         * layoutOpacity - string
         * message - string
         * cancel - string
         *
         * */
        this.message = params.message ? params.message : '';
        this.success = params.success ? params.success : '';
        this.cancel =    params.cancel ? params.cancel : '';

        this.type = type ? type : 'success';
        this.layoutIsSet = params.layoutIsSet ? params.layoutIsSet : true;
        this.layoutColor = params.layoutColor ? params.layoutColor : '#000';
        this.layoutOpacity = params.layoutOpacity ? params.layoutOpacity : '.5';
        this.windowColor = params.windowColor ? params.windowColor : '#fff';

        /* Неотъемлемые части для любого попапа */

        this.popupWrap = document.createElement('div');
        this.popupWrap.classList.add('popup-container');
        this.popupLayout = document.createElement('div');
        this.popupLayout.classList.add('popup-layout');

        this.popupWindow = document.createElement('div');
        this.popupWindow.classList.add('popup-window');

        this.popupInterface = document.createElement('div');
        this.popupInterface.classList.add('popup-window-interface');

        this.popupControllers = document.createElement('div');
        this.popupControllers.classList.add('popup-window-controllers');
    }

    generate() {
        /* overridable */
    }

    appendNode(parent, child) {
        if (!parent instanceof Element || !child instanceof Element) return;

        if (child.length) {
            for (let i = 0; i < child.length; i++) {
                parent.append(child[i]);
            }
        } else {
            parent.append(child);
        }
        return parent;
    }

    initPopup(element, popup) {
        this.appendNode(element, popup);
    }
}

export {BasePopup};