<div class="control has-icons-right">
    <form role="search" method="get" class="search-form"
          action="<?php echo get_site_url(); ?>">
        <label class="label">
            <!--            <span class="screen-reader-text">--><?php //_e( 'Search for:', 'label' ) ?><!--</span>-->
            <input type="search" class="input is-rounded has-background-white is-medium search-field"
                   placeholder="<?php _e( 'Search &hellip;', 'mokime' ) ?>"
                   value="<?php get_search_query() ?>" name="s"/>
            <span class="icon is-right">
                <img src="/wp-content/themes/mokime/assets/img/icons/_ionicons_svg_md-search.svg" alt="Rechercher"
                     class="hover" width="24">
            </span>
        </label>
    </form>
</div>