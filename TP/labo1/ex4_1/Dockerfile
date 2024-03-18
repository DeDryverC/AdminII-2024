FROM httpd:latest
COPY ./sites/*.conf /usr/local/apache2/conf/
RUN echo "IncludeOptional conf/sites-enabled/*.conf" >> /usr/local/apache2/conf/httpd.conf
RUN echo "ServerName localhost" >> /usr/local/apache2/conf/httpd.conf
COPY ./html/ /usr/local/apache2/htdocs/
EXPOSE 80 8080
