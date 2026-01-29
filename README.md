# PHP-Management-System "Velocity Net"
Customer Complaint Management System

Overview

This project is a web-based customer complaint management system built with PHP and MySQL. It allows customers to submit complaints related to products or services, technicians to manage and resolve assigned complaints, and administrators to oversee users and complaint assignments. The system emphasizes authentication, authorization, and secure role-based access.

The application is containerized using Docker Compose to ensure a consistent development environment.

Technology Stack

PHP 8.2 (Apache)
MySQL 8.0
phpMyAdmin
Docker & Docker Compose
Architecture

The system runs as three Docker services:

Web: PHP application served by Apache
Database: MySQL backend for persistent data storage
phpMyAdmin: Web-based database administration tool
Each service runs in its own container and communicates over a Docker network.

Project Structure

Management System Project/
├─ docker-compose.yml
├─ src/
│  ├─ index.php
│  └─ (application files)
├─ PhPmyadmin/
│  └─ themes/
│     └─ blueberry/
├─ Dockerfile
└─ README.md
Running the Project

Prerequisites

Docker Desktop installed and running
Start the application

From the project root directory:

docker compose -p velocitynet up -d
Access the services

Web application: http://localhost:8080
phpMyAdmin: http://localhost:8081
phpMyAdmin Login

Username: root
Password: rootpass
Database

The MySQL database is initialized using environment variables defined in docker-compose.yml. Data is stored in a Docker volume to persist across container restarts.

Security Features

Notes

phpMyAdmin is included for development and debugging purposes
Docker Compose project naming is used to prevent container conflicts
Custom phpMyAdmin theming is supported via volume mounting
