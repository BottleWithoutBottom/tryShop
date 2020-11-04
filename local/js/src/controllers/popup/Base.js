class BasePopup {
    constructor(params, type) {
        /**
         * layoutIsSet - bool
         * layoutColor - rgba, string
         * layoutOpacity - string
         * message - string
         * cancel - string
         *
         *
         * successLink - string,
         * */
        this.classes = {
            popupWrap: 'popup-wrap',
            popupLayout: 'popup-layout',
            popupWindow: 'popup-window',
            popupInterface: 'popup-window-interface',
            popupControllers: 'popup-window-controllers',
            popupControllersButtonClass: 'popup-window-button',
            popupControllersButtonCancelClass: 'cancel',
            popupControllersButtonCancelJsClass: 'js-cancel',
        };

        this.message = params.message ? params.message : '';
        this.success = params.success ? params.success : 'Ок';
        this.cancel =  params.cancel ? params.cancel : 'Отмена';

        this.type = type ? type : 'success';
        this.layoutIsSet = params.layoutIsSet ? params.layoutIsSet : true;
        this.layoutColor = params.layoutColor ? params.layoutColor : '#000';
        this.layoutOpacity = params.layoutOpacity ? params.layoutOpacity : '.5';
        this.popupWindowColor = params.popupWindowColor ? params.popupWindowColor : '#fff';
        this.body = document.querySelector('body');
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

    initPopup() {
        this.appendNode(this.body, this.popupWrap);

        this.popupControllersCancelBtn.addEventListener('click', () => {
            this.destroyPopup();
        });
    }

    destroyPopup() {
        if (!this.body.querySelector('.' + this.classes.popupWrap)) return false;

        this.body.removeChild(this.body.querySelector('.' + this.classes.popupWrap));
    }

    /* Набор методов для конструирования */

    createWrap() {
        this.popupWrap = document.createElement('div');
        this.popupWrap.classList.add(this.classes.popupWrap);
    }

    createLayout() {
        this.popupLayout = document.createElement('div');
        this.popupLayout.classList.add(this.classes.popupLayout);
    }

    createWindow() {
        this.popupWindow = document.createElement('div');
        this.popupWindow.classList.add(this.classes.popupWindow);
    }

    createInterface() {
        this.popupInterface = document.createElement('div');
        this.popupInterface.classList.add(this.classes.popupInterface);
    }

    createControllers() {
        this.popupControllers = document.createElement('div');
        this.popupControllers.classList.add(this.classes.popupControllers);
    }

    setCancelBtn() {
        if (this.popupControllers) {
            this.popupControllersCancelBtn = document.createElement('a');
            this.popupControllersCancelBtn.innerHTML = this.cancel;
            this.popupControllersCancelBtn.classList.add(this.classes.popupControllersButtonCancelClass);
            this.popupControllersCancelBtn.classList.add(this.classes.popupControllersButtonCancelJsClass);
            this.setLinkHref(this.popupControllersCancelBtn, 'javascript:void(0)');
            this.popupControllersCancelBtn.classList.add(this.classes.popupControllersButtonClass);
            this.appendNode(this.popupControllers, this.popupControllersCancelBtn);
        }
    }

    /* Метод для стилизации попапа */

    setStyles() {
        this.popupLayout.style.opacity = this.layoutIsSet ? this.layoutOpacity : 0;
        this.popupLayout.style.background = this.layoutColor;
        this.popupWindow.style.background = this.popupWindowColor;
    }

    setLinkHref(link, url) {
        if (!link || !url) return false;
        link.setAttribute('href', url);
        return true;
    }
}

export {BasePopup};