<?php
    
    
    class CabinetController
    {
        public function indexAction()
        {
            
            $userId = UserModel::checkLogged();
            
            $user = UserModel::getUserById($userId);
            
            require_once(ROOT . '/views/site/cabinet/index.php');
            
            return true;
        }
        
        public function editAction()
        {
            $userId = UserModel::checkLogged();
            
            $user = UserModel::getUserById($userId);
            
            $name = $user['name'];
            $password = $user['password'];
            
            $result = false;
            
            if (isset($_POST['submit'])) {
                $name = $_POST['name'];
                $password = $_POST['password'];
                
                $errors = false;
    
                if (!UserModel::checkName($name)) {
                    $errors[] = 'Имя не должно бить короче 2-х символов';
                }
               
                if (!UserModel::checkPassword($password)) {
                    $errors[] = 'Пароль не должен бить короче 6-ти символов';
                }
                
                if ($errors == false) {
                    $result = UserModel::edit($userId, $name, $password);
                }
            }
            
            require_once(ROOT . '/views/site/cabinet/edit.php');
            
            return true;
        }
        
       
    }