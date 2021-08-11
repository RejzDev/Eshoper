<?php
    
   
    
    class CatalogController
    {
        /**
         * Action главной страницы
         * @return bool
         */
        public function indexAction()
        {
        
            $categories = array();
            $categories = CategoryModel::getCategoriesList();
        
            $products = array();
            $products = ProductModel::getLatestProducts(6);
        
            require_once(ROOT . '/views/site/catalog/index.php');
        
            return true;
        }
    
        /**
         * Action страницы категорий
         * @param $categoryId ID категории
         * @param int $page Номер страници
         * @return bool
         */
        public function categoryAction($categoryId, $page = 1)
        {
            
            $categories = array();
            $categories = CategoryModel::getCategoriesList();
    
            $categoryProducts = array();
            $categoryProducts = ProductModel::getProductsListByCategory($categoryId, $page);
            
            $total = ProductModel::getTotalProductsInCategory($categoryId);
            
            
            $pagination = new Pagination($total, $page, ProductModel::SHOW_BY_DEFAULT, 'page-');
            
            require_once(ROOT . '/views/site/catalog/category.php');
            
            return true;
        }
        
    }