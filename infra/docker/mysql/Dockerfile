FROM mysql:5.7

# timezone environment
ENV TZ=Asia/Tokyo \
    # locale
    LANG=ja_JP.UTF-8 \
    LANGUAGE=ja_JP:ja \
    LC_ALL=ja_JP.UTF-8

RUN apt-get update && \
    apt-get -y install git vim libicu-dev libonig-dev libzip-dev unzip locales && \
    apt-get clean && \
    rm -rf /var/lib/apt/lists/* && \
    locale-gen ja_JP.UTF-8 && \
    localedef -f UTF-8 -i ja_JP ja_JP.UTF-8

COPY ./infra/docker/mysql/my.cnf /etc/my.cnf

WORKDIR /var/lib/mysql
