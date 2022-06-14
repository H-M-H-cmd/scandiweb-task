<?php


class Furniture extends ProductController {
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
            'height' => [
                'required' => [],
                'digits' => [],
            ],
            'width' => [
                'required' => [],
                'digits' => [],
            ],
            'length' => [
                'required' => [],
                'digits' => [],
            ],

        ]);
        if (count(AddProductRequest::getErrors()) == 0) {
            $_POST['front_end'] = $this->front_end($_POST['attributes']);
            $product = new Product($_POST);
            $product->add();
            return  'succes';
            
        } else {
            $errors = AddProductRequest::getErrors();
            return $errors;
        }
    }
    
    public function front_end($attributes) : string {
        $attributes = (array) $attributes;
        $height = $attributes[0]['value'];
        $length = $attributes[1]['value'];
        $width = $attributes[2]['value'];
        print_r($attributes);
        return "Dimensions" . ': ' .$height . 'x'   . $width . 'x' . $length;
    }
}
