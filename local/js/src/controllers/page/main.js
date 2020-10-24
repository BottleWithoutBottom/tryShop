import {Control} from 'can';
import {Generator} from '../../libs/particles/Generator';
import {Gravity} from '../../libs/gravity-particles/Gravity';
import $ from 'jquery';
// import 'jquery-parallax.js';

const MainPage = Control.extend(
    {
        defaults: {

        }
    },
    {
        init() {
            this.particles = new Generator({
                selector: '.page-wrapper',
                backgroundColor: 'rgba(256, 256, 256, 1)',
                particleColor: 'rgba(100, 0, 100, 1)',
                particleRadius: 3,
                particlesCount: 15,
                lineLength: 100,
            });

            // this.gravityParticles = new Gravity({
            //     selector: 'body',
            //     canvasColor: 'rgba(0, 0, 0, 1)',
            //     maxRadius: 20,
            //     minRadius: 6,
            //     speed: 0.5,
            //     strength: 0.001,
            //     objectColor: 'rgba(239, 145, 100, 1)',
            //     smooth: 0.95,
            //     repulsion: 150,
            // });
        },

        '{window} resize'() {
            this.particles.resize();
        },

        '.js-menu-toggle click'() {
            this.element.querySelector('.js-menu').classList.toggle('active');
        }


    }
);
if (document.querySelector('body').dataset.pageType === 'main') {
    new MainPage(document.querySelector('body[data-page-type=main]'));

}
export {MainPage}