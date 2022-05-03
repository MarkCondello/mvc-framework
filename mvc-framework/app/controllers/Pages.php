<?php //Controller included in Bootstrap file, Pages is called in Core.php as a default controller
class Pages extends Controller {
    public function __construct(){
        $this->homeModel = $this->model('Home'); // demo Model for gathering data
        $this->userModel = $this->model('User'); // demo Model for gathering data
    }
    //index method this must be included with all controller classes as it is a default method set in Core.php as currentMethod
    public function index(){
        $data = [
            "title"=> "PHP MVC",
            "description" => "A framework built from following the Traversy Object Oriented PHP & MVC course.",
            "link" => "https://www.udemy.com/course/object-oriented-php-mvc/",
            "users" => $this->userModel->getUsers(),
            "posts" => $this->homeModel->getPosts(),
        ];
        $this->view("pages/index", $data);
    }
    //this is called from call_user_func_array
    //if there are no params, the about method will run
    public function about( $params = null ){
        $data = [
            "title"=> "About Us",
            "description" => "Lorem ipsum solem delor",
        ];
        $this->view("pages/about", $data);
        echo " with the about action. Params passed are: " . $params;
    }

    public function contact( $params = null ){
        $data = [
            "title"=> "Contact Us",
            "description" => "Lorem ipsum solem delor...",
        ];
        $this->view("pages/contact", $data);
    }
}