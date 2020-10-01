setup() {
  cd /var/www/html &&
  read -p 'Site title: ' site_title &&
  read -p 'Theme name: ' theme &&
  wp core install --url="http://localhost" --title=$site_title --admin_user="ioadmin" --admin_password="iodevs123!" --admin_email="developers@iostudio.com" --skip-email --allow-root &&
  echo "Site has been setup." &&
  mv wp-content/themes/collinscode wp-content/themes/$theme &&
  echo "Renamed theme." &&
  wp theme activate $theme --allow-root &&
  echo "Activated correct theme." &&
  wp plugin install $(find wp-content/plugins/ -name "*.zip") --activate --allow-root &&
  echo "Plugins installed." &&
  chown -R www-data:www-data wp-content/ &&
  echo "No root problems here." &&
  echo "Finished with initial setup!";
}
