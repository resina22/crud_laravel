FROM ubuntu:latest

ENV USER dev
ENV TZ=America/Sao_Paulo

# Configure
RUN echo 'root:root' | chpasswd
RUN useradd -m ${USER} --uid=1000 -G sudo
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone
WORKDIR /home/"${USER}"/app

# Add repository and Install packages
USER root
RUN apt-get update
RUN apt-get install apt-transport-https gnupg wget curl git software-properties-common composer vim -y
RUN apt-get install php zip unzip php-zip php-xml php-mysql php-pdo php-mbstring -y

#Libs/Modules
RUN apt install php-phar-io-manifest -y
RUN wget -O phpunit https://phar.phpunit.de/phpunit-9.phar
RUN mv phpunit /usr/local/bin/phpunit && chmod +x /usr/local/bin/phpunit

#Dependencies
RUN cd /home/"${USER}"/app
RUN composer install; exit 0

USER dev
