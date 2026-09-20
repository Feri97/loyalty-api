# Development

## Workflow

Every meaningful change is developed on a dedicated branch and merged through a pull request.

Typical flow:

```text
main
  -> feature/chore branch
  -> implementation
  -> automated checks
  -> commit and push
  -> pull request
  -> review
  -> merge
  -> branch cleanup
```

## Branch naming

Examples:

- `chore/project-bootstrap`
- `feature/customer-api`
- `feature/points-crediting`
- `feature/idempotency`
- `feature/redis-rate-limiting`

## Local environment

The development environment is Docker-based.

Current containers:

- `nginx` - HTTP entry point
- `php` - PHP-FPM application runtime
- `mongodb` - primary database

Docker Compose creates a private network for the stack. Containers reach each other by service name, so Nginx connects to `php:9000` and the application connects to `mongodb:27017`.

### First setup

Build the PHP image:

```bash
docker compose build
```

Install PHP dependencies into the bind-mounted project directory:

```bash
docker compose run --rm php composer install
```

Start the stack:

```bash
docker compose up -d
```

Verify the application:

```bash
curl http://localhost:8080/health
```

Expected response:

```json
{"status":"ok"}
```

Inspect running containers:

```bash
docker compose ps
```

Stop the stack:

```bash
docker compose down
```

Remove the MongoDB development volume as well:

```bash
docker compose down -v
```

Use the last command only when intentionally resetting local database data.

## Environment configuration

Safe development defaults are committed in `.env`.

Machine-specific or secret values belong in `.env.local`, which is ignored by Git.

Secrets must not be committed to the repository.

## Pull request structure

Each pull request should explain:

- **What** changed
- **Why** the change is needed
- **Technical decisions**
- **Concepts demonstrated**
- **How to test**
- **Documentation** changes

## Quality gates

Currently enforced locally and in GitHub Actions:

- Composer validation
- Symfony YAML linting
- Symfony service-container linting
- PHPStan
- PHP-CS-Fixer
- Docker Compose configuration validation and application health smoke testing

Planned as feature development begins:

- PHPUnit
