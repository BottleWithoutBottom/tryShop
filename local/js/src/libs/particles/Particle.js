class Particle {
    constructor(context, w, h, color = 'rgba(256, 0, 0, 1)', radius = 3, speed = 0.5) {
        this.w = w;
        this.h = h;
        this.context = context;
        this.x = Math.random() * this.w;
        this.y = Math.random() * this.h;
        this.speedX = Math.random() * (speed * 2) - speed;
        this.speedY = Math.random() * (speed * 2) - speed;
        this.radius = radius;
        this.color = color;
    }

    draw = () => {
        this.context.beginPath();
        this.context.arc(this.x, this.y, 3, 0, 2 * Math.PI);
        this.context.closePath();
        this.context.fillStyle = this.color;
        this.context.fill();
    };

    changePosition = () => {
        this.sumX = this.x += this.speedX;
        this.sumY = this.y += this.speedY;
        (this.sumX > this.w && this.sumX > 0)
        || (this.sumX < this.w && this.sumX < 0) ? this.speedX*= - 1 : this.speedX;

        (this.sumY > this.h && this.sumY > 0)
        || (this.sumY < this.h && this.sumY < 0) ? this.speedY*= - 1 : this.speedY;
        this.x += this.speedX;
        this.y += this.speedY;
    }
}

export {Particle}