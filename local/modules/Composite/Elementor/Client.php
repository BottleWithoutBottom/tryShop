<?

namespace local\modules\Composite\Elementor;

class Client {
    public function generateloginForm(): FormElement {
        $form = new Form('login', 'login', '/account/authorize/', 'POST');
        $form->addElement(new Input('login', 'login', 'text'));
        $form->addElement(new Input('password', 'password', 'password'));
        $form->addElement(new Input('remember', 'remember', 'checkbox'));
        $form->addElement(new Button('Отправить'));

        return $form;
    }

    public function renderLoginForm(FormElement $form) {
        if (empty($form)) return false;

        echo $form->render();
        return true;
    }
}