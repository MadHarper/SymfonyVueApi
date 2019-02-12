FROM codepilotscom/hrm_php

ENV TERM xterm

ARG UID
ARG GUID
RUN usermod -u $UID www-data
RUN groupmod -g $GUID www-data

COPY symfony.ini /usr/local/etc/php/conf.d
COPY php.ini /usr/local/etc/php
COPY ssmtp.conf /etc/ssmtp/

ENV TZ=Europe/Moscow
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

WORKDIR /var/www/site

EXPOSE 9000