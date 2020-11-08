<?

namespace local\modules\Composite\Elementor;

class Button extends FormElement{
    protected $type = 'submit';
    protected $title = 'Отправить';

    public function __construct(string $name, string $title, string $type) {
        parent::__construct($name, $title);

        if (!empty($this->type)) $this->type = $type;
    }

    public function render() {
        if (empty($this->name) || empty($this->type)) return false;

        return "<button type='{$this->type}'>{$this->title}</button>";
    }
}