<?php
class Product
{
    private $sku;
    private $name;
    private $price;
    private $attributes;
    private $front_end;
    private int $lastProductId;



    public function __construct($data)
    { $this->sku = $data['sku'];
        $this->name = $data['name'];
        $this->price = $data['price'];
        $this->front_end = $data['front_end'] ;
        $this->attributes =  $data['attributes'];
    }

    public static function getAll()
    {
        return DB::query("SELECT * FROM product");
    }

    public static function getTypes(){
        return DB::query("SELECT * FROM type");
    }
    public static function getAttributes($id){
        return DB::query("SELECT * FROM attribute where type_id = $id");
    }

    public function add()
    {
        DB::query("INSERT INTO product (sku, name, price,front_end) VALUES 
        (:sku, :name, :price,:front_end)", [
            ':sku' => $this->sku,
            ':name' => $this->name,
            ':price' => $this->price,
            ':front_end' => $this->front_end,
            
        ]);
        $this->lastProductId = DB::productLastId('product')['last'];
        foreach ($this->attributes as $attr){
            DB::query('INSERT INTO `value` (product_id, attribute_id, attribute_value) 
            VALUES (:product_id, :attribute_id, :attribute_value)', [
                ':product_id' => $this->lastProductId,
                ':attribute_id' => $attr['id'],
                ':attribute_value' => $attr['value'],
            ]);
        }
    }

    public static function delete($id)
    {
        return DB::query("DELETE FROM product WHERE id=:id", [':id' => $id]);
    }

}
