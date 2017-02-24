# shortlinks.loc

# Создаем базы
CREATE SCHEMA `shortlink_db` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;

CREATE SCHEMA `test_shortlink_db` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;

# Виртуальный хост настраиваем так, что корнем будет web
пример: DocumentRoot /shortlink.loc/www/web

# Клонируем репозиторий
git clone https://github.com/Dimitrenko/shortlinks.loc ./www

# Переходим в директорию хоста
cd /path/to/shortlink.loc/www

# Даем прав
chmod -R 777 runtime && chmod -R 777 web/assets

# ! ЭТО ВАЖНО
composer update

# Меняем user_name и password
nano ~/shortlink.loc/config/db.php

# Накатываем миграции
/usr/bin/php yii migrate/up

# Для тестовой базы
/usr/bin/php test/bin/yii migrate/up

# Для примера сделал несколько интеграционных тестов для моделей. И простенький приемочный тест (вместо функционального)
# запускаем еще один терминал
ctrl+shift+t
# Для приемочных тестов запускаем selenium-server
/usr/bin/java -jar -Dwebdriver.chrome.driver=chromedriver vendor/se/selenium-server-standalone/bin/selenium-server-standone.jar

# запускаются тесты так:
/usr/bin/php vendor/bin/codecept run

# Так как в компонентах тестировать особенно нечего, решил, что создание для них тестов будет притянуто.

# примечание
Поскольку я тестировал только на локальной машине, то для проверки гео локации поставил заглушку.
Там всего 5 IP. Это дело лежит в app\component\StatComponent метод fakeIP()