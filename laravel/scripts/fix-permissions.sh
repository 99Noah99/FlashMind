# A lancer depuis la racine du projet Laravel
echo "🔧 Fixing permissions..."

# Donne le contrôle au dev (à adapter selon son système, ici on suppose Linux/WSL)
sudo chown -R $(whoami):$(whoami) .

# Droits standards
find . -type f -exec chmod 644 {} \;
find . -type d -exec chmod 755 {} \;

# Droits spéciaux pour Laravel
chmod -R 775 storage bootstrap/cache
sudo chown -R www-data:www-data storage bootstrap/cache

echo "✅ Permissions fixed."

# Usage:
#bash scripts/fix-permissions.sh