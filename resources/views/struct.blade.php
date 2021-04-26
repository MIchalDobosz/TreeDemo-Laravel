<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tree Demo</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>

    <div class="container mb-5 mt-4">
        <h1 class="display-1 text-center">Tree Demo</h1>
    </div>

    <div class="row justify-content-center">
        <div class="col-10">
            {!! $list !!}
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-10">
            @foreach ($errors->all() as $error)
                <p class="error">{{ $error }}</p>
            @endforeach
        </div>
    </div>
    

    <script src="/js/script.js"></script>
</body>
</html>
