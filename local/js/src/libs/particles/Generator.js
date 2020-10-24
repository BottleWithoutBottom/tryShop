import {Particle} from './Particle';

class Generator {
    /*
    * properties = {
    *   selector
    *   backgroundColor (rgba)
    *   particleColor (rgba)
    *   particleRadius (int)
    *   particlesCount (int)
    *   speed (int)
    *   lineLength (int)
    * */
    constructor(properties) {
        this.ctx;
        this.selector;
        this.particles = [];

        this.properties = properties;
        this.particlesCount = (this.properties.particlesCount) ? this.properties.particlesCount : 60;
        this.particleColor = (this.properties.particleColor) ? this.properties.particleColor : 'rgba(83,0,0, 1)';
        this.lineLength = (this.properties.lineLength) ? this.properties.lineLength : 100;
        this.selector = (this.properties.selector) ? document.querySelector(this.properties.selector) : document.querySelector('body');

        this.canvas = document.createElement('canvas');
        this.canvas.classList.add('background-particles');
        this.resize();
        this.createCtx();
        this.selector.appendChild(this.canvas);
        this.spawnParticles();
        this.drawParticles();

        this.init();
    }

    init = () => {
        this.spawnParticles();
        this.loop();
    };

    loop = () => {
        this.drawBackground();
        this.drawParticles();
        this.drawLines();
        window.requestAnimationFrame(this.loop);
    };

    resize = () => {
        this.w = this.canvas.width = window.innerWidth;
        this.h = this.canvas.height = window.innerHeight;
    };

    drawBackground = () => {
        if (this.ctx) {
            this.ctx.fillStyle = this.properties.backgroundColor;
            this.ctx.fillRect(0, 0, this.w, this.h);
        }
    };

    drawParticles = () => {
        for (let i in this.particles) {
            this.particles[i].changePosition();
            this.particles[i].draw();
        }
    };

    drawLines = () => {
        let xStart, xEnd, yStart, yEnd, length;
        for (let i in this.particles) {
            for (let j in this.particles) {
                xStart = this.particles[i].x;
                yStart = this.particles[i].y;
                xEnd = this.particles[j].x;
                yEnd = this.particles[j].y;
                length = Math.sqrt(Math.pow(xEnd - xStart, 2) + Math.pow(yEnd - yStart, 2));
                if (length < this.lineLength) {
                    let opacity = 1 - length / this.lineLength;
                    this.ctx.lineWidth = 0.5;
                    this.ctx.strokeStyle = `rgba(100, 0, 100, ${opacity})`;
                    this.ctx.beginPath();
                    this.ctx.moveTo(xStart, yStart);
                    this.ctx.lineTo(xEnd, yEnd);
                    this.ctx.closePath();
                    this.ctx.stroke();
                }
            }
        }
    };

    spawnParticles = () => {
        let i = 0;
        while(i < this.particlesCount) {
            this.particles.push(new Particle(this.ctx, this.w, this.h, this.particleColor));
            i++;
        }
    };

    createCtx = () => {
        this.ctx = this.canvas.getContext('2d');
    };

}

export {Generator}