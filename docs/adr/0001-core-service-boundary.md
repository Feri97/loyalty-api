# ADR-0001: Keep the core loyalty domain in one service initially

- Status: Accepted
- Date: 2026-09-18

## Context

The project needs to demonstrate both production-oriented backend development and microservice concepts.

Splitting every domain area into a separate service from the beginning would introduce network communication, distributed transactions, deployment overhead and failure modes before there is a concrete need for those boundaries.

At the same time, the project should contain at least one genuine independently deployable microservice for practical experience.

## Decision

The core loyalty domain will initially be implemented in a single Loyalty API service.

Notifications will later be extracted into a separate `loyalty-notification-service` repository and deployment unit.

The Notification Service is a suitable independent boundary because notification delivery is not required to complete the core loyalty transaction and can be processed asynchronously.

## Consequences

Positive:

- core domain rules remain easier to reason about
- consistency-sensitive point operations stay inside one service boundary
- local development is simpler during the early stages
- the later Notification Service provides a real microservice integration scenario
- failure of notification delivery can be handled with graceful degradation

Trade-offs:

- the core application remains one deployment unit
- service extraction decisions are postponed until a real boundary is justified
- asynchronous messaging infrastructure will be introduced later rather than during the initial bootstrap

## Related concepts

- modular monolith
- microservice deployment boundary
- loose coupling
- asynchronous processing
- eventual consistency
- graceful degradation
- YAGNI
