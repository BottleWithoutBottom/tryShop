const helper = {
     ucFirst(string) {
        if (string) {
            return string[0].toUpperCase() + string.slice(1);
        }
    }
};

export {helper}