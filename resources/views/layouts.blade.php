<!doctype html>
<html lang="en">
<head>
    @yield('head')
</head>
<body>
    @include('header')
    <div class="container-sm">
        @yield('content')
    </div>
</body>
<script>
    let container = $('.container-sm');
    $(window).resize(function (){
        if($(window).width() <= 780) {
            container.addClass('mx-0');
            container.removeClass('container-sm');
        }else{
            container.removeClass('mx-0');
            container.addClass('container-sm');
        }
    })
</script>
</html>

