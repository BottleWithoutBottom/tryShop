<?

namespace local\modules\Composite\Elementor;
use local\modules\Composite\Elementor\FormElement;

abstract class ElementComposite extends FormElement {
    protected $elements = [];

    public function addElement(FormElement $element) {
        if (empty($element)) return false;
        $name = $element->getName();
        $this->elements[$name] = $element;

        return true;
    }

    public function removeElement(FormElement $component) {
        if (empty($component)) return false;

        $this->elements = array_filter($this->elements, function ($childComponent) use ($component) {
            return $childComponent != $component;
        });

        return true;
    }

    public function setData($data) {
        if (empty($data)) return false;

        foreach ($this->elements as $name => $element) {
            if (isset($data[$name])) {
                $element->setData($data[$name]);
            }
        }
        return true;
    }

    public function getData() {
        $data = [];

        foreach($this->elements as $name => $element) {
            $data[$name] = $element;
        }

        return $data;
    }

    public function render() {
        if (!count($this->elements)) return false;
        $finalHTML = '';

        foreach ($this->elements as $name => $element) {
            $finalHTML .= $element->render();
        }

        return $finalHTML;
    }
}