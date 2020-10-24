
class Mouse {
    constructor(properties, context) {
        this.context = context;
        this.isPressed = false;
        this.x = properties.w / 2;
        this.y = properties.h / 2;
    }

    setPositions(e) {
        this.x = e.clientX;
        this.y = e.clientY;
        return {x: this.x, y: this.y};
    };

    press() {
        this.isPressed = !this.isPressed;
    };
}

export {Mouse}