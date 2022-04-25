@php
$config = [
'appName' => config('app.name'),
'locale' => ($locale = app()->getLocale()),
'locales' => config('app.locales'),
'githubAuth' => config('services.github.client_id'),
];
@endphp
<!DOCTYPE html>
<html lang="en" style="height: auto;" class="">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ str_replace("_"," ",config('app.name')) }}</title>
    <link rel="stylesheet" href="{{ mix('dist/css/app.css') }}">
    <link rel="stylesheet" href="https://unpkg.com/vue-multiselect@2.1.0/dist/vue-multiselect.min.css">
</head>

<body>
    <!-- wrapper -->
    <div id="app"> </div>
    <script>
        window.config = @json($config);
    </script>

    <script src="{{ mix('dist/js/app.js') }}"></script>
</body>

</html>