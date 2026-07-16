# Tycoon Duro — cPanel Production Deployment

Domain: **tycoonduro.com** · cPanel user: **nsts8cfzsghe**

> This file is committed to a public repository. **Never put passwords, API keys
> or the `APP_KEY` in here** — they belong only in the server's `.env`.

## How deployment works
- The cPanel-managed clone lives under `/home/nsts8cfzsghe/repositories/tycon`.
- **Git Version Control → Pull or Deploy → Deploy HEAD Commit** runs `.cpanel.yml`,
  which copies the code into `/home/nsts8cfzsghe/public_html`.
- The root `.htaccess` rewrites every request into `public/`, so the framework is
  served from `public_html/public` and the source sits in `public_html`.
- `.cpanel.yml` deliberately does **not** copy `.env`, `storage/` or `vendor/` —
  the server's own copies survive every deploy.

## First-time setup (once)
1. **Database** — cPanel → MySQL® Databases: create the database and user,
   grant **ALL PRIVILEGES**, and note the real `nsts8cfzsghe_`-prefixed names.
2. **`.env`** — copy `.env.example` to `/home/nsts8cfzsghe/public_html/.env` and fill in:
   - `APP_ENV=production`, `APP_DEBUG=false`, `APP_URL=https://tycoonduro.com`
   - `DB_DATABASE` / `DB_USERNAME` / `DB_PASSWORD` from step 1
   - `ADMIN_EMAIL`, `ADMIN_PASSWORD`, `APEX_API_KEY`, `APEX_ENABLED=true`
   - then run `php artisan key:generate` (see the `APP_KEY` warning below).
3. **Repository** — cPanel → Git™ Version Control → Create:
   - Clone URL: `https://github.com/somethinggreat-stack/tycon.git`
   - Repository Path: `/home/nsts8cfzsghe/repositories/tycon`
4. **Install + migrate** — cPanel → Terminal:
   ```bash
   cd /home/nsts8cfzsghe/public_html
   composer install --no-dev --optimize-autoloader
   php artisan migrate --force
   php artisan config:cache && php artisan route:cache && php artisan view:cache
   chmod -R 775 storage bootstrap/cache
   ```

## Every deploy after that
1. Push to `main` on GitHub.
2. cPanel → Git™ Version Control → **Manage** → **Pull or Deploy** → **Update from Remote**,
   then **Deploy HEAD Commit**.
3. If the deploy changed `composer.lock`, `config/`, `routes/` or views, re-run the
   `composer install` / `artisan cache` commands from step 4 above — **cached config is
   not refreshed by the deploy itself**, so changes will not appear until you do.

## Verify
- https://tycoonduro.com loads over HTTPS (enable AutoSSL if needed).
- https://tycoonduro.com/admin/login accepts the `ADMIN_EMAIL` / `ADMIN_PASSWORD` from `.env`.
- Submit a test lead and a test `/onboarding`, confirm they appear in
  **Admin → Leads / Onboarded Clients** and **Apex → New Clients**, then delete the test rows.
- Confirm https://tycoonduro.com/.env and https://tycoonduro.com/config/database.php
  both fail — if either returns content, the root `.htaccess` is not being applied.

## Notes
- **Uploaded documents** live privately in `storage/app/private/onboarding/` and are
  downloaded only through the admin dashboard. `.cpanel.yml` never overwrites them.
- **`APP_KEY` must stay stable.** Changing it makes previously-encrypted SSNs and
  passwords permanently unreadable.
- `env()` is only read inside `config/`, so `config:cache` is safe.
