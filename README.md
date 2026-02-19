# PHP Internal Types vs. Domain Value Objects

This repository is a practical demonstration of moving beyond Gradual Typing and Union Types toward a more robust, Domain-Driven Design (DDD) approach using Value Objects.

During our architectural discussion, we touched upon how PHP handles types (e.g., `int|float`, `string|null`) and the differences between type-checking and Object-Oriented Polymorphism. This code illustrates how I handle these concepts in practice to adhere to SOLID principles and avoid Primitive Obsession.

## The Problem: Primitive Obsession & Union Types
In a standard "gradual typing" approach, we often use raw scalars or union types. 
While PHP 8's `int|float` or `string|null` tells the compiler about the data format, it doesn't tell the business logic about the domain constraints. Relying on primitives means spreading validation checks like `if (is_string($val) && strlen($val) > 0)` throughout the application layer.

## The Solution: Encapsulated Value Objects
The code in this repository replaces primitive types with specific objects that encapsulate their own validation logic. This guarantees that an entity like `Project` can **never exist in an invalid state**.

### 1. Encapsulated Validation (Common Types)
Instead of checking string lengths in controllers or handlers, the validation is baked into the type itself. 

*Example from `CommonTypes/RequiredString.php`:*
```php
public static function isValid(mixed $value): bool
{
    return is_string($value) && (trim($value) !== '') && (mb_strlen($value) < 256);
}
```
### 2. Domain Specificity (Domain Types)

We extend these base types to give them explicit domain meaning. For instance, ProjectId is not just "any integer" - it is strictly a PositiveInteger.

Example from Types/ProjectId.php:

```php
final class ProjectId extends PositiveInteger
{
    // Inherits strict positive integer validation without needing to deal with UUIDs manually everywhere
}
```

### 3. Type Safety in Entities & Commands

When you look at the Project entity or commands like CreateProject, the constructor dictates exactly what is required. I don't pass raw strings or nullable variables, I pass specific Domain objects.

Example from Project.php:

```php
public function __construct(
    private ProjectId $projectId,
    private ProjectName $projectName,
    private ProjectDescription $projectDescription,
) {}
```
### 4. Clean Handlers (Polymorphism in Action)

Because the types guarantee their own validity upon instantiation, the business logic inside Command Handlers becomes incredibly clean. There is no need for if/else type-checking or validation logic inside the handler itself.

Example from CreateProjectHandler.php:

```php
public function handle(CreateProject $command): void
{
    $newProject = new Project(
        new ProjectId(rand(1, 32768)), 
        new ProjectName($command->getName()->toString()),
        new ProjectDescription($command->getDescription()->toNullableString()),
    );
    $this->projectRepository->create($newProject);
}
```
### Conclusion
While PHP modern type system (Union Types, Intersection Types) is powerful for scalar values and basic data transfer, core domain logic should rely on Value Objects and Polymorphism.

Instead of asking a variable what type it is (is_int(), is_string()), I rely on objects that enforce their own contracts. This keeps the codebase scalable, testable, and strictly aligned with business rules.

