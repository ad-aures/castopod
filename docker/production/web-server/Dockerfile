FROM docker.io/nginx:1.21-alpine

VOLUME /var/www/html/media

EXPOSE 80

WORKDIR /var/www/html

COPY docker/production/web-server/entrypoint.sh /entrypoint.sh

RUN chmod +x /entrypoint.sh && \
    apk add --no-cache curl gettext

HEALTHCHECK --interval=30s --timeout=3s CMD curl --fail http://localhost || exit 1

COPY docker/production/web-server/nginx.template.conf /nginx.template.conf

COPY castopod/public /var/www/html

CMD ["/entrypoint.sh"]
