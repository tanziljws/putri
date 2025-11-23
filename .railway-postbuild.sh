#!/bin/bash
# Railway post-build script - Copy storage files and create symlink
set -e

echo "📦 Copying storage/app/public files from git..."
# Ensure storage directories exist
mkdir -p storage/app/public/galleries
mkdir -p storage/app/public/news
mkdir -p storage/app/public/about
mkdir -p storage/app/public/profile-photos

# Copy files from git (they should already be there from git clone)
# But ensure they have correct permissions
if [ -d "storage/app/public" ]; then
    chmod -R 755 storage/app/public
    echo "✅ Storage files ready"
else
    echo "⚠️  storage/app/public directory not found"
fi

echo "🔗 Creating storage symlink..."
php artisan storage:link --force || echo "⚠️  Storage link already exists"

echo "✅ Post-build setup complete!"

