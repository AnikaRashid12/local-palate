# 🍽️ Local Palate

### Discover. Review. Save Your Favorites.

Local Palate is a restaurant discovery and review web application built with Laravel. It allows users to explore restaurants, discover popular dining spots, filter restaurants based on food preferences and location, share their dining experiences, and save their favorite restaurants to a personal wishlist.

The platform includes separate dashboards for users and administrators, making restaurant discovery and management easier and more organized.

## ✨ Key Features

### 🏠 Homepage
- Displays highly rated restaurants based on customer reviews.
- Browse restaurants with their pictures and names.
- Add restaurants to your wishlist using the heart icon.
- Explore restaurants available on the platform.

### 🔎 Search & Filter
- Search restaurants by name.
- Filter restaurants by food category, including seafood, pizza, sushi, and more.
- Filter restaurants based on location.
- Discover restaurants that match your preferences.

### ⭐ Restaurant Details & Reviews
- Dedicated page for each restaurant.
- View restaurant descriptions and information.
- Explore customer reviews and star ratings.
- Submit reviews and rate restaurants.
- Add or remove restaurants from your wishlist.

### ❤️ Wishlist Management
- Save favorite restaurants using the heart icon.
- Wishlist functionality is available on both the homepage and restaurant detail pages.
- View all saved restaurants from the user dashboard.

### 👤 User & Admin Dashboards

The application supports two account roles with different dashboard functionalities.

**1. User Dashboard**
- View wishlisted restaurants.
- View previously submitted reviews.
- Request the addition of new restaurants.
- Explore the top 3 reviews.

**2. Admin Dashboard**
- View restaurant addition requests submitted by users.
- Review customer requests.
- Dynamically add new restaurants to the platform.
- Manage restaurant listings.

### 📝 Restaurant Addition Requests
- Users can request restaurants that are not yet listed on the platform.
- Administrators can view submitted requests.
- Admins can add requested restaurants dynamically.

## 🛠️ Tech Stack

| Technology | Purpose |
|---|---|
| Laravel 12 | Backend framework |
| PHP 8.2+ | Server-side programming |
| MySQL | Database |
| HTML & CSS | Frontend structure and styling |
| JavaScript | Frontend interactions |
| Blade | Laravel templating |
| Livewire | Dynamic frontend components |
| Laravel Jetstream | Authentication and user management |
| Vite | Frontend asset development |

## ⚙️ Installation & Setup

Follow these steps to run Local Palate on your local machine.

### Prerequisites
- PHP 8.2 or higher
- Composer
- Node.js and NPM
- MySQL
- XAMPP (optional, for local MySQL and PHP environment)

### 1. Clone the Repository

```bash
git clone https://github.com/AnikaRashid12/local-palate.git
```

### 2. Navigate to the Project Folder

```bash
cd local-palate
```

### 3. Install Dependencies

Install PHP dependencies:

```bash
composer install
```

Install frontend dependencies:

```bash
npm install
```

### 4. Configure Environment Variables

Create your environment file:

```bash
cp .env.example .env
```

Generate the application key:

```bash
php artisan key:generate
```

### 5. Configure the Database

Create a MySQL database named `local_palate_db`.

Update your `.env` file with your database credentials:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=local_palate_db
DB_USERNAME=root
DB_PASSWORD=
```

### 6. Run Database Migrations

```bash
php artisan migrate
```

### 7. Start the Application

Run the Laravel development server:

```bash
php artisan serve
```

In another terminal, start the frontend development server:

```bash
npm run dev
```

Open the application in your browser:

**http://127.0.0.1:8000**

## 🎯 Project Objectives

- Build a centralized platform for discovering and reviewing restaurants.
- Help users find restaurants based on food preferences and location.
- Encourage customers to share their dining experiences.
- Make restaurant selection easier through ratings and reviews.
- Allow users to organize their favorite restaurants.
- Provide administrators with tools to manage restaurant listings and user requests.

## 🔮 Future Enhancements
- Interactive maps for restaurant discovery.
- Upload images with customer reviews.
- Advanced restaurant recommendation system.
- More detailed restaurant analytics.

---

**Developed as a Laravel Web Application Project.**

*Local Palate – Your next favorite restaurant is just a review away!* 🍕
