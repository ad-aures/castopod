FROM docker.io/nginx:1.25

COPY docker/production/web-server/entrypoint.sh /entrypoint.sh
COPY docker/production/web-server/nginx.template.conf /nginx.template.conf
COPY castopod/public /var/www/html

RUN chmod +x /entrypoint.sh && \
    apt-get update && \
    apt-get install -y curl gettext-base && \
    rm -rf /var/lib/apt/lists/* && \
    usermod -aG www-data nginx

HEALTHCHECK --interval=30s --timeout=3s CMD curl --fail http://localhost || exit 1
VOLUME /var/www/html/media
EXPOSE 80
WORKDIR /var/www/html

CMD ["/entrypoint.sh"]
