# Architecture

## Overview

The system starts with a single core service: the Loyalty API.

The Loyalty API owns the core loyalty domain, including customers, loyalty accounts, point transactions and balance changes. It is intentionally kept as one deployable unit during the first stages of the project so that domain rules and data consistency can be implemented without unnecessary distributed-system complexity.

A separate Notification Service will be added later as an independently deployable microservice.

## Planned components

### Loyalty API

Responsibilities:

- expose the public REST API
- validate incoming requests
- manage customers and loyalty accounts
- credit and redeem loyalty points
- enforce idempotency
- persist loyalty data in MongoDB
- publish domain events reliably

### MongoDB

Primary persistence for the Loyalty API.

The project will use MongoDB features deliberately, including document modelling, indexes, atomic updates and, where justified, multi-document transactions.

### Redis

Planned for caching, rate limiting and other short-lived coordination use cases.

### Message broker

A broker such as RabbitMQ will be introduced when asynchronous communication is added.

The Loyalty API will publish events such as `PointsAdded`, while independent consumers can process those events without making the core loyalty transaction depend on them.

### Notification Service

This will live in a separate GitHub repository and build a separate Docker image.

It will consume loyalty events asynchronously and simulate customer notifications. Its failure must not prevent the core loyalty operation from succeeding.

## Communication

Initial client-to-service communication is synchronous HTTP.

Later service-to-service communication for notifications will be asynchronous:

```text
Client
  |
  v
Loyalty API ---> MongoDB
  |
  v
Outbox / Message Broker
  |
  v
Notification Service
```

This design will be used to practise eventual consistency, retry handling, acknowledgements, dead-letter queues, idempotent consumers and graceful degradation.

## Deployment boundary

A service boundary is defined by independent build and deployment, not merely by a PHP namespace or folder.

The Loyalty API and Notification Service will therefore have:

- separate repositories
- separate Docker images
- separate containers
- separate CI pipelines
- independent runtime configuration

They may still be started together locally with Docker Compose.
