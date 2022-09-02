## POS
POS ( point of sales ) built with Codeigniter 4

### Frontend
`web-pos` 

### Backend
`server-pos`

### Table Structure
![Table Structure](https://github.com/imankubbil/majo-pos/raw/dev/document/ERD.png)

### Documention API
`Insomnia (import file)` : [Link](https://github.com/imankubbil/majo-pos/tree/dev/document/collection-insomnia)

### Documention SQL
`Sql file (import file)` : [Link](https://github.com/imankubbil/majo-pos/raw/dev/document/posmajo.sql)

### After Clone
- Frontend
    move web-pos
    cd /web-pos
    - Install
        composer install
    - Run Server
        php spark server

- Backend
    move server-pos
    cd /server-pos
    - Install
        composer install
    - Config .env file for database
        cp .env.example .env
    - Migrate Database
        php spark migrate
    - Run Server
        php spark server --port 8081