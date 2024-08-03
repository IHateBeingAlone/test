<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100..900&display=swap" rel="stylesheet">
    <title>Test</title>
</head>
<body>
    <?php
        $items = [
            [
                'image' => '/assets/images/1.jpg',
                'name' => '6.1" Смартфон Apple iPhone 15 128 ГБ',
                'price' => 81899,
            ],
            [
                'image' => '/assets/images/2.jpg',
                'name' => '6.7" Смартфон Apple iPhone 15 Pro Max 256 ГБ',
                'price' => 140399,
            ],
            [
                'image' => '/assets/images/3.jpg',
                'name' => '6.1" Смартфон Apple iPhone 15 Pro 128 ГБ',
                'price' => 112499,
            ],
            [
                'image' => '/assets/images/4.jpg',
                'name' => '6.1" Смартфон Apple iPhone 14 128 ГБ',
                'price' => 72899,
            ],
            [
                'image' => '/assets/images/5.jpg',
                'name' => '6.1" Смартфон Apple iPhone 14 Pro 512 ГБ',
                'price' => 140799,
            ],
            [
                'image' => '/assets/images/6.jpg',
                'name' => '6.7" Смартфон Apple iPhone 14 Pro Max 512 ГБ',
                'price' => 139899,
            ],
            [
                'image' => '/assets/images/7.jpg',
                'name' => '6.7" Смартфон Apple iPhone 13 Pro Max 1024 ГБ',
                'price' => 145199,
            ],
        ];
    ?>
    <div class="main">
        <div class="items">
            <?php foreach($items as $key => $item): ?>
                <div class="item">
                    <img src="<?= $item['image'] ?>" alt="preview" class="preview">
                    <div class="item-info">
                        <span class="item-name"><?= $item['name'] ?></span>
                        <div class="item-buttons">
                            <span class="item-price"><?= number_format($item['price'], 0, '', ' '); ?> ₽</span>
                            <div class="item-count">
                                <div class="item-count__button" data-count="minus">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20">
                                        <rect x="5" y="9" width="10" height="2"/>
                                    </svg>
                                </div>
                                <input data-min="1" data-max="999" min="1" max="999" type="number" value="1" class="item-count__input">
                                <div class="item-count__button" data-count="plus">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M9 11V15H11V11H15V9H11V5H9V9H5V11H9Z"/>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <span class="item-cart" data-count="1" data-price="<?= $item['price'] ?>">В корзину</span>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="debug">
            <span class="debug__name"></span>
            <span class="debug__phone"></span>
            <span class="debug__message"></span>
            <span class="debug__item"></span>
            <span class="debug__url"></span>
            <span class="debug__ip"></span>
        </div>
    </div>

    <div class="modal">
        <div class="modal-background"></div>
        <div class="modal-wrapper">
            <svg class="modal-close" xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M14 1.4L12.6 0L7 5.6L1.4 0L0 1.4L5.6 7L0 12.6L1.4 14L7 8.4L12.6 14L14 12.6L8.4 7L14 1.4Z"/>
            </svg>
            <div class="modal-order">
                <div class="modal-item">
                    <img src="" alt="preview" class="modal-item__image">
                    <div class="modal-item__bottom">
                        <span class="modal-item__name"></span>
                        <span class="modal-item__cost"></span>
                        <div class="modal-item-info">
                            <span class="modal-item__price"></span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="6" height="6" viewBox="0 0 6 6" fill="none">
                                <path d="M1 1L5 5M5 1L1 5" stroke="#2C3031"></path>
                            </svg>
                            <span class="modal-item__count"></span>
                        </div>
                    </div>
                </div>
                <form enctype="multipart/form-data" class="modal-form" action="ajax.php" method="POST">
                    <div class="modal-form__input-wrapper">
                        <label for="name">Имя</label>
                        <input type="text" name="name" id="name" placeholder="Ваше имя">
                    </div>
                    <div class="modal-form__input-wrapper -required">
                        <label for="phone">Телефон*</label>
                        <input class="mask__phone" type="text" name="phone" id="phone" placeholder="Ваш телефон">
                        <span class="modal-form__input-error">неккоректный номер телефона</span>
                    </div>
                    <div class="modal-form__input-wrapper">
                        <label for="message">Комментарий</label>
                        <textarea name="message" id="message" placeholder="Ваш комментарий"></textarea>
                    </div>
                    <button class="modal-submit" type="submit">Оформить заказ</button>
                </form>
            </div>
            <div class="modal-success">
                Заказ успешно отправлен!
            </div>
        </div>
    </div>

    <script type="text/javascript" src="./assets/js/imask.js"></script>
    <script type="text/javascript" src="./assets/js/main.js"></script>
</body>
</html>