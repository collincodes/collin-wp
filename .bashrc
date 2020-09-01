setup() {
  cd /var/www/html &&
  rm -rf wp-content/themes/twenty[!twenty] &&
  rm -rf wp-content/plugins/hello.php wp-content/plugins/akismet &&
  chown -R www-data:www-data wp-content/ &&
  find wp-content/ -type d -exec chmod 755 {} + &&
  find wp-content/ -type f -exec chmod 644 {} + &&
  echo "Finished with initial setup!";
}

cleanup() {
  echo "Starting cleanup" &&
  wp theme activate collinscode --allow-root &&
  wp plugin install $(find wp-content/plugins/ -name "*.zip") --activate --allow-root &&
  wp plugin update --all --allow-root;
}

replace() {
  cd /var/www/html &&
  wp search-replace $1 'http://localhost' --allow-root;
}
