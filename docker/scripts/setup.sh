#!/bin/bash

echo "🐳 Starting Munich Backend Docker Environment..."

# Build and start containers
docker-compose up -d --build

echo "⏳ Waiting for database to be ready..."
sleep 10

# Install Composer dependencies if vendor directory doesn't exist
if [ ! -d "vendor" ]; then
    echo "📦 Installing Composer dependencies..."
    docker-compose exec app composer install
fi

# Install Node dependencies if node_modules doesn't exist
if [ ! -d "node_modules" ]; then
    echo "📦 Installing Node dependencies..."
    docker-compose exec app yarn install
fi

# Copy Docker environment file
cp .env.docker .env

# Run database migrations
echo "🗃️  Running database migrations..."
docker-compose exec app php bin/console doctrine:migrations:migrate --no-interaction

# Build assets
echo "🎨 Building assets..."
docker-compose exec app yarn build

echo "✅ Setup complete!"
echo ""
echo "🌐 Your application is now running at: http://localhost:8080"
echo "📧 Mailhog is available at: http://localhost:8026 (if needed)"
echo "🗃️  Database is available at: localhost:3306"
echo ""
echo "Useful commands:"
echo "  docker-compose logs app     # View application logs"
echo "  docker-compose exec app bash # Access application container"
echo "  docker-compose down         # Stop all containers"
