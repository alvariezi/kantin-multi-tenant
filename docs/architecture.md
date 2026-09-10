# Arsitektur Modular Monolith

## Modul Terdaftar
- Admin
- Catalog
- Kitchen
- Ordering
- Payments
- Reporting

## Konvensi Routing
- Publik: `/kantin/{canteen:slug}` -> `customer.*`
- Tenant: `/tenant/{tenant:slug}` -> `tenant.*` (Auth Required)
- Admin: `/admin` -> `admin.*` (Auth Required)