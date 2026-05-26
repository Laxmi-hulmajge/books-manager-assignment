Books Manager - WordPress Developer Assignment



Project Overview



This project is a custom WordPress solution developed as part of the WordPress Developer Assignment.



The solution includes a custom post type called "Books" with restricted access for logged-in users only. The project also includes a custom frontend template, shortcode-based listing page, pagination, responsive styling, and secure handling of custom fields.



\---



\# Features Implemented



\## 1. Custom Post Type - Books



A custom post type named `Books` was registered using WordPress APIs.



\### Included Fields:



\* Title (default WordPress field)

\* Author (custom text field)

\* Genre (dropdown field)

\* Published Date (date field)

\* Description (textarea field)



\### Genre Options:



\* Fiction

\* Non-Fiction

\* Sci-Fi

\* Biography



\---



\# 2. Restrict Access for Logged-in Users



Access restrictions were implemented using WordPress conditional functions and hooks.



\### Restricted Pages:



\* Single Book Pages

\* Books Listing Page



\### Restriction Logic:



If the user is not logged in, the following message is displayed:



"You must be logged in to view this content. Please log in or register."



The restriction was implemented using:



\* `is\_user\_logged\_in()`

\* `template\_redirect`



\---



\# 3. Front-End Display



\## Single Book Template



A custom template file:



`single-books.php`



was created to display:



\* Book Title

\* Author

\* Genre

\* Published Date

\* Description



\---



\## Books Listing Shortcode



A shortcode:



`\[books\_list]`



was created to display all books.



\### Features:



\* Book Title with permalink

\* Author

\* Genre

\* Pagination

\* 5 books per page



\### Technologies Used:



\* `WP\_Query`

\* `paginate\_links()`

\* WordPress Shortcodes API



\---



\# 4. Responsive Design



Responsive styling was added using custom CSS.



\### Styling Features:



\* Mobile-friendly layout

\* Readable typography

\* Responsive book cards

\* Proper spacing and alignment



CSS file:

`assets/css/style.css`



\---



\# 5. Security \& Validation



All custom field inputs were sanitized before saving.



\### Functions Used:



\* `sanitize\_text\_field()`

\* `sanitize\_textarea\_field()`

\* `esc\_html()`

\* `esc\_attr()`



\---



\# Project Structure



books-manager/

│

├── books-manager.php

├── assets/

│   └── css/

│       └── style.css

│

Theme Template:



\* single-books.php



\---



\# Installation Instructions



\## Step 1



Install WordPress locally using XAMPP.



\## Step 2



Copy the `books-manager` folder into:



`wp-content/plugins/`



\## Step 3



Activate the plugin from:



WordPress Admin → Plugins



\## Step 4



Add `single-books.php` to the active theme folder.



\## Step 5



Create a new page and add the shortcode:



`\[books\_list]`



\## Step 6



Publish the page and test frontend functionality.



\---



\# Technologies Used



\* WordPress

\* PHP

\* HTML

\* CSS

\* WP\_Query

\* Custom Post Types

\* Meta Boxes

\* WordPress Hooks

\* Shortcodes API



\---



\# SEO \& Website Strategy - Bacardi



\## 1. High-Intent Keywords



1\. Best cocktail recipes

2\. Easy rum cocktails

3\. Home mixology drinks

4\. Bacardi cocktail recipes

5\. Summer party cocktails



\---



\# On-Page SEO Recommendations



\* Improve heading structure (H1, H2, H3)

\* Optimize meta titles and descriptions

\* Add internal links between cocktail recipe pages

\* Improve image alt text optimization

\* Add FAQ schema markup for recipes



\---



\# UX Audit Recommendations



\## Issue 1: Slow Page Load Speed



\### Solution:



Optimize images, reduce unused scripts, and implement caching.



\## Issue 2: Poor Mobile Experience



\### Solution:



Improve responsive layouts and mobile navigation usability.



\## Issue 3: Weak Content Engagement



\### Solution:



Add related recipes, videos, and interactive cocktail guides.



\---



\# Local SEO Strategy



\## 1. Optimize Google Business Profiles



Create optimized local listings for Bacardi-sponsored bars and events.



\## 2. Create City-Specific Landing Pages



Target metro cities with localized event and cocktail content.



\## 3. Encourage Local Reviews \& Social Check-ins



Increase local engagement and visibility through user-generated content.



\---



\# Author



Laxmi Wadikar



