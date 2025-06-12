# 🍕 Pizza Sales Dashboard – Full Stack Laravel + Vue.js SPA

A full-stack application that allows users to log in, view sales analytics from a pizza dataset, and manage their profile. Built using Laravel 12 (PHP 8.2), Vue 3 with Vite, Sanctum (SPA auth), Tailwind CSS, and ShadCN UI.

---

## ⚙️ Stack

| Layer        | Tech                          |
|-------------|-------------------------------|
| Backend     | Laravel 12 (PHP 8.2.28)        |
| Frontend    | Vue 3 + Vite                   |
| Styling     | Tailwind CSS + ShadCN UI       |
| Auth        | Laravel Sanctum (SPA cookie)   |
| Database    | MySQL                          |
| Package Mgmt| Composer + npm                 |
| Node        | v22.16.0                       |

---

## 🚀 Features

### ✅ Authentication
- Register, Login, Logout (SPA cookie session)
- Sanctum-protected API access
- Update and delete user profile

### 📈 Analytics Dashboard
- Total revenue & pizzas sold
- Top-selling pizzas
- Sales over time (monthly) in chart
- Recent sales table
- Orders per month

### 📦 Data Management
- CRUD for:
  - Pizza Types
  - Pizzas
  - Orders & Order Details

---

## 🧪 API Endpoints

### 🍕 Pizza Types

- `GET /api/pizza-types`  
  List all pizza types

- `GET /api/pizza-types/{id}`  
  Show a specific pizza type

---

### 🍕 Pizzas

- `GET /api/pizzas`  
  List all pizzas

- `GET /api/pizzas/{id}`  
  Show a specific pizza

- `POST /api/pizzas`  
  Create a new pizza

- `PUT /api/pizzas/{id}`  
  Update an existing pizza

- `DELETE /api/pizzas/{id}`  
  Delete a pizza

---

### 📦 Orders

- `GET /api/orders`  
  List all orders

- `GET /api/orders/{id}`  
  Show an order and its details

- `POST /api/orders`  
  Create a new order

- `DELETE /api/orders/{id}`  
  Cancel or delete an order

---

### 📊 Analytics

- `GET /api/analytics/sales-summary`  
  Returns total revenue and total pizzas sold

- `GET /api/analytics/top-pizzas`  
  Returns top-selling pizzas

- `GET /api/analytics/sales-by-date?from=YYYY-MM-DD&to=YYYY-MM-DD`  
  Sales filtered by a specific date range

- `GET /api/analytics/sales-by-month`  
  Monthly breakdown of sales

- `GET /api/analytics/recent-sales`  
  Recent orders/sales summary

---

### 👤 Profile Settings

- `PUT /api/v1/settings/profile`  
  Update user profile (name, email)

- `DELETE /api/v1/settings/profile/delete`  
  Permanently delete the user account

---

### 🔐 Authentication (Laravel Sanctum - SPA Session)

- `POST /api/auth/login`  
  User login

- `POST /api/auth/register`  
  User registration

- `POST /api/auth/logout`  
  User logout

- `GET /api/user`  
  Get the currently authenticated user's data


### 📦 Project Structure & Code Organization
- Clean and modular **directory structure** following Laravel and Vue 3 conventions
- Backend organized using **Repository Pattern** for separation of concerns and easier testability
- Route grouping using versioned API prefixes (`/api/v1`) for future scalability
- Frontend components organized by **feature/domain**, promoting reusability and clarity


## 🚀 How to Run This App

This project consists of a Laravel RESTful API backend and a Vue 3 + Vite frontend. Below are the instructions to run both parts locally.

---

### 🛠 Requirements

- **PHP 8.2.28**
- **Composer**
- **Node.js 22.16.0**
- **NPM or Yarn**
- **MySQL or compatible database**
- **Git**

---

### 📦 Backend (Laravel API)

1. **Clone the repository**
   ```bash
   git clone git@github.com:mirasrobert/pizza-sales-dashboard.git
   cd your-repo-name/backend
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Set up environment**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Configure database**
   > Update the `.env` file with your database credentials.

5. **Run migrations**
   ```bash
   php artisan migrate
   ```

6. **Import SQL Data**
   ```bash
   # Import database from
   database/pizza_sales_db.sql
   ```

7. **Run the server**
   ```bash
   php artisan serve
   ```

8. **Sanctum Configuration (SPA Authentication)**
   > Make sure your frontend is served from `http://localhost:5173` and that `SANCTUM_STATEFUL_DOMAINS` and `SESSION_DOMAIN` are configured accordingly in your `.env`.

---

### 🖼 Frontend (Vue 3 + Vite)

1. **Install JavaScript dependencies**
   ```bash
   npm install
   ```

2. **Run the frontend**
   ```bash
   npm run dev
   ```

3. **Access the app**
   - App: [http://localhost:8000](http://localhost:8000)

---

### 📋 API Authentication Notes

- The app uses **Laravel Sanctum** for session-based SPA authentication.
- Make sure both frontend and backend are running on the correct domains (typically localhost).
- Authenticated routes require CSRF protection and cookies, which are automatically handled by your browser when `withCredentials` is enabled in your frontend's `axios` config.

---
