# Larva API

Simple Laravel API to demonstrate architecture

## Used convention, approaches and solutions (not simplest, but nice for bigger projects)

- Routing using UUID pattern as a first UUID format validation
- UUID as primary Model ID
- Dedicated action per route
- Form Request for validation
- API Doc annotation, `knuckleswtf/scribe` for generating API Doc in HTML and Postman collection
- `barryvdh/laravel-ide-helpe` for generating model's annotations
- Soft deletes, with handling cascade soft deletes
- Models factories and db seeder
- Dedicated model resources
- Unit tests for all CRUDs actions
- omitting PHPDoc when it not gives benefits
