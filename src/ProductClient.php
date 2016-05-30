<?php

namespace App;

class ProductClient
{
    public function getProducts()
    {
        $products = [];
        $client = new \GuzzleHttp\Client();
        $res = $client->request('GET', 'http://product.dev/list', [

        ]);
        
        if ($res->getStatusCode() == 200){
        
            $json = $res->getBody()->read(1024000);
            $serializer = new \Itav\Component\Serializer\Serializer();
            $products = $serializer->unserialize($json, Product::class . '[]');
            return  $products;
        }
        return $products;
    }
    
    public function getTaxes()
    {
        $taxes = [];
        $client = new \GuzzleHttp\Client();
        $res = $client->request('GET', 'http://product.dev/list/tax', [

        ]);
        
        if ($res->getStatusCode() == 200){
        
            $json = $res->getBody()->read(1024000);
            $serializer = new \Itav\Component\Serializer\Serializer();
            $taxes = $serializer->unserialize($json, Tax::class . '[]');
            return  $taxes;
        }
        return $taxes;
    }    
    
    /**
     * @param Product $product 
     * @return Form\Select
     */
    public function getSelectProduct($product)
    {
        $select = new \Itav\Component\Form\Select();
        $client = new \GuzzleHttp\Client();
        $res = $client->get('http://product.dev/form');
        
        if ($res->getStatusCode() == 200){
        
            $json = $res->getBody()->read(1024000);
            $serializer = new \Itav\Component\Serializer\Serializer();
            $serializer->unserialize($json, \Itav\Component\Form\Select::class, $select);
        }
        return $select;
    }  
}