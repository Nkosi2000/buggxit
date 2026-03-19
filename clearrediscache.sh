#!/bin/bash
# redis-clear.sh - Clear everything using Redis CLI

echo "🔴 Redis Cache & Session Clear"
echo "=============================="

# Check if Redis is running
if ! redis-cli ping > /dev/null 2>&1; then
    echo "❌ Redis is not running!"
    echo "Starting Redis..."
    redis-server &
    sleep 2
fi

# Flush Redis database
echo "Flushing Redis database..."
redis-cli FLUSHDB
echo "✅ Redis cache cleared"

# Clear Laravel's file-based caches
echo ""
echo "Clearing Laravel file caches..."
php artisan config:clear 2>/dev/null && echo "✅ Config cleared"
php artisan route:clear 2>/dev/null && echo "✅ Route cleared"
php artisan view:clear 2>/dev/null && echo "✅ View cleared"
php artisan clear-compiled 2>/dev/null && echo "✅ Compiled cleared"
php artisan event:clear 2>/dev/null && echo "✅ Event cleared"

echo ""
echo "=============================="
echo "✨ Redis and Laravel caches cleared!"
echo "=============================="