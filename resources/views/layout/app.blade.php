<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Administración') | banco_gt</title>
    <style>
        *{box-sizing:border-box}body{margin:0;background:#f3f6fa;color:#17283c;font:16px/1.5 system-ui,sans-serif}header{background:#123b60;color:white;padding:20px max(5%,calc((100% - 1100px)/2))}header a{color:white;text-decoration:none;margin-right:24px}header strong{font-size:24px}nav{margin-top:12px}main{max-width:1100px;margin:32px auto;padding:0 20px}section,.card{background:white;padding:24px;border-radius:12px;box-shadow:0 2px 12px #17283c0d;margin-bottom:20px}h1{font-size:28px}a{color:#155c98}button,.button{display:inline-block;background:#155c98;color:white;border:0;border-radius:6px;padding:10px 16px;text-decoration:none;font:inherit;cursor:pointer}.danger{background:#ac3030}label{display:block;margin:18px 0 6px;font-weight:600}input,select{display:block;width:100%;padding:11px;border:1px solid #aab9c8;border-radius:6px;font:inherit}form.editor{max-width:650px}.actions{display:flex;gap:12px;align-items:center;flex-wrap:wrap;margin-top:20px}.actions form{margin:0}.table-wrap{overflow-x:auto}table{border-collapse:collapse;width:100%}th,td{text-align:left;padding:14px;border-bottom:1px solid #dce3eb}th{background:#edf3f8}.success{padding:16px;background:#dff3e7;border-radius:8px}.errors{padding:16px;background:#ffe5e5;border-radius:8px}.grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(260px,1fr));gap:20px}dt{font-weight:600;margin-top:12px}dd{margin:0;overflow-wrap:anywhere}svg{max-height:24px}small{color:#51657a}
    </style>
</head>
<body>
<header><a href="{{ url('/') }}"><strong>banco_gt</strong></a><nav><a href="{{ route('clientes.index') }}">Clientes</a><a href="{{ route('cuentas.index') }}">Cuentas</a></nav></header>
<main>
    @if(session('success'))<p class="success" role="status">{{ session('success') }}</p>@endif
    @if($errors->any())<div class="errors" role="alert"><strong>Revisa los datos:</strong><ul>@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>@endif
    @yield('content')
</main>
</body>
</html>
