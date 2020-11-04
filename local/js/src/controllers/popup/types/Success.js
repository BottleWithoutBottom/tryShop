import {BasePopup} from "../Base";

class SuccessPopup extends BasePopup {
    constructor(params) {
        super(params);
        this.params = params;
    }

    generate() {
        this.createWrap();
        this.createLayout();
        this.createWindow();
        this.createInterface();
        this.createControllers();
        this.popupWindow.classList.add('js-success-window');
        let successText = document.createElement('div');
        successText.classList.add('popup-window-text');
        successText.innerHTML = this.message;
        this.setCancelBtn();
        this.setSuccessBtn();

        this.popupWrap = this.appendNode(this.popupWrap, this.popupLayout);

        this.popupInterface = this.appendNode(this.popupInterface, successText);

        this.popupControllers = this.appendNode(this.popupControllers, this.successButton);

        this.popupWindow = this.appendNode(this.popupWindow, [this.popupInterface, this.popupControllers]);

        this.popupWrap = this.appendNode(this.popupWrap, this.popupWindow);
        this.setStyles();
        this.initPopup(document.querySelector('body'), this.popupWrap);
    }

    setSuccessBtn() {
        this.successButton = document.createElement('a');
        this.setLinkHref(this.successButton, this.params.successLink);
        this.successButton.classList.add(this.classes.popupControllersButtonClass);
        this.successButton.classList.add('success');
        this.successButton.innerHTML = this.success;
    }
}

export {SuccessPopup};