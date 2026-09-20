# Loyalty API

A backend service for a loyalty platform, built as a portfolio and learning project around production-oriented PHP backend concepts.

## Goals

The project is designed to demonstrate and practise:

- REST API design
- Symfony service architecture and dependency injection
- MongoDB document modelling and indexing
- concurrency-safe loyalty point operations
- idempotency and duplicate-request protection
- Redis caching and rate limiting
- asynchronous messaging
- outbox pattern and reliable event delivery
- observability, health checks and production debugging
- Docker-based local development
- automated tests, static analysis and CI

## Architecture

The core loyalty domain lives in this repository as one deployable service.

A separate `loyalty-notification-service` will be introduced later as an independently deployable microservice with its own Docker image and repository. The services will communicate asynchronously through a message broker.

See [docs/architecture.md](docs/architecture.md) for the current architecture and [docs/adr](docs/adr) for architecture decisions.

## Development

Local development is Docker-based so the application and its infrastructure can be started reproducibly without relying on host-installed PHP extensions or databases.

Setup instructions are maintained in [docs/development.md](docs/development.md).

## Status

Project bootstrap complete. The next feature is the Customer API.
