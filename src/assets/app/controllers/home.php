<?php
class Home extends Controller
{
    public $content = "Content-type: application/json";
    

    public function getData(){
            $res = Product::getAll();
            header($this->content);
            echo json_encode($res,JSON_FORCE_OBJECT);
            die();                
    }

    public  function getTypes(){
            $res = ProductController::getTypes();
            header($this->content);
            echo json_encode($res,JSON_FORCE_OBJECT);
            die(); 
    }
    public  function getAttributes(){
        $attr = ProductController::getAttributes($_GET['type_id']);  
        $res = $attr;        
        header($this->content);
        echo json_encode($res,JSON_FORCE_OBJECT);
        die(); 
    }
    public function delete(){
        $arr = explode(",",$_POST['toDeleteArray']);
        print_r($arr);
        foreach ($arr as $id) {
            ProductController::delete($id);
        }
    }
    public  function addProduct(){
        $attr = json_decode($_POST['attributes'],true); //array
        $_POST['attributes'] = $attr;
        $type = $_POST['type'];
        $product = new $type();
        $result = $product->productValidate();
        if($result != 'success'){
            $res['errors'] = $result; 
        }
        header($this->content);
        echo json_encode($res,JSON_FORCE_OBJECT);
        die(); 
    }
}
