
WordPress best pratices : https://make.wordpress.org/themes/handbook/review/resources/

### Testing

* Install WP on a server
* Find accessibility test online
* Pass Google Pagespeed
* Pass Schema.org validator from Google
* **OK** W3C validator
* <del>Theme Check</del>
* SEO online check
  * Screaming frog
  * https://www.seoptimer.com/www.security-helpzone.com 

### Theming

* Use style from Gutenberg ? https://wordpress.org/support/topic/block-library-documentation/#new-topic-0
  * Menu navigation ko with Bulma
* <del>Search page</del>
* <del>Menu with social icons (footer + header)</del>
* PO/MO files... 
* Configuration Theme in Style.css
  * Tags
  * Options 
  * Include screenshot.png or screenshot.jpg.
* <del>Add skip links in header</del>
* <del>Search bar in header : must have visible label https://make.wordpress.org/themes/handbook/review/accessibility/required/#forms</del>
* <del>Add roles for navigation : https://make.wordpress.org/themes/handbook/review/accessibility/required/#aria-landmark-roles</del>
* <del>Remove custom header from theme, use wordpress on instead</del>
    * <del>selective_refresh with render_callback</del>
    * <del>custom colors for</del>
        * <del>primary color</del>
        * <del>header</del>
            * <del>header background</del>
            * <del>header text color</del>
        * <del>footer</del>
            * <del>footer background</del>
            * <del>footer text color</del>
        * <del>background</del>
    * Applying styles :  **remove color styling in Milligram ?**
    
### Markups

* Remove empty functions and so
* Commenting HTML classes `<!-- .end -->`
* HTML5 segmentation properly
* SEO points
  * Titles in sidebar
  * `aside` for articles links from same category?

 ### Frontoffice
 
* Implements Yoast SEO breadcrumb
* Change sidebar artcile presentation
* Remove schema markup
* Add modif/add date in poste

#### Design

* Use Gutenberg style ?
* Change submenu for Bulma Navbar
    * Remove unused bulma style
* Post category design
* Comments
* Author card

### Coding style

* Second level dropdown : https://codepen.io/sakthig/pen/RvwVYM?editors=1100
* Autoprefixer : https://github.com/postcss/autoprefixer#javascript
* Coding : https://torquemag.io/2018/01/enforce-code-standards-wordpress-development-using-composer/

### Customizer

* Include post navigation : checkbox

# Version 1.1

* 100% theme accessibility : https://make.wordpress.org/themes/handbook/review/accessibility/
* 
* Add schema.org Article
  * https://developers.google.com/search/docs/data-types/article#non-amp
  * https://schema.org/Article