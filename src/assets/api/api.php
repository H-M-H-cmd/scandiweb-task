<?php




function cors(){
    // Allow from any origin
    if (isset($_SERVER['HTTP_ORIGIN'])) {
        // Decide if the origin in $_SERVER['HTTP_ORIGIN'] is one
        // you want to allow, and if so:
        header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Max-Age: 86400');    // cache for 1 day
    }
    
    // Access-Control headers are received during OPTIONS requests
    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
        
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
            // may also be using PUT, PATCH, HEAD etc
            header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
        
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
            header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
    
        exit(0);
    }
}

cors();

spl_autoload_register(function ($class_name) {
    if(file_exists("./models/$class_name.php"))
    {
        require_once "./models/$class_name.php";
    }
    else if(file_exists("./controllers/$class_name.php"))
    {
        require_once "./controllers/$class_name.php";
    }
});


$action='';
$res = [];
$err = [];
function check($i){
    if($i == ''){
        $i = null;
    } 
    return $i;
}

if (isset($_GET['action'])) {
	
	$action=$_GET['action'];
}
if($action == 'getAll'){
    $result = Product::all();
    if(empty($result)){
        $res = [];
    }else {
            $res = $result;
    }
}
else if($action == 'addProduct'){
   
  
    $attr = json_decode($_POST['attributes'],true); //array
    $_POST['attributes'] = $attr;
    $type = $_POST['type'];
    $product = new $type();
    $result = $product->productValidate();
    if($result != 'succes'){
        $res['errors'] = $result; 
    }
    // print_r($result);
}

else if($action == 'delete'){
    $arr = explode(",",$_POST['toDeleteArray']);
    print_r($arr);
    foreach ($arr as $id) {
        $res  =  ProductController::delete($id);
        $res= 'success';
    }
}

else if($action == 'getTypes'){
    $types = ProductController::getTypes();
    $res = $types;
}
else if($action == 'getAttributes'){
    $attr = ProductController::getAttributes($_GET['type_id']);
    
    $res = $attr;
}

header("Content-type: application/json");
echo json_encode($res,JSON_FORCE_OBJECT);
// print_r($res);
die();

?>