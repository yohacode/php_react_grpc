FROM php:7.3-cli

WORKDIR /app

# Install needed packages
RUN apt-get update && apt-get install -y \
    curl unzip git

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copy your app
COPY . .

# Make RoadRunner executable
RUN chmod +x rr

# Expose default port
EXPOSE 9000

CMD ["./rr", "serve"]
