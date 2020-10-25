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
                let openedDropdown = this.$element.find(this.options.dropdown);
                if (!openedDropdown.hasClass('active')) return;
                openedDropdown.toggleClass('active', false);
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