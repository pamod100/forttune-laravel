# Forttune Channels — Laravel Website + Admin Panel

This is the full Laravel backend for forttune.lk — database-driven website,
easy admin panel for managing products, and login system (Email/Password +
Google + Forgot Password).

---

## 1. What's Inside

```
forttune-laravel/
├── app/                    → Controllers, Models, Middleware
├── database/migrations/    → Creates: users, categories, products, orders tables
├── database/seeders/       → Creates admin login + sample categories/products
├── resources/views/
│   ├── frontend/           → Public website (home, products, cart)
│   ├── admin/              → Admin panel (dashboard, products, orders)
│   └── auth/                → Login, Register, Forgot Password
├── routes/web.php          → All routes
├── public/                 → CSS, JS, uploaded product images go here
└── .env.example            → Copy this to .env and fill in your details
```

---

## 2. Requirements

- PHP 8.1+ (XAMPP includes this)
- Composer ([getcomposer.org](https://getcomposer.org))
- A Supabase account (free tier is fine) — [supabase.com](https://supabase.com)

---

## 3. Step-by-Step Setup (XAMPP + Supabase)

### Step 1 — Place the project
Unzip this folder into your XAMPP htdocs, e.g.:
```
C:\xampp\htdocs\forttune-laravel
```

### Step 2 — Install dependencies
Open a terminal/CMD inside the folder and run:
```bash
composer install
```
This downloads Laravel + all packages (Socialite for Google login, Intervention Image for the photo resizing, etc.)

### Step 3 — Create your .env file
```bash
copy .env.example .env
```
(On Mac/Linux: `cp .env.example .env`)

Then generate the app encryption key:
```bash
php artisan key:generate
```

### Step 4 — Set up Supabase database
1. Go to [supabase.com](https://supabase.com) → create a new project (takes ~2 mins to provision)
2. Once ready, go to **Project Settings → Database**
3. Copy the **Connection string** values into your `.env` file:

```
DB_CONNECTION=pgsql
DB_HOST=db.xxxxxxxxxxxxx.supabase.co
DB_PORT=5432
DB_DATABASE=postgres
DB_USERNAME=postgres
DB_PASSWORD=your-supabase-database-password
```

> 💡 **Want to test locally first without Supabase?** You can use XAMPP's MySQL
> instead — open phpMyAdmin, create a database called `forttune_db`, then in `.env`
> comment out the `pgsql` lines and uncomment the `mysql` lines (see comments in `.env.example`).
> Just remember you'll eventually need to switch to Supabase per the signed proposal.

### Step 5 — Run migrations + seed sample data
This creates all the database tables AND your first admin login:
```bash
php artisan migrate --seed
```

You should see tables being created: `users`, `categories`, `products`, `orders`, etc.

### Step 6 — Link the storage folder (for image uploads)
```bash
php artisan storage:link
```

### Step 7 — Start the server
```bash
php artisan serve
```
Visit: **http://localhost:8000**

---

## 4. Your Admin Login

After seeding, log in at **http://localhost:8000/login** with:

```
Email:    admin@forttune.lk
Password: Forttune@2026
```

**⚠️ Change this password immediately** — go to Supabase's Table Editor → `users` table,
or build a simple "change password" page, or just update it directly:
```bash
php artisan tinker
>>> $u = App\Models\User::where('email','admin@forttune.lk')->first();
>>> $u->password = Hash::make('YourNewSecurePassword');
>>> $u->save();
```

Once logged in as admin, you'll be redirected to **http://localhost:8000/admin** —
the admin panel where you can:
- ✅ Add/Edit/Delete products (with auto photo resize → fast-loading format)
- ✅ Manage categories
- ✅ View and update customer orders
- ✅ See dashboard stats (revenue, stock alerts, recent orders)

---

## 5. Setting Up Google Login

1. Go to [Google Cloud Console](https://console.cloud.google.com/apis/credentials)
2. Create a new project (or use existing)
3. Click **Create Credentials → OAuth Client ID**
4. Application type: **Web application**
5. Authorized redirect URI — add exactly:
   ```
   http://localhost:8000/auth/google/callback
   ```
6. Copy the **Client ID** and **Client Secret** into your `.env`:
   ```
   GOOGLE_CLIENT_ID=xxxxxxxx.apps.googleusercontent.com
   GOOGLE_CLIENT_SECRET=xxxxxxxx
   GOOGLE_REDIRECT_URI=http://localhost:8000/auth/google/callback
   ```
7. Restart `php artisan serve`. The "Continue with Google" button on the login/register
   pages will now work.

> When you deploy live (forttune.lk), add a SECOND redirect URI in Google Console:
> `https://forttune.lk/auth/google/callback`, and update `GOOGLE_REDIRECT_URI` in your
> live `.env` to match.

---

## 6. Setting Up Forgot Password Emails

The easiest option is Gmail SMTP:

1. Turn on 2-Step Verification on your Gmail account
2. Generate an **App Password**: [myaccount.google.com/apppasswords](https://myaccount.google.com/apppasswords)
3. In `.env`:
   ```
   MAIL_MAILER=smtp
   MAIL_HOST=smtp.gmail.com
   MAIL_PORT=587
   MAIL_USERNAME=your-email@gmail.com
   MAIL_PASSWORD=the-16-character-app-password
   MAIL_ENCRYPTION=tls
   MAIL_FROM_ADDRESS="info@forttune.lk"
   ```
4. Test it: go to `/forgot-password`, enter an account's email, and check the inbox.

> For production, consider a proper transactional email service (Mailgun, Postmark, SES)
> for better deliverability than personal Gmail SMTP.

---

## 7. WhatsApp Button

Already wired up — it's the floating green button on every page, bottom-left.
It opens a chat to the number set in `.env`:
```
WHATSAPP_NUMBER=94725516516
```
Change this to whichever number you want customers messaging.

---

## 8. Adding Your First Real Product

1. Log in as admin → go to **Products → Add New Product**
2. Fill in: Name, Brand, Category, Price, Processor/RAM/Storage (optional), Stock
3. Upload a photo — any size, any format (jpg/png). It's automatically resized
   and converted to a lightweight format so your site stays fast (per the proposal's
   "Automated Image Optimization Pipeline").
4. Tick "Show on homepage" if you want it featured.
5. Save — it appears on the live site instantly.

---

## 9. Useful Commands Reference

| Command | What it does |
|---|---|
| `php artisan migrate` | Create/update database tables |
| `php artisan migrate:fresh --seed` | ⚠️ Wipes DB and recreates with sample data |
| `php artisan serve` | Start local dev server |
| `php artisan route:list` | See all available routes |
| `php artisan tinker` | Interactive PHP console (e.g. to reset a password) |
| `composer install` | Install/update PHP packages |

---

## 10. Deploying to Live Hosting (forttune.lk)

Per the proposal's Zero-Downtime Guarantee:
1. Point a subdomain `staging.forttune.lk` to this app on your host
2. Update `.env`: `APP_URL`, `APP_ENV=production`, `APP_DEBUG=false`
3. Update Google OAuth redirect URI to the live domain
4. Run `php artisan migrate --seed` on the live database (Supabase — same one, or a separate production project)
5. Test everything on staging
6. Flip DNS from old WordPress site to this app on `www.forttune.lk`

---

Questions or stuck on a step? Just ask — happy to walk through any part of this.
