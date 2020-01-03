<div class="control has-icons-right">
    <form role="search" method="get" class="search-form"
          action="<?php echo get_site_url(); ?>">
        <label class="label">
            <span class="screen-reader-text"><?php _x( 'Search for:', 'label' ) ?></span>
            <input type="search" class="input is-medium search-field"
                   placeholder="<?php esc_attr_x( 'Search &hellip;', 'placeholder' ) ?>"
                   value="<?php get_search_query() ?>" name="s"/>
            <span class="icon is-right">
                <img src="/wp-content/themes/mokime/assets/img/icons/search-24px.svg" alt=""
                     class="hover">
            </span>
        </label>
    </form>
</div>