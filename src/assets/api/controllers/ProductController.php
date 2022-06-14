<?php



abstract class  ProductController{
    public array $data;
    protected string $front_end;
    // public function __construct($data){

        // $this->data = $this->sanitizeData($data);
    // }

    public static  function getAttributes($type_id){
        return Product::getAttributes($type_id);
    }
    public static  function getTypes(){
        return Product::getTypes();
    }
    public static function delete($id){
        return Product::delete($id);
    }
    public function front_end($attributes){
        $attributes = $attributes[0];
        $result = $attributes['name'].": ".$attributes['value'].' '.$attributes['unit'];
        return $result;
    }

}



