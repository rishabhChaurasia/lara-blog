# Laravel Blog

A comprehensive blog application built with Laravel, featuring role-based access control, post management, and user interaction capabilities.

## Features

- **Role-based Access Control**: Users have different roles (admin, author, user) with appropriate permissions
- **Post Management**: Create, edit, and manage blog posts with rich content
- **User Dashboard**: Authors can manage their posts from a dedicated dashboard
- **Category and Tag System**: Organize posts using categories and tags
- **Comment System**: Users can engage with posts through comments
- **Media Management**: Upload and manage featured images for posts
- **Search Functionality**: Find posts by content or metadata
- **Responsive Design**: Works well on desktop and mobile devices

## User Roles

- **Admin**: Full access to all features, can manage users, posts, comments, and site settings
- **Author**: Can create, edit, and manage their own posts
- **User**: Can browse posts, read content, and leave comments

## Role-based Navigation

- **Admin users** are redirected to `/admin/dashboard` after login
- **Author and regular users** are redirected to the homepage (`/`) after login
- **Authors** can access `/dashboard` to manage their posts

## Installation

1. Clone the repository:
   ```bash
   git clone <repository-url>
   cd lara-blog
   ```

2. Install dependencies:
   ```bash
   composer install
   npm install
   ```

3. Set up environment:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. Configure your database settings in `.env`

5. Run migrations and seeders:
   ```bash
   php artisan migrate --seed
   ```

6. Start the development server:
   ```bash
   php artisan serve
   ```

## Seeded User Accounts

The application comes with pre-seeded user accounts for testing:

- **Admin**: admin@example.com (password: password)
- **Author**: author@example.com (password: password)
- **User**: user@example.com (password: password)

## Development

This project uses Laravel Breeze for authentication and Tailwind CSS for styling. To build the CSS:

```bash
npm run dev
# or for production
npm run build
```

## Contact

For questions or support regarding this project, please contact:

Rishabh - rishabh.78275@gmail.com

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
