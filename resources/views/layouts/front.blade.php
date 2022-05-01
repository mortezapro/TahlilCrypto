
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="{{ asset("theme/front/assets/images/favicon.ico") }}">
    <link rel="stylesheet" type="text/css" href="{{ asset("theme/front/assets/vendor/font-awesome/css/all.min.css") }}">
    <link rel="stylesheet" type="text/css" href="{{ asset("theme/front/assets/vendor/bootstrap-icons/bootstrap-icons.css") }}">
    <link rel="stylesheet" type="text/css" href="{{ asset("theme/front/assets/vendor/tiny-slider/tiny-slider.css") }}">
    <link id="style-switch" rel="stylesheet" type="text/css" href="{{ asset("theme/front/assets/css/style.css") }}">
    @yield("head")
</head>
<body>
@include("front.partials.sidebar")
@include("front.partials.header")
<main>
    @yield("content")
</main>

@include("front.partials.footer")
<div class="back-top"><i class="bi bi-arrow-up-short"></i></div>
<script src="{{ asset("theme/front/assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js") }}"></script>
<script src="{{ asset("theme/front/assets/vendor/tiny-slider/tiny-slider.js") }}"></script>
<script src="{{ asset("theme/front/assets/vendor/sticky-js/sticky.min.js") }}"></script>
<script src="{{ asset("theme/front/assets/js/functions.js") }}"></script>
@include("layouts.front.functions")
@yield("script")
</body>

</html>
