# Add include for overrides
echo "Include /app/www/conf/httpd.conf" >> /app/apache/conf/httpd.conf

# Write certs in env to files and replace with path
if [ -n "$KEY_PEM" -a -n "$CERT_PEM" -a -n "$CA_PEM" ]
then
  mkdir "/app/www/certs"
  echo "$KEY_PEM" > /app/www/certs/key.pem
  echo "$CERT_PEM" > /app/www/certs/cert.pem
  echo "$CA_PEM" > /app/www/certs/ca.pem
  export KEY_PEM="/app/www/certs/key.pem"
  export CERT_PEM="/app/www/certs/cert.pem"
  export CA_PEM="/app/www/certs/ca.pem"
fi

# Heroku boot.sh
for var in `env|cut -f1 -d=`; do
  echo "PassEnv $var" >> /app/apache/conf/httpd.conf;
done
touch /app/apache/logs/error_log
touch /app/apache/logs/access_log
tail -F /app/apache/logs/error_log &
tail -F /app/apache/logs/access_log &
export LD_LIBRARY_PATH=/app/php/ext
export PHP_INI_SCAN_DIR=/app/www
echo "Launching apache"
exec /app/apache/bin/httpd -DNO_DETACH
