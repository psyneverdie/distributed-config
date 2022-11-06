# Руководство по использованию API

В данном файле описана вся необходимая информация для взаимодействия с API.
Примечание: все команды были протестированы в `cmd.exe` и `Postman`

## 1. CREATE

`curl http://localhost/config/service/<service_name> -F key=<key> -F value=<value>`

Данный запрос ожидает от пользователя наименование сервиса в поле `<service_name>`, а также значения в `form-data` вместо `<key>` и `<value>`

Результатом запроса будет добавление сервиса и его конфиг-даты.

Ответ от API выглядит следующим образом:
```json
{
  "status": true,
  "message": "Service data is created"
}
```
---

## 2. READ
### 2.1 Вывод всех сервисов и дата-конфига
`curl http://localhost/config/service`

Результатом запроса будет вывод всех сервисов и их даты из базы данных.

Ответ от API выглядит следующим образом:
```json
[
  {
    "id": "1",
    "service": "service_name_1",
    "keyname": "key1",
    "value": "value1"
  },
  {
    "id": "3",
    "service": "service_name_2",
    "keyname": "key2",
    "value": "value2"
  }
]
```

### 2.2 Вывод дата-конфига выбранного сервиса
`curl http://localhost/config/service/<service_name>`

Данный запрос ожидает от пользователя наименование сервиса в поле `<service_name>`

Результатом запроса будет вывод дата-конфига введённого сервиса.

Примечание: Данный запрос не выводит идентичные значения для пары key-value для оптимизации вывода значений.

Ответ от API выглядит следующим образом:
```json
{
  "key1": "value1",
  "key2": "value2"
}
```
В случае ввода несуществующего сервиса в поле `<service_name>`, пользователь получит ошибку 404 и следующее сообщение.
```json
{
  "status": false,
  "message": "Service not found"
}
```
### 2.3 Вывод необходимой записи дата-конфига
`curl http://localhost/config/service/<service_name>/<id>`

Данный запрос ожидает от пользователя наименование сервиса в поле `<service_name>` и `<id>` дата-конфига из БД.

Результатом запроса будет вывод дата-конфига под введённым `<id>`.

Ответ от API выглядит следующим образом:
```json
{
  "key1": "value1"
}
```
В случае ввода несуществующего `<id>` в базе данных, пользователь получит ошибку 404 и следующее сообщение.
```json
{
  "status": false,
  "message": "Service data not found"
}
```

## 3. UPDATE
### 3.1 Изменение наименования сервиса

`curl -d "{\"service\":\"<service_new_name>\"}" -H "Content-Type:application/json" -X PATCH http://localhost/config/service/<service_name>`

Данный запрос ожидает от пользователя наименование сервиса, который мы хотим обновить в поле `<service_name>`, а также в поле `<service_new_name>` - новое наименование сервиса

Результатом запроса будет изменение наименования сервиса

Ответ от API выглядит следующим образом:
```json
{
  "status": true,
  "message": "Service name is updated"
}
```
### 3.2 Изменение дата-конфига сервиса

`curl -d "{\"key\":\"<key>\",\"value\":\"<value>\"}" -H "Content-Type:application/json" -X PATCH http://localhost/config/service/<service_name>/<id>`

Данный запрос ожидает от пользователя ID даты сервиса, который мы хотим обновить в поле `<id>`, а также значения в полях `<key>` и `<value>`

Результатом запроса будет изменение наименования сервиса

Ответ от API выглядит следующим образом:
```json
{
  "status": true,
  "message": "Service data is updated"
}
```
---
## 4. DELETE
### 4.1 Удаление сервиса
`curl -X DELETE http://localhost/config/service/<service_name>`

Данный запрос ожидает от пользователя наименование сервиса в поле `<service_name>`

Результатом запроса будет удаление сервиса и его конфиг даты из базы данных.

Ответ от API выглядит следующим образом:
```json
{
  "status": true,
  "message": "Service is deleted"
}
```
### 4.2 Удаление дата-конфига сервиса
`curl -X DELETE http://localhost/config/service/<service_name>/<id>`

Данный запрос ожидает от пользователя ID дата-конфига в `<id>`

Результатом запроса будет удаление конфиг даты сервиса с выбранным ID записи из базы данных.

Ответ от API выглядит следующим образом:
```json
{
  "status": true,
  "message": "Service data is deleted"
}
```
---