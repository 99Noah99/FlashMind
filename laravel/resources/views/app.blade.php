<!DOCTYPE html>
<html>
  <head>
    <title>FlashMind</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}" />
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bangers&family=Zain&display=swap" rel="stylesheet">
    @viteReactRefresh
    @vite('resources/js/app.jsx')
    @routes
    @inertiaHead
  </head>
  <body>
    @inertia
  </body>
</html>