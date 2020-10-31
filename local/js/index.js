import {BasePage} from './src/controllers/page/base';
import {MainPage} from './src/controllers/page/main';
import {RegPage} from './src/controllers/page/account/reg';
import {CategoriesPage} from './src/controllers/page/catalog/categories';
import {Header} from './src/controllers/partials/header';
import {BasePopup} from "./src/controllers/popup/Base";
import {PopupBuilder} from "./src/controllers/popup/PopupBuilder";
new Header(document.querySelector('body'));

let popup = new PopupBuilder().build({
        message: 'Алеее',
        cancel: 'Отмена',
        success: 'Ок',
    }, 'success').generate();
