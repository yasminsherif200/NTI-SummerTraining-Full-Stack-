# ShopEasy — Simple E-commerce Assignment

A 3-page PHP mini e-commerce site built for the assignment brief (Home / All Products / Account),
using plain PHP, sessions, server-side validation, and Bootstrap 4 cards.

## How to run

1. Put the `ecommerce` folder in your local server root (XAMPP `htdocs`, or anywhere PHP can serve from).
2. From a terminal, you can also just run PHP's built-in server:
   ```
   cd ecommerce
   php -S localhost:8000
   ```
3. Open `http://localhost:8000/index.php` in your browser.

## Pages

- **`index.php`** — Home page. Navbar (site name on the left, Home / All Products / Account on the
  right) plus a header with a background image and "Welcome to our store".
- **`all_products.php`** — Builds a `$products` associative array (product name => price/img/desc),
  loops over it with `foreach ($products as $product => $values)`, and displays each one in a
  Bootstrap card.
- **`account.php`** — Has three states, driven by `$_SESSION`:
  1. **Not logged in** → shows the simple sign-in form (email + password). On submit, both fields
     are validated server-side; on success the data is saved to the session and the user is
     redirected to `all_products.php`.
  2. **Logged in, no profile yet** → shows the extended profile form (username, password, email,
     phone, Facebook/Twitter/Instagram URLs). Every field is validated; on success the data is
     saved to the session and the user is redirected to `index.php`.
  3. **Logged in with a completed profile** → shows a short "Welcome back" summary of the saved
     profile data.
- **`logout.php`** — Calls `session_destroy()` and redirects to `index.php`. After logout, visiting
  `account.php` shows the sign-in form again, as required.

## Validation rules

| Field | Rule |
|---|---|
| Email | required, must pass `FILTER_VALIDATE_EMAIL` |
| Password | required, minimum 6 characters |
| Username | required, minimum 3 characters |
| Phone | required, Egyptian mobile format (`01[0/1/2/5]xxxxxxxx`) |
| Facebook / Twitter / Instagram URL | required, must be a valid URL containing the matching domain |

All error messages are shown next to the relevant field (Bootstrap `is-invalid` / `invalid-feedback`),
and whatever the user already typed is kept in the form instead of being wiped out.

## Files

```
ecommerce/
├── index.php
├── all_products.php
├── account.php
├── logout.php
├── includes/
│   ├── config.php     (session_start + helper functions)
│   └── navbar.php     (shared navbar partial)
├── css/
│   └── style.css
├── img/
│   ├── header-bg.jpg
│   └── 1.png ... 6.png   (placeholder product images — swap with your own)
└── README.md
```

## Notes / things you can customize

- Product images and the header background are simple generated placeholders — replace the files
  in `img/` with real photos (keep the same filenames, or update the paths in `all_products.php`
  / `css/style.css`).
- Passwords are stored in `$_SESSION` in plain text for simplicity, matching the assignment scope.
  In a real app you'd hash them with `password_hash()` and use a database instead of the session.
