<?php
    
   
    
    class SiteController
    {
        /**
         * Главная страница
         * @return bool
         */
        public function indexAction()
        {
            // Список категорий
            $categories = array();
            $categories = CategoryModel::getCategoriesList();
            
            // Список последних товаров
            $products = array();
            $products = ProductModel::getLatestProducts();
    
            
    
            // Подключаем вид
            require_once(ROOT . '/views/site/index.php');
            return true;
        }
    
        /**
         * Страница контактов
         * @return bool
         */
        public function contactAction()
        {
            $userEmail = '';
            $userText = '';
            $result = false;
            
            if (isset($_POST['submit'])) {
                $userEmail = $_POST['userEmail'];
                $userText = $_POST['userText'];
                
                $errors = false;
                
                if (!UserModel::checkEmail($userEmail)) {
                    $errors[] = 'Неправильний email';
                }
                
                if ($errors == false) {
                    $adminEmail = 'vladimer.patsalyuk@gmail.com';
                    $message = "Текст: {$userText}. от {$userEmail}";
                    $subject = 'Тема письма';
                    $result = mail($adminEmail, $subject, $message);
                    $result = true;
                }
            }
            
            require_once (ROOT . '/views/site/contact.php');
            
            return true;
        }
    }