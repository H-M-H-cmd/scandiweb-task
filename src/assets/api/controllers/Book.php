<?php




class Book extends ProductController
{
    public static $errors = [];

    public function productValidate()
    {
        AddProductRequest::validate([
            'sku' => [
                'required' => [],
                'unique' => ['product']
            ],
            'name' => [
                'required' => [],
            ],
            'price' => [
                'required' => [],
                'digits' => [],
            ],
            'type' => [
                'required' => [],
            ],
            'weight' => [
                'required' => [],
                'digits' => [],
            ],
        ]);
        if (count(AddProductRequest::getErrors()) == 0) {
            $_POST['front_end'] = $this->front_end($_POST['attributes']);
            $product = new Product($_POST);
            $product->add();
            return true;
        } else {
            $errors = AddProductRequest::getErrors();
            // $e = json_encode($errors,JSON_FORCE_OBJECT);
            return $errors;
        }
    }
}




?>