import {SuccessPopup} from "./types/Success";

/* Для того, чтобы иницализировать вызов попапа нужно:
*
* 1) создать объект класса PopupBuilder
* 2) Вызвать метод билд, передать в него необходимые параметры: Список допустимых параметров указан в Base.js,
* вторым аргументом передать тип попапа
* 3) Вызвать метод .generate()
* 4) Для отмены попапа вызвать метод .destroyPopup();
*
*  */
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