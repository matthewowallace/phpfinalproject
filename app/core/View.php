<?php

class View
{
    /**
     * simply includes (=shows) the view. this is done from the controller. In the controller, you usually say
     * $this->view->render('help/index'); to show (in this example) the view index.php in the folder help.
     * Usually the Class and the method are the same like the view, but sometimes you need to show different views.
     * @param string $filename Path of the to-be-rendered view, usually folder/file(.php)
     * @param array $data Data to be used in the view
     */
    public function render($filename, $data = null)
    {        
        // Prepare $data to be accessed in the view.
        if ($data) {
            foreach ($data as $key => $value) {
                $this->{$key} = $value;
            }
        }
        
        require APP . 'views/layouts/header.php';
        require APP . 'views/' . $filename . '.php';
        require APP . 'views/layouts/footer.php';
    }

    /**
     * renders the feedback messages into the view
     */
    public static function renderFeedbackMessages()
    {
        // echo out the feedback messages (errors and success messages etc.),
        // they are in $_SESSION["feedback_positive"] and $_SESSION["feedback_negative"]
        require APP . 'views/layouts/feedback.php';

        // delete these messages (as they are not needed anymore and we want to avoid to show them twice
        Session::set('feedback_positive', null);
        Session::set('feedback_negative', null);
    }

    /**
     * renders the feedback messages into the view
     */
    public static function renderAdminBar($view)
    {
        require APP . 'views/layouts/adminbar.php';
    }
} 
