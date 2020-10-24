import {Control} from 'can';
import $ from 'jquery';

const Header = Control.extend({
        defaults: {
            headerIcon: '.js-header-icon',
            dropdown: '.js-dropdown',
        }
    },
    {
        init() {
            this.$element = $(this.element);
        },

        '{window} click'(el, ev) {
            let underMouse = $(ev.target);
            if (
                !underMouse.hasClass(this.options.headerIcon)
                || !underMouse.closest(this.options.headerIcon)
            ) {
                this.$element.find(this.options.dropdown).toggleClass('active', false);
            }
        },

        '.js-header-icon click'(el) {
            let dropdown = el.querySelector(this.options.dropdown);
            if (dropdown) {
                dropdown.classList.toggle('active');
            }
        }
    }
);

export {Header}