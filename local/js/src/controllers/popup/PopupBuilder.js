import {SuccessPopup} from "./types/Success";

class PopupBuilder {

    build(params, type) {
        if (type) {
            switch(type) {
                case 'success':
                    return new SuccessPopup(params, type);
            }
        }
    }
}

export {PopupBuilder};