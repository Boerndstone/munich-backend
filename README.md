### Icon Library

- Material Design Icons (https://icones.js.org/collection/mdi)
- Cookie Consent v3 (https://cookieconsent.orestbida.com/)

### Images

- Header Images
  - Desktop
    - 3960 3x 2640 2x 1320 1x
  - Tablet
    - 2400 3x 1600 2x 800 1x
  - Mobil
    - 1440 3x 960 2x 480 1x

### Rebase

- git pull origin main --rebase

# General container management

make up # Start all containers
make down # Stop all containers  
make restart # Restart all containers
make logs # View all logs
make shell # Access application container

# Development commands

make composer # Install/update PHP dependencies
make yarn # Install/update Node dependencies
make build-assets # Build frontend assets
make cache-clear # Clear Symfony cache

# Database commands

make migration-diff # Generate new migration
make migration-migrate # Run pending migrations
make db-reset # Reset database (⚠️ deletes all data)
make db-import # Import SQL dump (requires munich.sql file)

# Or use docker-compose directly:

docker-compose exec app php bin/console [command]
docker-compose exec app bash
