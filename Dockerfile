FROM nginx:alpine

FROM openjdk:17-jdk
EXPOSE 7035
RUN mkdir /app
WORKDIR /app
COPY build/libs/web-esdiacdata-all.jar /app
ENTRYPOINT ["java","-jar","your-app-name.jar"]
COPY . /usr/share/nginx/html
