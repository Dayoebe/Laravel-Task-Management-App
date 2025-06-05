# 📝 Laravel Livewire Task Manager

A simple yet powerful **Task Management** web application built with **Laravel 10**, **Livewire 3**, and **Tailwind CSS**.  
Add, complete, and delete tasks in real-time with an interactive UI.

## 🚀 Features

- ✅ Add new tasks
- 📋 View task list
- ✏️ Toggle task completion status
- ❌ Delete tasks
- ⚡ Real-time updates with Livewire
- 🎨 Beautiful and responsive UI using Tailwind CSS

## 📷 Demo

> ![Task Manager Screenshot](screenshot.png)  
_Add a screenshot in your repo for better visual appeal_

---

## 🛠️ Tech Stack

- **Laravel 10**
- **Livewire 3**
- **Tailwind CSS**
- **PHP 8.1+**
- **MySQL / SQLite**
- **Vite (for frontend assets)**

---

## 📦 Installation

Clone the repo and follow the steps below:

```bash
git clone https://github.com/your-username/laravel-livewire-task-manager.git
cd laravel-livewire-task-manager

# Install dependencies
composer install
npm install && npm run build

# Copy .env file
cp .env.example .env

# Generate app key
php artisan key:generate

# Setup database (update DB credentials in .env first)
php artisan migrate

# Run the app
php artisan serve
