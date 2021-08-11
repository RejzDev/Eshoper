<?php
    
    
    class PurchaseModel
    {
        /**
         * Сохранняет покупки в бд
         * @param $orderId
         * @param $cart
         * @return bool|PDOStatement
         */
        public static function setPurchaseForOrder($orderId, $cart)
        {
            $db = Db::getConnection();
            
            $sql = "INSERT INTO purchase
            (order_id, product_id, price, amount) VALUES (:orderId, :productId, :price, :amount)";
            
           
            $result = $db->prepare($sql);
    
            
            foreach ($cart as $item) {
                $result->execute(array(
                    ':orderId' => $orderId,
                    'productId'  => $item['id'],
                    ':price' => $item['price'],
                    ':amount' => $item['cnt'],
                ));
            }
            
            return $result;
        }
    
        /**
         * Возвращает список покупок
         * @param $orderId
         * @return array
         */
        public static function getPurchaseForOrder($orderId)
        {
            $db = Db::getConnection();
            
            $sql = "SELECT `pe`.*, `ps`.`name`
            FROM purchase as `pe`
            JOIN product as `ps` ON `pe`.product_id = `ps`.id
            WHERE `pe`.order_id = :orderId";
            
            $result = $db->prepare($sql);
            $result->bindParam(':orderId', $orderId, PDO::PARAM_INT);
            $result->setFetchMode(PDO::FETCH_ASSOC);
            $result->execute();
    
            $purchaseList = array();
            $i = 0;
            while ($row = $result->fetch()) {
                $purchaseList[$i]['id'] = $row['id'];
                $purchaseList[$i]['order_id'] = $row['order_id'];
                $purchaseList[$i]['product_id'] = $row['product_id'];
                $purchaseList[$i]['price'] = $row['price'];
                $purchaseList[$i]['amount'] = $row['amount'];
                $i++;
            }
            return $purchaseList;
        }
    }