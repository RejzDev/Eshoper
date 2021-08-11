<?php
    
    
    
    class ProductController
    {
    
        /**
         * Action страницы товара
         * @param $productId ID товара
         * @return bool
         */
        public function viewAction($productId)
        {
            
            $categories = array();
            $categories = CategoryModel::getCategoriesList();
            
            $product = ProductModel::getProductItemById($productId);
            
            require_once(ROOT . '/views/site/product/view.php');
        
            return true;
        }
        
        
        
    }