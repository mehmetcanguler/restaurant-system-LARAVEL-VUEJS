<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
    @vite('resources/css/app.css')
</head>
<body>

    <div id="app"> 
        <main-component 
        :tables_prop='@json($tables)'
        ></main-component>          
    </div>
    
    @vite('resources/js/app.js')
</body>
</html>