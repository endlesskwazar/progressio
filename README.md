# RUN Project

1. Clone repository
3. Copy env.example to .env
4. Copy api/env.example to .env
5. Setup up APP_SECRET in api/.enf file
6. Execute

```
docker-compose up --build
```

7. Install composer deps

```
docker-compose exec php composer install
```

8. Run migrations

```
docker-compose exec php php bin/console doctrine:migrations:migrate 
```

9. Generate SSL keys for JWT

```
docker-compose exec php php bin/console lexik:jwt:generate-keypair
```

# Testing

Application uses codeception as testing framework

To run tests execute:

```bash
docker-compose exec php composer test
```

This command will run all tests. To run specific group of test use:

```bash
docker-compose exec php composer test-single [group]
```

where [group] is one of unit, functional, acceptance

To generate test use:

```
docker-compose exec php php vendor/bin/codecept generate:cest [kind] [name]
```

where:

- [kind] - Kind of test e.g, unit functional acceptance
- [name] - Name of test

# Database

Application uses Doctrine and Symfony doctrine bundle. And leverage Code first approach to migrations.
After changing entities you can generate migrations using:

```bash
docker-compose exec php php bin/console make:migration
```

And apply migrations using:

```bash
docker-compose exec php php bin/console doctrine:migrations:migrate
```

# Linting

Application uses PHP_CodeSniffer and psalm to statically analyse code.

To run psalm execute:

```bash
docker-compose exec php composer psalm
```