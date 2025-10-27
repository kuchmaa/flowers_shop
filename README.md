## Запуск сервера в dev моде (Без hot reload после изменения blade)
Убедится то что в .env параметр "development" установлен в true

Сначала запустить vite dev сервер
```cmd
npm run dev
```
потом 
```cmd
php -S localhost:5000
```
и открыть страницу http://localhost:5000/

## Запуск сервера без dev мода

Убедится то что в .env параметр "development" установлен в false (Пхп сервер можно не перезагружать)

