FROM nginx:alpine

# Copy the HTML and CSS files to the Nginx html directory
COPY . /usr/share/nginx/html
