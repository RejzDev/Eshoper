<?php

/**
 * Контроллер AdminOrderController
 * Управление заказами в админпанели
 */
class AdminOrderController extends AdminBase
{

    /**
     * Action для страницы "Управление заказами"
     */
    public function indexAction()
    {
        // Проверка доступа
        self::checkAdmin();

        // Получаем список заказов
        $ordersList = OrderModel::getOrdersList();

        // Подключаем вид
        require_once(ROOT . '/views/admin/admin_order/index.php');
        return true;
    }

    /**
     * Action для страницы "Редактирование заказа"
     */
    public function updateAction($id)
    {
        // Проверка доступа
        self::checkAdmin();

        // Получаем данные о конкретном заказе
        $order = OrderModel::getOrderById($id);

        // Обработка формы
        if (isset($_POST['submit'])) {
            // Если форма отправлена   
            // Получаем данные из формы
            $userName = $_POST['userName'];
            $userPhone = $_POST['userPhone'];
            $userComment = $_POST['userComment'];
            $date = $_POST['date'];
            $status = $_POST['status'];

            // Сохраняем изменения
            OrderModel::updateOrderById($id, $userName, $userPhone, $userComment, $date, $status);

            // Перенаправляем пользователя на страницу управлениями заказами
            header("Location: /admin/order/view/$id");
        }

        // Подключаем вид
        require_once(ROOT . '/views/admin/admin_order/update.php');
        return true;
    }

    /**
     * Action для страницы "Просмотр заказа"
     */
    public function viewAction($id)
    {
        // Проверка доступа
        self::checkAdmin();

        // Получаем данные о конкретном заказе
        $order = OrderModel::getOrderById($id);
        
        $purchase = PurchaseModel::getPurchaseForOrder($id);

        // Получаем массив с идентификаторами и количеством товаров
        $productsQuantity = array();
        foreach ($purchase as $item) {
            $productsQuantity = array(
                $item['product_id'] => $item['amount'],
            );
        }
        
        
       
        // Получаем массив с индентификаторами товаров
        $productsIds = array_keys($productsQuantity);

        // Получаем список товаров в заказе
        $products = ProductModel::getProductItemsByIds($productsIds);

        // Подключаем вид
        require_once(ROOT . '/views/admin/admin_order/view.php');
        return true;
    }

    /**
     * Action для страницы "Удалить заказ"
     */
    public function deleteAction($id)
    {
        // Проверка доступа
        self::checkAdmin();

        // Обработка формы
        if (isset($_POST['submit'])) {
            // Если форма отправлена
            // Удаляем заказ
            OrderModel::deleteOrderById($id);

            // Перенаправляем пользователя на страницу управлениями товарами
            header("Location: /admin/order");
        }

        // Подключаем вид
        require_once(ROOT . '/views/admin/admin_order/delete.php');
        return true;
    }

}
