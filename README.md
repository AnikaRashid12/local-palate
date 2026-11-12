# 🍽️ Local Palate

### Discover. Review. Save Your Favorites.

Local Palate is a Laravel-based restaurant discovery and review platform that helps users explore restaurants, discover trending dining spots, share their experiences, and save their favorite places.

Users can search for restaurants, filter them by cuisine, location, and ratings, explore detailed restaurant profiles, and contribute reviews. The platform also features role-based authentication with separate dashboards for administrators and regular users.

## ✨ Features

### 🏠 Homepage & Restaurant Discovery
- Displays restaurants with the highest ratings and popular reviews.
- Highlights trending restaurants with a **Trending** badge.
- Browse restaurants through visual cards featuring restaurant pictures, names, food categories, and locations.
- Add restaurants to your wishlist directly from the homepage.
- Search for restaurants by name.

### 🔍 Advanced Restaurant Filtering
Users can discover restaurants using multiple filtering options:
- **By Location:** Find restaurants based on their location.
- **By Cuisine:** Filter by food categories such as seafood, pizza, sushi, pasta, and more.
- **By Rating:** Sort restaurants by rating, from highest to lowest or lowest to highest.
- Apply or reset filters to customize restaurant results.

### ⭐ Restaurant Details & Reviews
Every restaurant has its own dedicated page featuring:
- Restaurant description and information.
- Food menu and cuisine details.
- Customer reviews and star ratings.
- Average restaurant rating.
- Review submission form with selectable star ratings and written feedback.
- Wishlist functionality through a heart icon.

### ❤️ Wishlist Management
- Add or remove restaurants using the heart icon.
- Wishlist functionality is available on both the homepage and individual restaurant pages.
- A dedicated **My Wishlist** page displays saved restaurants.
- Users can manage and revisit their favorite restaurants.

### 👤 User & Admin Dashboards

The application supports two types of accounts with role-based access and separate dashboard experiences.

#### 1. User Dashboard
- View wishlisted restaurants.
- Access previously submitted reviews.
- Submit requests to add new restaurants.
- View the **Top 3 Rated Restaurants** with their average ratings.
- Navigate back to the main restaurant discovery page.

#### 2. Admin Dashboard
- View restaurant addition requests submitted by users.
- Review customer requests.
- Dynamically add new restaurants to the platform.
- Manage restaurant listings.

### 📝 Restaurant Addition Requests
- Users can request restaurants that are not currently available on the platform.
- Administrators can view and review submitted requests.
- Admins can dynamically add new restaurants to the website.

## 🛠️ Tech Stack

| Technology | Purpose |
|---|---|
| Laravel 12 | Backend framework |
| PHP 8.2+ | Server-side programming |
| MySQL | Database |
| HTML & CSS | Frontend structure and styling |
| JavaScript | Frontend interactions |
| Blade | Templating engine |
| Laravel Jetstream | Authentication and user management |
| Livewire | Dynamic frontend components |
| Vite | Frontend asset development |

## ⚙️ Installation & Setup

### Prerequisites
- PHP 8.2 or higher
- Composer
- Node.js and NPM
- MySQL
- XAMPP (optional)

### 1. Clone the Repository

```bash
git clone https://github.com/AnikaRashid12/local-palate.git
```

### 2. Navigate to the Project Directory

```bash
cd local-palate
```

### 3. Install Dependencies

```bash
composer install
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

Update your `.env` file:

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

Start the Laravel development server:

```bash
php artisan serve
```

In another terminal, run the frontend development server:

```bash
npm run dev
```

Open the application in your browser:

**http://127.0.0.1:8000**

## 🎯 Project Objectives
- Simplify restaurant discovery through search and filtering.
- Help users make informed dining decisions through customer reviews and ratings.
- Create a community-driven platform for sharing dining experiences.
- Allow users to save and organize their favorite restaurants.
- Provide administrators with an efficient restaurant management system.

## 🚀 Future Enhancements
- Interactive maps for restaurant discovery.
- Customer review image uploads.
- Advanced restaurant recommendation system.
- More detailed restaurant analytics.

---

**Local Palate** – Discover restaurants, share experiences, and find your next favorite place! 🍕

<img width="1847" height="897" alt="image" src="https://github.com/user-attachments/assets/05f06438-55da-4112-85f4-6fb4d612f230" />

<img width="1816" height="903" alt="image" src="https://github.com/user-attachments/assets/fbf12aa6-7dcb-4d6a-a4fa-cc4254f59d45" />

<img width="973" height="928" alt="image" src="https://github.com/user-attachments/assets/82fa9423-60ea-44ed-85dd-0011431cdcef" />

<img width="1237" height="907" alt="image" src="https://github.com/user-attachments/assets/d65bbf00-b9a6-4a31-b9c3-67ec7cb3fc4c" />

<img width="1712" height="902" alt="image" src="https://github.com/user-attachments/assets/60ccd7c2-2080-4170-a172-c4a1394ee081" />

<img width="1686" height="850" alt="image" src="https://github.com/user-attachments/assets/0ecc816d-befd-442e-820c-862e37b29ad1" />

---

**Developed as a Laravel Web Application Project.**

*Local Palate – Your next favorite restaurant is just a review away!* 🍕
