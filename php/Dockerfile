FROM php:7.3.3-apache
RUN apt-get update && apt-get upgrade -y
RUN docker-php-ext-install mysqli
RUN apt-get install python-pip python-dev -y
RUN pip install tensorflow==0.12
RUN pip install numpy
RUN pip install pandas
COPY . .
EXPOSE 80