<?

namespace local\modules\Composite\Elementor;

abstract class FormElement {
    protected $name;
    protected $title;
    protected $data;

    public function __construct(string $name, string $title) {
        $this->name = $name;
        $this->title = $title;
    }

    public function getName(): string {
        if (!$this->name) return '';

        return $this->name;
    }

    public function setData($data) {
        $this->data = $data;
    }

    public function getData() {
        return $this->data;
    }

    abstract public function render();
}