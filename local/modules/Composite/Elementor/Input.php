<?
namespace local\modules\Composite\Elementor;
use local\modules\Composite\Elementor\FormElement;

class Input extends FormElement {
    protected $type;

    public function __construct(string $name, string $title, string $type) {
        parent::__construct($name, $title);

        $this->setType($type);
    }

    public function setType($type) {
        $this->type = $type;
    }

    public function render() {
        if (empty($this->name) || empty($this->type)) return false;

        return "<label for='{$this->name}'>
                    {$this->title}
                    <input type='{$this->type}' name='{$this->name}' value='{$this->data}'>
            </label>";
    }
}