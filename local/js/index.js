import {BasePage} from './src/controllers/page/base';
import {MainPage} from './src/controllers/page/main';
import {RegPage} from './src/controllers/page/account/reg';
import {Header} from './src/controllers/partials/header';

new Header(document.querySelector('body'));

let pageType = document.querySelector('body').dataset.pageType;

