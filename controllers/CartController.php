<?php
    
    
    class CartController
    {
        /**
         * Action добавление в корзину товара
         * @param $productId ID товара
         * @return bool
         */
        public function addtocartAction($productId)
        {
            if(isset($productId)) {
                $resData = CartModel::addProduct($productId);
            }
           
           echo json_encode($resData);
           
           return true;
        }
        
        /**
         * Action главной страницы
         */
        public function indexAction()
        {
            $categories = array();
            $categories = CategoryModel::getCategoriesList();
            
            $productsIdInCart = array();
            $products = array();
            $totalPrice = 0;
            
            $productsIdInCart = CartModel::getProducts();
            
            
            if ($productsIdInCart) {
                $products = ProductModel::getProductItemsByIds($productsIdInCart);
                $totalPrice = CartModel::getTotalPrice($products);
            } else {
                $products = false;
            }
            
            require_once(ROOT . '/views/site/cart/cart.php');
            
            return true;
        }
    
        /**
         * Action удаление с корзины товара
         * @param $productId
         * @return bool
         */
        public function removeCartAction($productId){
            if(isset($productId)) {
                $resData = CartModel::removeProduct($productId);
            }
    
            echo json_encode($resData);
    
            return true;
        }
    
    
        /**
         * Action оформления заказа
         * @return bool|void
         */
        public function checkoutAction()
        {
        
            // Список категорий для левого меню
            $categories = array();
            $categories = CategoryModel::getCategoriesList();
            
            $productsIdInCart = array();
            $productsIdInCart = CartModel::getProducts();
    
            if (! $productsIdInCart){
                redirect('/cart/');
                return;
            }
            
            $productsInCart = ProductModel::getProductItemsByIds($productsIdInCart);
            
            $amountProduct = array();
            foreach ($productsIdInCart as $product) {
                $postVar = 'quantity_' . $product;
    
    
                $amountProduct[$product] =  isset($_POST[$postVar]) ? intval($_POST[$postVar]) : null;
            }
    
            $i = 0;
            foreach ($productsInCart as &$product) {
                $product['cnt'] = isset($amountProduct[$product['id']]) ? $amountProduct[$product['id']] : 0;
                if ($product['cnt']) {
                    $product['realPrice'] = $product['cnt'] * $product['price'];
                } else {
                    unset($productsInCart[$i]);
                    }
                $i++;
                }
            
            // получений масив покупаємих товаров помешаем в сессионую переменою
            $_SESSION['saleCart'] = $productsInCart;
           
            $userName = false;
            $userPhone = false;
            $userComment = false;
    
            // Пользователь авторизирован?
            if (UserModel::isGuest()) {
                // Нет
                // Значения для формы пустые
            } else {
                // Да, авторизирован
                // Получаем информацию о пользователе из БД по id
                $userId = UserModel::checkLogged();
                $user = UserModel::getUserById($userId);
                // Подставляем в форму
                $userName = $user['name'];
            }
            
        
            require_once(ROOT . '/views/site/cart/checkout.php');
        
            return true;
        }
    
        /**
         * AJAX функция сохранения заказа
         *
         * @param array #_SESSION['saleCart'] масив покупаемих товаров
         * @return json инфомация о результате виполнения
         */
      public function saveorderAction(){
          // Список категорий для левого меню
          $categories = array();
          $categories = CategoryModel::getCategoriesList();
          
            // получаем масив покупаемих товаров
            $cart = isset($_SESSION['saleCart']) ? $_SESSION['saleCart'] : null;
            //если корзина пуста, то формируем ответ с ошибкой, отдаем его в формате
            // json и виходим из функции
            if (! $cart){
                $resData['success'] = 0;
                $resData['message'] = 'Нет товаров для заказа';
    
                redirect ("/cart/");
                
                return;
            }
        
            $name = $_POST['userName'];
            $phone = $_POST['userPhone'];
            $comment = $_POST['userComment'];
    
        
          
            // Создаем новий заказ и получаєм ево id
            $orderId = OrderModel::makeNewOrder($name, $phone, $comment);
            
            // если заказ не создан, то видайом ошибку и завершаєм функцию
            if (! $orderId){
                $resData['success'] = 0;
                $resData['message'] = 'Ошибка создания заказа';
                return;
            }
            
            // Сохраняэм закази для созданого заказа
            $res = PurchaseModel::setPurchaseForOrder($orderId, $cart);
        
            // если успешно, то формируем ответ і удаляем перемение корзини
            if ($res){
                $resData['success'] = 1;
                $resData['message'] = 'Заказ сохраньон';
                unset($_SESSION['saleCart']);
                unset($_SESSION['cart']);
            }  else{
                $resData['success'] = 0;
                $resData['message'] = 'Внесение даних для заказа № ' . $orderId;
            }
    
          require_once(ROOT . '/views/site/cart/order.php');
    
          return true;
        }
        
    }