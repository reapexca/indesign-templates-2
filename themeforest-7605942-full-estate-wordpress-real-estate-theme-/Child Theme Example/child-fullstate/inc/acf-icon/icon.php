<?php

class acf_field_icon extends acf_field
{
    var $settings;
    
    /*
    *  __construct
    *
    *  Set name / label needed for actions / filters
    *
    *  @since    3.6
    *  @date    23/01/13
    */
    
    function __construct()
    {
        // vars
        $this->name = 'icon';
        $this->label = __("Icon",'acf');
        $this->defaults = array(
            'default_value'    =>    ''
        );
        
        
        // do not delete!
        parent::__construct();
        
        $this->settings = array(
            'path' => apply_filters('acf/helpers/get_path', __FILE__),
            'dir' => apply_filters('acf/helpers/get_dir', __FILE__),
            'version' => '0.5.a'
        ); 
    }
    
    
    
    /*
    *  create_field()
    *
    *  Create the HTML interface for your field
    *
    *  @param    $field - an array holding all the field's data
    *
    *  @type    action
    *  @since    3.6
    *  @date    23/01/13
    */
    
    function create_field( $field )
    {
        // vars
        $o = array('name', 'value', 'id');
        $e = '';
        
        $icons = array("accessibility-sign", "adjust", "adn", "adobe-pdf", "align-center", "align-justify", "align-left", "align-right", "amazon", "amazon-sign", "ambulance", "anchor", "android", "angle-down", "angle-left", "angle-right", "angle-up", "apple", "apple-itunes", "archive", "arrow-down", "arrow-left", "arrow-right", "arrow-up", "asterisk", "aws", "backward", "ban-circle", "bar-chart", "barcode", "beaker", "beer", "bell", "bell-alt", "bike-sign", "bing", "bing-sign", "bitbucket", "bitbucket-sign", "bitcoin", "blogger", "blogger-sign", "bold", "bolt", "book", "bookmark", "bookmark-empty", "briefcase", "bug", "building", "bullhorn", "bullseye", "bus-sign", "calendar", "calendar-empty", "camera", "camera-retro", "car-sign", "caret-down", "caret-left", "caret-right", "caret-up", "certificate", "check", "check-minus", "check-sign", "chevron-down", "chevron-left", "chevron-right", "chevron-sign-down", "chevron-sign-left", "chevron-sign-right", "chevron-sign-up", "chevron-up", "chrome", "circle", "circle-arrow-down", "circle-arrow-left", "circle-arrow-right", "circle-arrow-up", "circle-blank", "cloud", "cloud-download", "cloud-upload", "code", "code-fork", "coffee", "collapse", "collapse-alt", "collapse-top", "columns", "comment", "comment-alt", "comments", "comments-alt", "compass", "copy", "credit-card", "crop", "css3", "css3-more", "cut", "dashboard", "delicious", "desktop", "dollar", "double-angle-down", "double-angle-left", "double-angle-right", "double-angle-up", "download", "download-alt", "dribbble", "dribbble-sign", "dropbox", "drupal", "duck-duck-go", "edit", "edit-sign", "eject", "ellipsis-horizontal", "ellipsis-vertical", "envelope", "envelope-alt", "eraser", "euro", "evernote", "evernote-sign", "exchange", "exclamation", "exclamation-sign", "expand", "expand-alt", "external-link", "external-link-sign", "eye-close", "eye-open", "facebook", "facebook-sign", "facetime-video", "fast-backward", "fast-forward", "female", "fighter-jet", "file", "file-alt", "file-text", "file-text-alt", "film", "filter", "fire", "fire-extinguisher", "firefox", "flag", "flag-alt", "flag-checkered", "flickr", "flickr-more", "folder-close", "folder-close-alt", "folder-open", "folder-open-alt", "font", "food", "forrst", "forrst-sign", "forward", "foursquare", "foursquare-more", "frown", "fullscreen", "gamepad", "gbp", "gear", "gears", "gift", "git-fork", "github", "github-alt", "github-sign", "gittip", "glass", "globe", "google", "google-plus", "google-plus-sign", "google-sign", "group", "h-sign", "hacker-news", "hand-down", "hand-left", "hand-right", "hand-up", "hdd", "headphones", "heart", "heart-empty", "home", "hospital", "html5", "ie", "inbox", "indent-left", "indent-right", "info", "info-sign", "instagram", "instagram-more", "italic", "key", "keyboard", "laptop", "lastfm", "lastfm-sign", "layers", "leaf", "legal", "lemon", "level-down", "level-up", "lightbulb", "link", "linkedin", "linkedin-sign", "linux", "list", "list-alt", "list-ol", "list-ul", "location-arrow", "lock", "long-arrow-down", "long-arrow-left", "long-arrow-right", "long-arrow-up", "magic", "magnet", "mail-forward", "mail-reply", "mail-reply-all", "male", "map", "map-marker", "maxcdn", "medkit", "meh", "microphone", "microphone-off", "minus", "minus-sign", "minus-sign-alt", "mobile-phone", "money", "moon", "move", "ms-excel", "ms-ppt", "ms-word", "music", "ok", "ok-circle", "ok-sign", "opera", "paperclip", "paste", "pause", "paypal", "pencil", "phone", "phone-sign", "picasa", "picasa-sign", "picture", "pinterest", "pinterest-sign", "plane", "play", "play-circle", "play-sign", "plus", "plus-sign", "plus-sign-alt", "power-off", "print", "pushpin", "puzzle-piece", "qrcode", "question", "question-sign", "quote-left", "quote-right", "random", "reddit", "refresh", "remove", "remove-circle", "remove-sign", "renminbi", "renren", "reorder", "reply-all", "resize-full", "resize-horizontal", "resize-small", "resize-vertical", "retweet", "road", "rocket", "rotate-left", "rotate-right", "rss", "rss-sign", "rupee", "safari", "save", "screenshot", "search", "share", "share-sign", "share-this", "share-this-sign", "shield", "shopping-cart", "sign-blank", "signal", "signin", "signout", "sitemap", "skype", "skype", "smile", "sort", "sort-by-alphabet", "sort-by-alphabet-alt", "sort-by-attributes", "sort-by-attributes-alt", "sort-by-order", "sort-by-order-alt", "sort-down", "sort-up", "soundcloud", "sparrow", "sparrow-sign", "spinner", "spotify", "stack-overflow", "stackexchange", "star", "star-empty", "star-half", "star-half-full", "step-backward", "step-forward", "stethoscope", "stop", "strikethrough", "subscript", "suitcase", "sun", "superscript", "table", "tablet", "tag", "tags", "tasks", "taxi-sign", "terminal", "text-height", "text-width", "th", "th-large", "th-list", "thumbs-down", "thumbs-down-alt", "thumbs-up", "thumbs-up-alt", "ticket", "time", "tint", "trash", "trello", "trophy", "truck", "truck-sign", "tumblr", "tumblr-sign", "twitter", "twitter-sign", "umbrella", "unchecked", "underline", "unlink", "unlock", "unlock-alt", "upload", "upload-alt", "user", "user-md", "vimeo", "vimeo-sign", "vk", "volume-down", "volume-off", "volume-up", "warning-sign", "weibo", "windows", "windows-more", "won", "wordpress", "wordpress-sign", "wrench", "xing", "xing-sign", "yahoo", "yelp", "yelp-sign", "yen", "youtube", "youtube-play", "youtube-sign", "zip-file", "zoom-in", "zoom-out");        
        
        $e .= '<div class="acf-icon-wrap">';
        
        $e .= '<div id="'.$field['id'].'-sel" class="sel-icon"><i class="'.$field['value'].'"></i></div>';
        
        $e .= '<span class="slide-left" data-attach="'.$field['id'].'-out"></span>';
        $e .= '<div id="'.$field['id'].'-out" class="out-slide">';
        $e .= '<div id="'.$field['id'].'-content" class="slide-content" style="width: '.(ceil(count($icons)/2)*37).'px !important;">';
        foreach($icons as $icon) {
            if ('icon-'.$icon == $field['value'])
                $e .= "<div class=\"icon-cloude icon-selected\" data-input=\"{$field['id']}\"><i class=\"icon-$icon\"></i></div>";   
            else
                $e .= "<div class=\"icon-cloude\" data-input=\"{$field['id']}\"><i class=\"icon-$icon\"></i></div>";   
        }
        $e .= '</div></div><span class="slide-right" data-attach="'.$field['id'].'-out"></span>'."\n";
                                                              
        $e .= '<input type="hidden"';
        
        foreach( $o as $k )
        {
            $e .= ' ' . $k . '="' . esc_attr( $field[ $k ] ) . '"';    
        }
        
        $e .= ' />';
        $e .= '</div>';
        
        
        // return
        echo $e;
    }
    
    
    /*
    *  create_options()
    *
    *  Create extra options for your field. This is rendered when editing a field.
    *  The value of $field['name'] can be used (like bellow) to save extra data to the $field
    *
    *  @param    $field    - an array holding all the field's data
    *
    *  @type    action
    *  @since    3.6
    *  @date    23/01/13
    */
    
    function create_options( $field )
    {
        // vars
        $key = $field['name'];
        
        ?>
<tr class="field_option field_option_<?php echo $this->name; ?>">
    <td class="label">
        <label><?php _e("Default Value",'acf'); ?></label>
        <p><?php _e("Appears when creating a new post",'acf') ?></p>
    </td>
    <td>
        <?php 
        do_action('acf/create_field', array(
            'type'    =>    'text',
            'name'    =>    'fields[' .$key.'][default_value]',
            'value'    =>    $field['default_value'],
        ));
        ?>
    </td>
</tr>
        <?php
        
    }
    
    
    /*
    *  format_value()
    *
    *  This filter is appied to the $value after it is loaded from the db and before it is passed to the create_field action
    *
    *  @type    filter
    *  @since    3.6
    *  @date    23/01/13
    *
    *  @param    $value    - the value which was loaded from the database
    *  @param    $post_id - the $post_id from which the value was loaded
    *  @param    $field    - the field array holding all the field options
    *
    *  @return    $value    - the modified value
    */
    
    function format_value( $value, $post_id, $field )
    {
        //$value = htmlspecialchars($value, ENT_QUOTES);
        
        return $value;
    }
    
    
    /*
    *  format_value_for_api()
    *
    *  This filter is appied to the $value after it is loaded from the db and before it is passed back to the api functions such as the_field
    *
    *  @type    filter
    *  @since    3.6
    *  @date    23/01/13
    *
    *  @param    $value    - the value which was loaded from the database
    *  @param    $post_id - the $post_id from which the value was loaded
    *  @param    $field    - the field array holding all the field options
    *
    *  @return    $value    - the modified value
    */
    
    function format_value_for_api( $value, $post_id, $field )
    {
        // validate type
        if( !is_string($value) )
        {
            return $value;
        }
        
        
        return $value;
    }
    
    /*
    *  input_admin_enqueue_scripts()
    *
    *  This action is called in the admin_enqueue_scripts action on the edit screen where your field is created.
    *  Use this action to add css + javascript to assist your create_field() action.
    *
    *  $info    http://codex.wordpress.org/Plugin_API/Action_Reference/admin_enqueue_scripts
    *  @type    action
    *  @since    3.6
    *  @date    23/01/13
    */

    function input_admin_enqueue_scripts()
    {
        // register acf scripts
        wp_register_script( 'acf-input-icon', $this->settings['dir'] . 'js/input.js', array('acf-input'), $this->settings['version'] );
        wp_register_style( 'acf-input-icon', $this->settings['dir'] . 'css/input.css', array('acf-input'), $this->settings['version'] ); 
        
        wp_enqueue_style( 'iconf-font-awesome', $this->settings['dir'] . 'assets/css/font-awesome.css', array('acf-input'), $this->settings['version']);
        wp_enqueue_style( 'iconf-font-awesome-corp-styles', $this->settings['dir'] . 'assets/css/font-awesome-corp.css', array('acf-input'), $this->settings['version']);
        wp_enqueue_style( 'iconf-font-awesome-ext-styles', $this->settings['dir'] . 'assets/css/font-awesome-ext.css', array('acf-input'), $this->settings['version']);
        wp_enqueue_style( 'iconf-font-awesome-social-styles', $this->settings['dir'] . 'assets/css/font-awesome-social.css', array('acf-input'), $this->settings['version']);
        wp_enqueue_style( 'iconf-font-awesome-more-ie7', $this->settings['dir'] . 'assets/css/font-awesome-more-ie7.min.css', array('acf-input'), $this->settings['version']);
        
        
        // scripts
        wp_enqueue_script(array(
            'acf-input-icon',    
        ));

        // styles
        wp_enqueue_style(array(
            'acf-input-icon'   
        ));
        
    }
    
}

new acf_field_icon();
