<?

namespace local\modules\Composite\Elementor;
use local\modules\Composite\Elementor\ElementComposite;

class Form extends ElementComposite {
    protected $url;
    protected $method;
    CONST AVAILABLE_METHODS = ['POST', 'GET'];

    public function __construct(string $name, string $title, string $url, string $method) {
        parent::__construct($name, $title);

        $this->url = $url;
        $this->method = $method;
    }

    public function render() {
        if (!in_array($this->method, self::AVAILABLE_METHODS)) return false;
        $finalHTML = parent::render();

        return "<form action='{$this->url}' method='{$this->method}'>{$finalHTML}</form>";
    }
}