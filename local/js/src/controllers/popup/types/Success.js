import {BasePopup} from "../Base";

class SuccessPopup extends BasePopup {
    constructor(params) {
        super(params);
    }

    generate() {
        this.popupWindow.classList.add('js-success-window');
        let successText = document.createElement('div');
        successText.classList.add('popup-window-text');
        let successButton = document.createElement('a');
        successButton.classList.add('success-btn');
        this.popupWrap = this.appendNode(this.popupWrap, this.popupLayout);

        this.popupInterface = this.appendNode(this.popupInterface, successText);

        this.popupControllers = this.appendNode(this.popupControllers, successButton);

        this.popupWindow = this.appendNode(this.popupWindow, [this.popupInterface, this.popupControllers]);

        this.popupWrap = this.appendNode(this.popupWrap, this.popupWindow);

        this.initPopup(document.querySelector('body'), this.popupWrap);
    }
}

export {SuccessPopup};