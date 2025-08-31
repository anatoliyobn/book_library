# Как запустить

Склонировать проект

    git clone git@github.com:anatoliyobn/book-library-test.git

Создать файл с энвами

    cp .env-dist .env

Сбилдить контейнеры

    docker compose build

И запустить

    docker compose up -d

Установить пакеты

    docker compose exec php composer install

Выполнить миграции

    docker compose exec php php yii migrate
    docker compose exec php php yii migrate --migrationPath=@yii/rbac/migrations

Зайти в админку минио 

    http://127.0.0.1:9090

и добавить бакет с названием `yii2-image`

Зайти на сайт

    http://127.0.0.1:8102


Не успел прописать права на доступы - но в этом ничего сложного нет, просто уже и так было потрачено достаточно времени.