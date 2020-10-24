import {Mouse} from './Mouse';
import {Dot} from './Dot';

class Gravity {
    /*
    backgroundColor (int)
    *  maxRadius (int)
    *  minRadius (int)
    *  speed (int)
    *  strength (int) *supersmall*
    *  canvasColor (rgba)
    *  objectColor (rgba)
    *  smoot (int)
    *  repulsion (int)
    * */
    constructor(properties) {
        this.w;
        this.h;
        this.dots = [];

        this.properties = properties;
        this.canvas = document.createElement('canvas');
        this.ctx = this.canvas.getContext('2d');
        this.mouse = new Mouse(properties, this.ctx);
        this.resize();

        this.canvas.addEventListener('mousemove', (e) => {
            let positions = this.mouse.setPositions(e);
            this.properties.x = positions.x;
            this.properties.y = positions.y;
        });
        window.addEventListener('mousedown', () => {
            this.mouse.press();
        });
        window.addEventListener('mouseup', () => {
            this.mouse.press();
        });
        document.querySelector('body').appendChild(this.canvas);
        this.init();
    }

    init = () => {
        this.drawBackground();
        this.loop();
    };

    loop = () => {
        this.drawBackground();
        if (this.mouse.isPressed) this.dots.push(new Dot(this.properties, this.ctx));
        this.reforceDots();
        this.dots.forEach((item) => {
            item.drawDot();
        });
        window.requestAnimationFrame(this.loop);
    };

    drawBackground = () => {
        this.ctx.fillStyle = this.properties.canvasColor;
        this.ctx.fillRect(0, 0, this.w, this.h);
    };

    reforceDots() {
        for (let i in this.dots) {
            let gravitySpeed = {x: 0, y: 0};
            for (let j in this.dots) {
                if (i === j) continue;

                let delta = {
                    x: this.dots[j].positions.x - this.dots[i].positions.x,
                    y: this.dots[j].positions.y - this.dots[i].positions.y,
                };
                let distance = Math.sqrt(Math.pow(delta.x, 2) + Math.pow(delta.y, 2)) || 1;
                let force = (distance - this.properties.repulsion) / distance * this.dots[j].mass;

                gravitySpeed.x += delta.x * force;
                gravitySpeed.y += delta.y * force;

                this.dots[i].velocity.x = this.dots[i].velocity.x * this.properties.smooth + gravitySpeed.x * this.dots[i].mass;
                this.dots[i].velocity.y = this.dots[i].velocity.y * this.properties.smooth + gravitySpeed.y * this.dots[i].mass;
            }
        }
    };

    resize = () => {
        this.w = this.canvas.width = window.innerWidth;
        this.h = this.canvas.height = window.innerHeight;
    };
}

export {Gravity}