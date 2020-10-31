import {Control} from 'can';
import $ from 'jquery';

const CategoriesPage = Control.extend(
    {
        defaults: {
            categoryCard: '.js-category-card',
            categoryCardWrapper: '.js-wrapper',
        }
    },
    {
        init() {
        },
    }
);
if (document.querySelector('body').dataset.pageType === 'categories') {
    new CategoriesPage(document.querySelector('body'));
}
export {CategoriesPage}