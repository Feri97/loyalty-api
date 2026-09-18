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

## Pull request structure

Each pull request should explain:

- **What** changed
- **Why** the change is needed
- **Technical decisions**
- **Concepts demonstrated**
- **How to test**
- **Documentation** changes

## Local environment

The local environment will be Docker-based.

The first bootstrap will introduce the PHP application container, web server and MongoDB. Redis and the message broker will be added only when a feature requires them, so each infrastructure component has a clear reason to exist.

Exact commands will be added as the Docker setup is implemented.

## Quality gates

The project will gradually enforce:

- PHPUnit
- PHPStan
- PHP-CS-Fixer
- Symfony linting
- automated GitHub Actions checks
