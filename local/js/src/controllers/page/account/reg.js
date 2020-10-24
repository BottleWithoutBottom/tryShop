import {Control} from 'can';
import $ from 'jquery';

const RegPage = Control.extend(
    {
        defaults: {

        }
    },
    {
        init() {
        },

        'form submit'(el, ev) {
            ev.preventDefault();
            $.ajax({
                type: 'POST',
                url: '/account/register/',
                dataType: 'json',
                data: $(el).serializeArray(),
                success: function(result) {
                }
            })
        }
    }
);
if (document.querySelector('body').dataset.pageType === 'reg') {
    new RegPage(document.querySelector('body'));
}
export {RegPage}