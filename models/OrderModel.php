<?php
    
    
    class OrderModel
    {
    
        /**
         * Сохранения заказа
         * @param $name
         * @param $phone
         * @param $comment
         * @return bool|string
         */
        public static function makeNewOrder($name, $phone, $comment)
        {
            $db = Db::getConnection();
            $userId = $_SESSION['user'];
        
            $sql = 'INSERT INTO orders (user_name, user_phone, user_comment, user_id) VALUES (:user_name, :user_phone, :user_comment, :user_id)';
        
            $result = $db->prepare($sql);
            $result->execute(array(
                ':user_name' => $name,
                ':user_phone' => $phone,
                ':user_comment' => $comment,
                ':user_id' => $userId,
            ));
        
            if ($result) {
                return $db->lastInsertId();
            }
        
            return false;
        
        }
    
        /**
         * Возвращает список заказов
         * @return array <p>Список заказов</p>
         */
        public static function getOrdersList()
        {
            // Соединение с БД
            $db = Db::getConnection();
        
            // Получение и возврат результатов
            $result = $db->query('SELECT id, user_name, user_phone, date, status FROM orders ORDER BY id DESC');
            $ordersList = array();
            $i = 0;
            while ($row = $result->fetch()) {
                $ordersList[$i]['id'] = $row->id;
                $ordersList[$i]['user_name'] = $row->user_name;
                $ordersList[$i]['user_phone'] = $row->user_phone;
                $ordersList[$i]['date'] = $row->date;
                $ordersList[$i]['status'] = $row->status;
                $i++;
            }
            return $ordersList;
        }
    
        /**
         * Возвращает текстое пояснение статуса для заказа :<br/>
         * <i>1 - Новый заказ, 2 - В обработке, 3 - Доставляется, 4 - Закрыт</i>
         * @param integer $status <p>Статус</p>
         * @return string <p>Текстовое пояснение</p>
         */
        public static function getStatusText($status)
        {
            switch ($status) {
                case '1':
                    return 'Новый заказ';
                    break;
                case '2':
                    return 'В обработке';
                    break;
                case '3':
                    return 'Доставляется';
                    break;
                case '4':
                    return 'Закрыт';
                    break;
            }
        }
    
        /**
         * Возвращает заказ с указанным id
         * @param integer $id <p>id</p>
         * @return array <p>Массив с информацией о заказе</p>
         */
        public static function getOrderById($id)
        {
            // Соединение с БД
            $db = Db::getConnection();
        
            // Текст запроса к БД
            $sql = 'SELECT * FROM orders WHERE id = :id';
        
            $result = $db->prepare($sql);
            $result->bindParam(':id', $id, PDO::PARAM_INT);
        
            // Указываем, что хотим получить данные в виде массива
            $result->setFetchMode(PDO::FETCH_ASSOC);
        
            // Выполняем запрос
            $result->execute();
        
            // Возвращаем данные
            return $result->fetch();
        }
    
        /**
         * Удаляет заказ с заданным id
         * @param integer $id <p>id заказа</p>
         * @return boolean <p>Результат выполнения метода</p>
         */
        public static function deleteOrderById($id)
        {
            // Соединение с БД
            $db = Db::getConnection();
        
            // Текст запроса к БД
            $sql = 'DELETE FROM orders WHERE id = :id';
        
            // Получение и возврат результатов. Используется подготовленный запрос
            $result = $db->prepare($sql);
            $result->bindParam(':id', $id, PDO::PARAM_INT);
            return $result->execute();
        }
    
        /**
         * Редактирует заказ с заданным id
         * @param integer $id <p>id товара</p>
         * @param string $userName <p>Имя клиента</p>
         * @param string $userPhone <p>Телефон клиента</p>
         * @param string $userComment <p>Комментарий клиента</p>
         * @param string $date <p>Дата оформления</p>
         * @param integer $status <p>Статус <i>(включено "1", выключено "0")</i></p>
         * @return boolean <p>Результат выполнения метода</p>
         */
        public static function updateOrderById($id, $userName, $userPhone, $userComment, $date, $status)
        {
            // Соединение с БД
            $db = Db::getConnection();
        
            // Текст запроса к БД
            $sql = "UPDATE orders
            SET user_name = :user_name,
                user_phone = :user_phone,
                user_comment = :user_comment,
                date = :date,
                status = :status
            WHERE id = :id";
        
            // Получение и возврат результатов. Используется подготовленный запрос
            $result = $db->prepare($sql);
            $result->bindParam(':id', $id, PDO::PARAM_INT);
            $result->bindParam(':user_name', $userName, PDO::PARAM_STR);
            $result->bindParam(':user_phone', $userPhone, PDO::PARAM_STR);
            $result->bindParam(':user_comment', $userComment, PDO::PARAM_STR);
            $result->bindParam(':date', $date, PDO::PARAM_STR);
            $result->bindParam(':status', $status, PDO::PARAM_INT);
            return $result->execute();
        }
    
    

    
    }
    
    