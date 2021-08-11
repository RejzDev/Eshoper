<?php
    
    
    class CartModel
    {
        public static function addProduct($productId)
        {
            $product = isset($productId) ? $productId : null;
            if (! $product) return false;
    
            $resData = array();
    
            if (isset($_SESSION['cart']) && array_search($product, $_SESSION['cart']) === false) {
                $_SESSION['cart'][] = $product;
        
                $resData['cntItems'] = count($_SESSION['cart']);
                $resData['success'] = 1;
            } else {
                $resData = 0;
            }
            
            return $resData;
        }
    
        /**
         * Количество товаров в корзине
         * @return int Количество товаров в корзине
         */
        public static function countItems()
        {
            $count = 0;
            if (isset($_SESSION['cart'])) {
                $count = count($_SESSION['cart']);
            }
            
            return $count;
        }
    
        /**
         * Возвращает id товаров
         * @return bool|mixed
         */
        public static function getProducts()
        {
            if (isset($_SESSION['cart'])) {
                $productId = $_SESSION['cart'];
            } else {
                $productId = false;
            }
            
            
            return $productId;
        }
    
        /**
         * Функция подщьота цены
         * @param $products
         * @return float|int
         */
        public static function getTotalPrice($products)
        {
            
           
                $productsInCart = self::getProducts();
                $total = 0;
    
                if ($productsInCart) {
                    foreach ($products as $item) {
                        $total += $item['price'] * 1;
                    }
                }
                return $total;
            
        }
    
        /**
         * Функция удаления продукта с корзини
         * @param $productId ID товара
         * @return array
         */
        public static function removeProduct($productId)
        {
            $product = isset($productId) ? $productId : null;
            if (! $product) exit();
    
            $resData = array();
            
            $key = array_search($product, $_SESSION['cart']);
    
            if ($key !== false){
                unset($_SESSION['cart'][$key]);
                $resData['success'] = 1;
                $resData['cntItems'] = count($_SESSION['cart']);
            } else {
                $resData['success'] = 0;
            }
    
            return $resData;
        }
    
        /**
         * Функция очистки корзини
         */
        public static function clear()
        {
            if (isset($_SESSION['cart'])) {
                unset($_SESSION['cart']);
            }
        }
    }