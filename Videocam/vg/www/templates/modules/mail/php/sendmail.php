<?php
// Подключим composer, defines
require_once __DIR__ .'/../../../../../system/defines.php';
require_once __DIR__ .'/../../../../../system/vendor/autoload.php';

// e-mail кому отправить
$emailto = _ADMIN_EMAIL_;

// Получим данные
$data = $_POST;

// Если включена капча, то проверяем капчу
if(_RECAPTCHA_){
    if(!\core\ReCaptcha::instance()->checkRecaptcha()){
        echo json_encode(['error' => 1, 'data' => 'Ошибка капчи']);
        exit();
    }
}

// Проверим поле на пустоту
if(empty($data['email'])){
    echo json_encode(['error' => 1, 'data' => 'Введите email']);
    exit();
}

if(empty($data['fio'])){
    echo json_encode(['error' => 1, 'data' => 'Введите Имя']);
    exit();
}

if(empty($data['phone'])){
    echo json_encode(['error' => 1, 'data' => 'Введите телефон']);
    exit();
}

$message = '<p>Новое сообщение с формы обратной связи.</p>';

// Прикрепим все данные из формы
$message .= \modules\mail\services\sMail::instance()->getBlockBuffer($data);


\core\PHPMail::instance()->sendSMTPMail($emailto, 'Новое сообщение с сайта '.$_SERVER['HTTP_HOST'], $message);

echo json_encode(['error' => 0, 'data' => 'Сообщение успешно отправлено']);
exit();