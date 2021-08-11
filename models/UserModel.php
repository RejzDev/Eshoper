<?php
    
    
    class UserModel
    {
        /**
         * Регистрацыя пользователя
         * @param $name
         * @param $email
         * @param $password
         * @return bool|PDOStatement
         */
        public static function register($name, $email, $password)
        {
            $db = Db::getConnection();
            
            $sql = 'INSERT INTO user (name, email, password) VALUES (:name, :email, :password)';
            
            $result = $db->prepare($sql);
            $result->execute(array(
                ':name' => $name,
                ':email' => $email,
                ':password' => $password,
            ));
            
            return $result;
        }
    
        /**
         * Проверка имени
         * @param $name
         * @return bool
         */
        public static function checkName($name)
        {
            if (strlen($name) >= 2) {
                return true;
            }
            return false;
        }
    
        /**
         * Проверка пароля
         * @param $password
         * @return bool
         */
        public static function checkPassword($password)
        {
            if (strlen($password) >= 6) {
                return true;
            }
            return false;
        }
    
        /**
         * Проверка правильности Email адреса
         * @param $email
         * @return bool
         */
        public static function checkEmail($email)
        {
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                return true;
            }
            return false;
        }
    
        /**
         * Проверка Email адреса в БД
         * @param $email
         * @return bool
         */
        public static function checkEmailExists($email)
        {
            $db = Db::getConnection();
            
            $sql = 'SELECT COUNT(*) FROM user WHERE email = :email';
            $result = $db->prepare($sql);
            $result->bindParam(':email', $email, PDO::PARAM_STR);
            $result->execute();
            
            if ($result->fetchColumn())
                return true;
            return false;
        }
    
        /**
         * Проверка даних пользователя для входа
         * @param $email
         * @param $password
         * @return bool
         */
        public static function checkUserData($email, $password)
        {
            $db = Db::getConnection();
            
            $sql = "SELECT * FROM user WHERE email = :email AND password = :password";
            
            $result = $db->prepare($sql);
            $result->execute(array(
                ':email' => $email,
                ':password' => $password,
            ));
            
            $user = $result->fetch();
            
            if ($user) {
                return $user->id;
            }
            return false;
        }
    
        /**
         * Проверка номера телефона
         * @param $phone
         * @return bool
         */
        public static function checkPhone($phone)
        {
            if (strlen($phone) >= 10) {
                return true;
            }
            return false;
        }
    
        /**
         * Вносим пользователя в сесию
         * @param $userId
         */
        public static function auth($userId)
        {
            
            $_SESSION['user'] = $userId;
        }
    
        /**
         * Проверка вошол ли пользователь на сайт
         * @return mixed
         */
        public static function checkLogged()
        {
            
            if (isset($_SESSION['user'])) {
                return $_SESSION['user'];
            }
            
            header("Location: /user/login");
        }
    
        /**
         * Проверка пользователя
         * @return bool
         */
        public static function isGuest()
        {
            
            $userCheck = (isset($_SESSION['user'])) ? false : true;
            
            return $userCheck;
        }
    
        /**
         * Возвращает дание пользователя
         * @param $userId
         * @return mixed
         */
        public static function getUserById($userId)
        {
            $db =Db::getConnection();
            
            $sql = "SELECT * FROM user WHERE id = :userId";
            
            $result = $db->prepare($sql);
            $result->setFetchMode(PDO::FETCH_ASSOC);
            $result->execute(array(
                'userId' => $userId,
                ));
            
            
            return $result->fetch();
        }
    
        /**
         * Изменение даних пользователя
         * @param $userId
         * @param $name
         * @param $password
         */
        public static function edit($userId, $name, $password)
        {
            $db = Db::getConnection();
            
            $sql = "UPDATE user SET name = :name, password = :password WHERE id = :userId";
            
            $result = $db->prepare($sql);
            $result->execute(array(
               ':name' => $name,
               ':password' => $password,
               ':userId' => $userId,
            ));
            
            return $result;
        }
        
    }