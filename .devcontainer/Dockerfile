FROM mcr.microsoft.com/devcontainers/php:0-8.2

RUN rm -f /etc/apt/sources.list.d/yarn.list && \
    apt-get update && apt-get install -y \    git \
    sudo \
    default-mysql-client \
    && rm -rf /var/lib/apt/lists/*

RUN chmod +x /usr/bin/git && chown root:root /usr/bin/git

RUN docker-php-ext-install mysqli pdo pdo_mysql && docker-php-ext-enable pdo_mysql