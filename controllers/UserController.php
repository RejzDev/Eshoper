<?php
    
    
    class UserController
    {
        /**
         * Action страницы регестрации
         * @return bool
         */
        public function registerAction()
        {
            
            $name = '';
            $email = '';
            $password = '';
            
            if (isset($_POST['submit'])) {
                $name = $_POST['name'];
                $email = $_POST['email'];
                $password = $_POST['password'];
    
    
                $errors = false;
    
                if (!UserModel::checkName($name)) {
                    $errors[] = 'Имя не должно бить короче 2-х символов';
                }
                if (!UserModel::checkEmail($email)) {
                    $errors[] = 'Неправильний email';
                }
                if (!UserModel::checkPassword($password)) {
                    $errors[] = 'Пароль не должен бить короче 6-ти символов';
                }
                
                if (UserModel::checkEmailExists($email)) {
                    $errors[] = 'Такой email уже использується';
                }
                
                if ($errors == false) {
                    $result = UserModel::register($name, $email, $password);
                    
                }
            }
                require_once(ROOT . '/views/site/user/register.php');
                
                return true;
            }
    
        /**
         * Action страницы входа пользователя
         */
            public function loginAction()
            {
                $email = '';
                $password = '';
                
                if (isset($_POST['submit'])) {
                    $email = $_POST['email'];
                    $password = $_POST['password'];
                    
                    $errors = false;
    
                    if (!UserModel::checkEmail($email)) {
                        $errors[] = 'Неправильний email';
                    }
                    if (!UserModel::checkPassword($password)) {
                        $errors[] = 'Пароль не должен бить короче 6-ти символов';
                    }
                    
                    $userId = UserModel::checkUserData($email, $password);
                    
                    if ($userId == false) {
                        $errors[] = 'Неверние дание для входа на сайт';
                    } else {
                        UserModel::auth($userId);
                        
                        header("Location: /cabinet/");
                    }
                    
                }
                
                require_once(ROOT . '/views/site/user/login.php');
            }
    
        /**
         * Action удаления пользователя из сесии
         */
            public function logoutAction()
            {
                
                unset($_SESSION['user']);
                header("Location: /");
            }
            
    }