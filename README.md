# API сервиса бронирования и заказа авиабилетов (Just Fly)

Бэкенд-приложение, разработанное в рамках тестового задания. Реализует REST API для системы регистрации и аутентификации пользователей, управления корзиной бронирования, оформления заказов, а также защищённый административный функционал для управления авиарейсами.

## Технологии

* **PHP 8.3 / Laravel 12** (REST API, Sanctum, Form Requests, Actions, Policies, API Resources)
* **PostgreSQL 15** (реляционная база данных)
* **pgAdmin 4** (веб-интерфейс для управления базой данных)
* **Nginx** (веб-сервер)
* **Docker & Docker Compose** (контейнеризация среды)

## Структура проекта

* `deploy` — файлы конфигурации Docker (`docker-compose.yml`, `Dockerfile`, конфигурация Nginx).
* `project` — исходный код бэкенд-приложения на Laravel.
* `collection` — экспортированная коллекция Postman (`Just Fly API Collection.postman_collection.json`) и файл окружения (`FLIGHT API.postman_environment.json`).

---

## Инструкция по запуску проекта

### 1. Клонирование репозитория

Клонируйте репозиторий на локальный компьютер и перейдите в корневую директорию проекта:

```bash
git clone https://github.com/warfolomeyy/just-fly.git
cd just-fly
```

### 2. Настройка окружения

Создайте файл конфигурации окружения `project/.env` из примера в директории `project/`:

```bash
cp project/.env.example project/.env
```

Откройте `project/.env` и убедитесь, что параметры подключения к базе данных соответствуют конфигурации в `deploy/docker-compose.yml`:

```env
DB_CONNECTION=pgsql
DB_HOST=db
DB_PORT=5432
DB_DATABASE=flight_db
DB_USERNAME=postgres
DB_PASSWORD=the_password
```

### 3. Запуск контейнеров и установка зависимостей

Перейдите в директорию `deploy`, соберите и запустите контейнеры, после чего установите зависимости Composer и сгенерируйте ключ приложения:

```bash
cd deploy
docker compose up -d --build
docker compose exec app composer install
docker compose exec app php artisan key:generate
```

### 4. Миграции и заполнение базы данных

Примените миграции и заполните базу данных тестовыми пользователями и авиарейсами:

```bash
docker compose exec app php artisan migrate --seed
```

После завершения настройки сервисы будут доступны по следующим адресам:
* **REST API:** `http://localhost:8080/api-flight`
* **pgAdmin 4:** `http://localhost:5050` (логин: `admin@admin.com`, пароль: `adminpassword`)

---

## Тестовые учётные записи

**Администратор**
* E-mail: `admin@flight.ru`
* Пароль: `QWEasd123`

**Клиент**
* E-mail: `user@flight.ru`
* Пароль: `password`

---

## Тестирование API

1. Откройте Postman и импортируйте оба файла из директории `collection`:
    * `Just Fly API Collection.postman_collection.json` (коллекция запросов с документацией)
    * `FLIGHT API.postman_environment.json` (переменные окружения)
2. Выберите в правом верхнем углу Postman активное окружение **FLIGHT API** (базовый адрес `base_url` уже настроен на `http://localhost:8080/api-flight`).
3. Выполните запрос **Авторизация** (`POST /login`) под клиентом или администратором — скрипт автоматически сохранит полученный Bearer-токен в переменную `{{token}}` для всех защищённых эндпоинтов.
