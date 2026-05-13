# Deploying AKU 92 to GoDaddy cPanel + MySQL

Target stack: **cPanel shared / business hosting**, **PHP 8.3**, **MySQL**,
**aku92.com** (primary domain).

Total time once everything is in place: ~15–20 minutes.

---

## 0. Before you start (one-time prep in cPanel)

1. **Set PHP to 8.3**
   `cPanel → MultiPHP Manager → select aku92.com → PHP 8.3 → Apply`

2. **Enable required PHP extensions** (most are on by default; turn anything
   from this list ON if it's not):
   `cPanel → Select PHP Version → Extensions`
   `mbstring, openssl, pdo_mysql, tokenizer, xml, ctype, json, bcmath,
    fileinfo, gd, curl, intl, zip`

3. **Create the MySQL database**
   `cPanel → MySQL Databases`
   * New database — e.g. `aku92_main`
   * New user — e.g. `aku92_user`, generate a strong password (save it!)
   * Add the user to the database with **ALL PRIVILEGES**

4. **Make sure Composer is available**
   `cPanel → Terminal` (or SSH) → `composer --version`
   If not installed, ask GoDaddy support to enable it, or upload `composer.phar`
   to your home directory and run `php composer.phar` everywhere instead.

5. **(Optional) Install Git**
   If `git --version` works in the Terminal you can clone directly.
   Otherwise download the repo ZIP from GitHub and upload via File Manager.

---

## 1. Upload the code

Pick **one** of the two methods.

### A. Git clone (fastest if git works)

```bash
cd ~
git clone https://github.com/dhkakkar/aku92.git aku92-app
cd aku92-app
```

### B. ZIP upload via File Manager

1. On the repo page in GitHub → **Code → Download ZIP**
2. cPanel → File Manager → home directory → upload the ZIP
3. Right-click the ZIP → Extract → rename the extracted folder to `aku92-app`

After either method you should see `~/aku92-app/` with `artisan`, `composer.json`,
`public/`, `app/`, `database/` inside.

---

## 2. Install PHP dependencies

```bash
cd ~/aku92-app
composer install --no-dev --optimize-autoloader
```

This creates `vendor/`. Takes 1–2 minutes.

---

## 3. Configure the environment

```bash
cd ~/aku92-app
cp .env.production.example .env
nano .env                    # or edit via cPanel File Manager
```

Fill in only these blanks:

```
DB_DATABASE=aku92_main        # full cPanel name, e.g. cpaneluser_aku92_main
DB_USERNAME=aku92_user        # full cPanel name, e.g. cpaneluser_aku92_user
DB_PASSWORD=********          # the password you set in step 0.3
MAIL_PASSWORD=xxxxxxxxxxxxxxxx # 16-char Gmail App Password
```

Generate the application key:

```bash
php artisan key:generate
php artisan config:clear
```

---

## 4. Run database migrations

```bash
cd ~/aku92-app
php artisan migrate --force
```

You'll see ~30+ migrations run, ending with the most recent
`update_product_image_paths`. All seeders are baked into migrations, so the
home / akash / prashuka / healthcare / shop pages will have content the moment
this completes.

> ⚠ The dev site uses Neon Postgres. The production database starts from
> seeded copy only — any text edits done in the dev admin panel are **not**
> automatically carried over. After deploy, log into `/admin` and review the
> page editors so everything reads the way the client expects.

---

## 5. Storage symlink

```bash
cd ~/aku92-app
php artisan storage:link
```

If the command says "symlink not allowed" on shared hosting, create it manually
via the Terminal:

```bash
ln -s ~/aku92-app/storage/app/public ~/aku92-app/public/storage
```

---

## 6. Point aku92.com at Laravel's `public/` folder

cPanel always serves traffic from `~/public_html/`. We want it to serve
`~/aku92-app/public/` instead. Use **one** of these methods.

### Easiest: copy `public/` contents into `public_html/`

```bash
cd ~/aku92-app/public
cp -r . ~/public_html/
```

Then edit `~/public_html/index.php` and change the two lines that load the
framework:

```php
require __DIR__.'/../aku92-app/vendor/autoload.php';
$app = require_once __DIR__.'/../aku92-app/bootstrap/app.php';
```

Also copy `~/aku92-app/public/.htaccess` to `~/public_html/.htaccess` if it
didn't come over.

### Cleanest (if SSH allows symlinks): replace `public_html`

```bash
cd ~
mv public_html public_html.old
ln -s ~/aku92-app/public public_html
```

This way every future deploy is just `git pull` + `php artisan migrate
--force` — no manual file copies.

---

## 7. Permissions

```bash
cd ~/aku92-app
chmod -R 755 storage bootstrap/cache
```

If you still see "Permission denied" when uploading images via the admin,
loosen to `775` (cPanel runs PHP under the same user, so 755 is usually fine).

---

## 8. Final cleanup + cache warm-up

```bash
cd ~/aku92-app
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan filament:cache-components
```

---

## 9. Make sure SSL is on

`cPanel → SSL/TLS Status → Run AutoSSL` (Let's Encrypt). Once the green lock
appears, your site is live at https://aku92.com.

---

## 10. Smoke-test checklist

* [ ] `https://aku92.com/` — home loads, 4 cards visible
* [ ] `/healthcare` — hub, all sidebar links work
* [ ] `/healthcare/opd-form` — form submits, success message
      and a "New OPD Booking" email arrives at
      **advocatemjain1967@gmail.com**
* [ ] `/shop` — products listed; add to cart → checkout → place order →
      thank-you page appears, order shows up in `/admin/orders`
* [ ] `/gallery` — page loads (empty until images uploaded)
* [ ] `/admin/login` — `admin@aku92.com` / `Aku92@2026` works (change
      password immediately from Edit profile)

---

## 11. Day-to-day update workflow

Every time we push code from dev:

```bash
cd ~/aku92-app
git pull
composer install --no-dev -o      # only if vendor changed
php artisan migrate --force
php artisan view:clear
php artisan filament:cache-components
```

(If you copied `public/` files in step 6's easy method, also re-run the
`cp -r ~/aku92-app/public/. ~/public_html/` step when `public/` files change —
that's why the symlink method is much nicer.)

---

## Troubleshooting

| Symptom | Fix |
|---|---|
| **500 error** on every page | `cd ~/aku92-app && tail -30 storage/logs/laravel.log` — almost always `.env` or DB credentials |
| **"No application encryption key has been specified"** | `php artisan key:generate` then `php artisan config:clear` |
| **Images in admin upload but don't show on the site** | `storage:link` not created — run step 5 |
| **Admin login redirects in a loop** | Visit `/admin/login` directly; clear browser cookies |
| **OPD email not arriving** | `php artisan tinker --execute='Mail::raw("test", fn($m) => $m->to(config("mail.opd_notification_to"))->subject("test"));'` — error text will say if it's an SMTP / app-password problem |
| **Cron / queues** | Not required — we use `QUEUE_CONNECTION=sync` so jobs run inline |

---

If anything fails along the way send me:
1. The exact command you ran
2. The error message
3. The last ~20 lines of `storage/logs/laravel.log`

…and I'll debug.
