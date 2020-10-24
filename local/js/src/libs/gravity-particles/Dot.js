class Dot {
    constructor(properties, context) {
        this.properties = properties;
        this.positions = {x: this.properties.x, y: this.properties.y};
        this.context = context;
        this.velocity = {x: 0, y: 0};
        this.minRadius = this.properties.minRadius;
        this.maxRadius = this.properties.maxRadius;
        this.radius = this.randomizeRadius();
        this.mass = this.radius * this.properties.strength;
    }

    drawDot() {
        this.positions.x += this.velocity.x;
        this.positions.y += this.velocity.y;
        this.context.beginPath();
        this.context.arc(this.positions.x, this.positions.y, this.radius, 0, 2 * Math.PI);
        this.context.closePath();
        this.context.fillStyle = this.properties.objectColor;
        this.context.fill();
    }

    randomizeRadius() {
        return Math.random() * (this.maxRadius - this.minRadius) + this.minRadius;
    };
}

export {Dot};
