<?php



abstract class  ProductController{
    public array $data;
    protected string $front_end;

    public static function getAll(){
        return Product::getAll();
    }    
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
        return $attributes['name'].": ".$attributes['value'].' '.$attributes['unit'];
    }

}



