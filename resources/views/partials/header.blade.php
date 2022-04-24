<header class="banner p-3">
  <div class="container">
    <a class="brand" href="{{ home_url('/') }}">
        @php
        $custom_logo = get_theme_mod( 'custom_logo' );
        $logo = wp_get_attachment_image_src( $custom_logo , 'full' );
        @endphp
        <img src="@php echo $logo[0]; @endphp" class="img-responsive" alt="Logo">
    </a>
    <nav class="nav-primary">
      @if (has_nav_menu('primary_navigation'))
        {!! wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'nav']) !!}
      @endif
    </nav>
  </div>
</header>
