#!/bin/bash
# clearlaravelcache.sh - Clear Laravel cache with error handling

echo "🧹 Clearing Laravel cache..."
echo "============================="

# Store current cache driver
CACHE_DRIVER=$(grep -E '^CACHE_DRIVER=' .env | cut -d '=' -f2)
SESSION_DRIVER=$(grep -E '^SESSION_DRIVER=' .env | cut -d '=' -f2)

echo "Current cache driver: $CACHE_DRIVER"
echo "Current session driver: $SESSION_DRIVER"
echo ""

# Clear config cache
echo "🔧 Clearing config cache..."
php artisan config:clear 2>/dev/null || echo "⚠️  Config clear had warnings"
echo "✅ Config cache cleared"
echo ""

# Clear application cache - with special handling for Redis
echo "🗑️  Clearing application cache..."
if [ "$CACHE_DRIVER" = "redis" ]; then
    # For Redis, use Redis CLI to flush
    if command -v redis-cli &> /dev/null; then
        echo "Using Redis CLI to flush cache..."
        redis-cli FLUSHDB
        echo "✅ Redis cache flushed"
    else
        php artisan cache:clear 2>&1 | grep -v "Undefined table" || echo "⚠️  Cache clear had database warnings (expected with Redis)"
    fi
else
    php artisan cache:clear 2>/dev/null || echo "⚠️  Cache clear had warnings"
fi
echo "✅ Application cache cleared"
echo ""

# Clear route cache
echo "🛣️  Clearing route cache..."
php artisan route:clear 2>/dev/null || echo "⚠️  Route clear had warnings"
echo "✅ Route cache cleared"
echo ""

# Clear view cache
echo "👁️  Clearing view cache..."
php artisan view:clear 2>/dev/null || echo "⚠️  View clear had warnings"
echo "✅ View cache cleared"
echo ""

# Clear compiled class cache (optional)
echo "📦 Clearing compiled classes..."
php artisan clear-compiled 2>/dev/null || echo "⚠️  Clear compiled had warnings"
echo "✅ Compiled classes cleared"
echo ""

# Clear event cache (if using)
echo "🎫 Clearing event cache..."
php artisan event:clear 2>/dev/null || echo "⚠️  Event clear had warnings"
echo "✅ Event cache cleared"
echo ""

# Clear package cache (optional)
echo "📦 Rebuilding package manifest..."
php artisan package:discover 2>/dev/null || echo "⚠️  Package discover had warnings"
echo "✅ Package manifest rebuilt"
echo ""

# For Redis, also clear via artisan if possible
if [ "$CACHE_DRIVER" = "redis" ]; then
    echo "🔄 Additional Redis cleanup..."
    php artisan cache:forget spatie.permission.cache 2>/dev/null || echo "⚠️  Could not clear permission cache"
    echo "✅ Redis-specific cleanup done"
fi

echo "============================="
echo "✨ All caches cleared successfully!"
echo ""
echo "Cache driver: $CACHE_DRIVER"
echo "Session driver: $SESSION_DRIVER"
echo "============================="