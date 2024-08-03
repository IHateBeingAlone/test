<?php

$message = "Имя: $_POST[name]\nТелефон: $_POST[phone]\nКомментарий: $_POST[message]\nТовар: $_POST[item]\nАдрес страницы: $_POST[url]\nIP адрес: $_POST[ip]";
mail('test@example.com', 'Информация о заказе', $message);
echo json_encode($_POST);

?>