<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>@yield('title') | {{ setting('website_name', 'WebAdmin') }}</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<!--Favicon -->
@if (setting('favicon'))
    <link href="{{ asset('storage/' . setting('favicon')) }}" rel="shortcut icon" type="image/x-icon" />
@endif

<link href="{{ asset('assets/web/css/style.css') }}" rel="stylesheet" />
