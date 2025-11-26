# --------------------------------------

# Dockerfile مُعدّل لمشروع Laravel على Deployra

# --------------------------------------

# استخدم PHP مع Apache

FROM php:8.2-apache

# تحديد مجلد العمل داخل الحاوية

WORKDIR /var/www/html

# نسخ كل ملفات المشروع إلى الحاوية

COPY . /var/www/html

# تثبيت الأدوات اللازمة وامتدادات PHP و PostgreSQL client

RUN apt-get update && apt-get install -y 
libpng-dev 
libonig-dev 
libxml2-dev 
zip 
unzip 
git 
curl 
libpq-dev 
&& docker-php-ext-install pdo pdo_mysql pdo_pgsql mbstring exif pcntl bcmath gd 
&& curl -sS [https://getcomposer.org/installer](https://getcomposer.org/installer) | php -- --install-dir=/usr/local/bin --filename=composer

# تثبيت مكتبات Laravel عبر Composer

RUN composer install --no-dev --optimize-autoloader

# ضبط DocumentRoot على مجلد public

ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN a2enmod rewrite

# إضافة ServerName لتجنب تحذيرات Apache

RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# كشف المنفذ 80 للويب

EXPOSE 80

# أمر بدء التشغيل لتشغيل Apache عند تشغيل الحاوية

CMD ["apache2-foreground"]
