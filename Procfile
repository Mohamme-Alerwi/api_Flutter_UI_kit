# استخدم صورة PHP مع Apache وامتدادات Laravel المطلوبة
FROM php:8.2-apache

# ضبط مجلد العمل
WORKDIR /var/www/html

# نسخ ملفات المشروع إلى الحاوية
COPY . /var/www/html

# تثبيت الأدوات اللازمة و Composer
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    git \
    curl \
 && docker-php-ext-install pdo pdo_mysql pdo_pgsql mbstring exif pcntl bcmath gd \
 && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# تثبيت Dependencies للـ Laravel
RUN composer install --no-dev --optimize-autoloader

# ضبط DocumentRoot إلى مجلد public
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN a2enmod rewrite

# كشف المنفذ 80 للويب
EXPOSE 80

# أمر تشغيل Apache
CMD ["apache2-foreground"]
