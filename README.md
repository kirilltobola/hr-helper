## Hr-helper

### Информация:
CRM система для работы HR отдела. 
Цель проекта - упростить процесс структурирования и подготовки CV.

### Участники:
- [Кирилл](https://github.com/kirilltobola).
- [Максим](https://github.com/zindmax).
- Евгений.
- [Михаил](https://github.com/kekuopex).

### Ссылки:
- [Mind map](https://coggle.it/diagram/YU2458XUaSh-OK).
- [Функциональная карта](https://coggle.it/diagram/YU75JcXUaUMXqS).
- [MVC Schema](https://coggle.it/diagram/YVASPPM_JJEB).
- [User flow](https://coggle.it/diagram/YU78WmWJes-0Pt).
- [ТЗ](https://docs.google.com/document/d/1WC27sxBt44lt8Z3LXvFIyhLedATdwZJdpiDCa126KhY/edit?usp=sharing).
- [План работы](https://docs.google.com/document/d/1RdQbBxxN-_8tiG6r6MyBdd5m5Q1VoFXEfKwcLJbKyLE/edit?usp=sharing).

### Требования:
- MySQL MariaDB-(10.4.17+ :grey_question:)
- Laravel 8+
- PHP 7.4+
- npm (v7+ :grey_question:)

### Запуск приложения:
- cp .env.example .env
- php artisan key:generate
---
- php artisan breeze:install
- npm install
- npm run dev
- php artisan migrate

**Не забыть:**
- запустить mysql, создать бд, с таким же названием как в .env ```DB_DATABASE=some_name```

***Если не запускается - пишите в чат.***
