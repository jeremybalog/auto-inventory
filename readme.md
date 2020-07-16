# Auto Inventory
This project was created to demonstrate several facets of my technical skill-set using vanilla PHP and JavaScript to create a prototype MVC auto dealer inventory website.

**Project Requirements:**
 - Simple clean design.
 - Login page for the user.
 - Basic inventory search page.
 - Basic Vehicle Detail Page (VDP).
 - No frameworks
 - XAMPP environment

**Screenshots**

![Search Page](https://raw.githubusercontent.com/jeremybalog/auto-inventory/master/public/img/screenshots/search.png)

![Vehicle Display Page](https://raw.githubusercontent.com/jeremybalog/auto-inventory/master/public/img/screenshots/vdp.png)

**Installation**
1. Download the repository: `git clone https://github.com/jeremybalog/auto-inventory`
2. Start XAMPP and configure the Apache root directory to use the `/public` directory.
3. Run database migration/seed task: `cd tasks && php migrate.php`
	- MariaDB must be configured to allow localhost connections without a password.
	- `dealer` schema and `dealer.cars` table will be created.
	- 100 cars will be added to the database with randomized values.
4. Open `http://localhost` to view the site.

**Technologies Used**
1. Water.css classless css (2.7kb): https://watercss.netlify.app/
2. Custom grid.css implementation (1.3kb).
3. Custom theme.css styles (2.6kb).
4. Custom search.js event handlers (0.9kb).
5. Inline SVG images with color fills.

**Unit Tests**
Since this app was developed without a framework, only a single unit test has been included to note test-driven development (TDD) is extremely important.  If a framework was used with full functionality to mock database queries with an ORM etc, additional unit tests would have been written to reduce technical debt and ensure long term durability.  The sole unit test can be run with `phpunit ./tests/Car.test.php`.

**On-Page SEO**
On-Page SEO is extremely important and several features have been included in this including title, h1, canonical links, and meta description tags.  For a live production site, additional schema.org structured data would be implemented including `AutoDealer` for local search, `BreadcrumbList` to provide explicit site hierarchy, and `Car` product type for VDPs for rich results.

 - [https://schema.org/AutoDealer](https://schema.org/AutoDealer)
 - [https://schema.org/BreadcrumbList](https://schema.org/BreadcrumbList)
 - [https://schema.org/Car](https://schema.org/Car)

**Technical SEO**
In a production environment, several changes would be made to ensure site performance.
- HTTPS enabled
- Brotli (preferred) or gzip compression enabled
- CDN used for static assets
- Filename versioning implemented for bundled static assets
- DNS and/or content prefetching

**Improvements**
- The migrations to setup the seed data/database does not include any indexes.  Indexes should be defined based on final production queries for performance.
- Since no framework or ORM was used and there are no user inputs, queries are not being made with escaped data, which means SQL injection is currently possible.  The version of XAAMP used had issues with prepared SQL statements.
- Based on coding philosophies, some logic in the `Car` model should be abstracted to a controller.  Likewise for some of the business logic in the views which may be better suited for a controller, but many of the PHP blocks would have helpers in view frameworks such as loops and if/else capabilities with blade templates.
