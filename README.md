# RUN Project

1. Clone repository
2. Execute

```
docker-compose up --build
```

3. Install composer deps

```
docker-compose exec php composer install
```

4. Run migrations

```
docker-compose exec php php bin/console doctrine:migrations:migrate 
```

5. Generate SSL keys for JWT

```
docker-compose exec php php bin/console lexik:jwt:generate-keypair
```
