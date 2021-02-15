# CRUD usuários

**Projeto trata-se de um simples CRUD de usuários.**

# Depedências

-   [Laravel](https://laravel.com/)
-   [Docker](https://www.docker.com/)
-   [Docker compose](https://docs.docker.com/compose/)

# Infra estrutura

Projeto foi desenvolvido utilizando containers sendo eles:

-   user_db: Banco de dados [MySQL](https://www.mysql.com/)
-   nginx_php: Servidor web [Nginx](https://www.nginx.com/)
-   php_fpm: Interpretador do PHP [PHP-FPM](https://www.php.net/manual/pt_BR/install.fpm.php)
-   workspace_php: Ambiente com todas as ferramentas para utilizar no projeto (composer, php, etc).

# Iniciando

Para iniciar os containers acesse a pasta docker e execute o comando abaixo

1. Iniciando containers

```bash
docker-compose up -d
```

2. Após a inicialização dos containers é necessários alterar o .env

```bash
docker exec workspace_php composer define-env
```

3. Altere os dados de conexão do banco para:

```
DB_CONNECTION=mysql
DB_HOST=user_db
DB_PORT=3306
DB_DATABASE=user
DB_USERNAME=laravel
DB_PASSWORD=user_123
```

4. Execute as migrações:

```bash
docker exec workspace_php php artisan migrate
```

Caso não queira utilizar o docker siga a documentação oficial do [Laravel](https://laravel.com/docs/8.x)

# Acessando workspace

Para acessar o workspace execute o comando:

```bash
docker exec -it workspace_php bash
```

Pasta `app` é a pasta do projeto.

# Logs sem permissão

Caso receba messagem de erro ao tentar gerar logs execute o comando

```bash
sudo chmod 775 storage/logs
```
