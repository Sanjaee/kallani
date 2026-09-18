#!/bin/bash
# Kallani Docker Startup Script

echo "========================================"
echo "KALLANI - Docker Startup"
echo "========================================"
echo ""

# Check if Docker is installed
if ! command -v docker &> /dev/null; then
    echo "ERROR: Docker is not installed"
    echo "Please install Docker Desktop"
    exit 1
fi

# Check if Docker Compose is installed
if ! command -v docker-compose &> /dev/null; then
    echo "ERROR: Docker Compose is not installed"
    echo "Please install Docker Compose"
    exit 1
fi

echo "Building Docker image..."
docker-compose build

echo ""
echo "Starting containers..."
docker-compose up -d

echo ""
echo "Waiting for services to start..."
sleep 5

echo ""
echo "========================================"
echo "KALLANI is running!"
echo "========================================"
echo ""
echo "Access the application at:"
echo "  http://localhost"
echo ""
echo "Database connection:"
echo "  Host: localhost:5432"
echo "  Database: kallani"
echo "  User: kallani_user"
echo "  Password: kallani_pass"
echo ""
echo "Useful commands:"
echo "  View logs:     docker-compose logs -f"
echo "  Stop:          docker-compose down"
echo "  Restart:       docker-compose restart"
echo ""
