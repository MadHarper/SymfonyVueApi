FROM node:lts-alpine

RUN npm install -g http-server

# Create app directory
WORKDIR /var/www/site

#COPY package*.json ./

#RUN cd /var/www/site && npm install

#RUN npm install



RUN npm install -g @vue/cli
#RUN cd /var/www/site/frontend && npm install -g @vue/cli

#RUN npm run build

# If you are building your code for production
# RUN npm install --only=production

RUN apk add --no-cache --repository http://nl.alpinelinux.org/alpine/edge/community shadow
RUN rm -rf /var/cache/apk/* && rm -rf /tmp/*


ARG UID
ARG GUID

#RUN groupmod -g $GUID www-data
#RUN adduser -u $UID -D -g '' -G www-data www-data

RUN set -x \
	&& addgroup -g 1003 www-data \
	&& adduser -u 1003 -D -S -G www-data www-data



#RUN set -x \
#	&& addgroup -g $GUID www-data \
#	&& adduser -u $UID -D -S -G www-data www-data

EXPOSE 8080
