### Создание таблицы в базе данных MySQL

```mysql
CREATE TABLE events (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    status ENUM('authorized', 'unauthorized') NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

 ### Документация методов API

**Добавление события**

- Описание: метод позволяет добавить новое событие в базу данных.
- Метод: POST
- Параметры запроса:
 - `name` (обязательный) - название события
 - `status` (обязательный) - статус пользователя (авторизован или нет)
- Пример запроса c использованием cURL:
 ```bash
 curl -X POST -d "name=Event1&status=authorized" http://localhost/api.php
 ```
- Пример успешного ответа:
 ```json
 { "success": true }
 ```

**Метод 2: Получение агрегированной информации о событиях**

- Описание: метод позволяет получить агрегированную информацию о событиях на основе фильтров и выбранного типа агрегации.
- Метод: GET
- Параметры запроса:
 - `date` (обязательный) - дата событий (в формате ГГГГ-ММ-ДД)
 - `name` (обязательный) - название события
 - `aggregation` (обязательный) - тип агрегации (eventCount, eventCountByUser, eventCountByStatus)
- Пример запроса c использованием cURL:
 ```bash
 curl "http://localhost/api.php?date=2023-05-07&name=Event1&aggregation=eventCount"
 ```
- Пример успешного ответа (в зависимости от выбранного типа агрегации):
 - `eventCount`:
   ```json
   { "count": 5 }
   ```
 - `eventCountByUser`:
   ```json
   { "authorized": 3, "unauthorized": 2 }
   ```
 - `eventCountByStatus`:
   ```json
   { "pending": 2, "approved": 3 }
   ```
