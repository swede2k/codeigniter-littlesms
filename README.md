#codeigniter-littlesms

Расширение для Codeigniter по работе с API сервиса [LittleSMS.ru].

##Установка

Загрузите codeigniter-littlesms с github.
Скопировать директорию application в корневую директорию Вашего фреймворка.
В ```application/config/sms.php``` измените следующие строки:

```php
$config['login'] = 'test@test.com'; 			//Логин
$config['apiKey'] = '12345';					//Ключ API
$config['sender'] = 'Test';						//Имя отправителя
```

##Использование

```php
$this->load->model("smsmodel"); //Загружаем модель
$this->smsmodel->request('79260000000', 'Текст сообщения');
```
##Changelog

### Версия 1.0

- Первая версия

[LittleSMS.ru]: http://littlesms.ru
[1]: http://littlesms.ru/doc
