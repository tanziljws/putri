#!/bin/bash
# Railway setup script - runs after deployment
set -e

echo "🔗 Creating storage symlink..."
php artisan storage:link || echo "⚠️  Storage link already exists or failed"

echo "✅ Railway setup complete!"

