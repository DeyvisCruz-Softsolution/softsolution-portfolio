<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>@yield('title', 'CV Portafolio')</title>

  {{-- ========================= --}}
  {{-- ARCHIVOS DE ESTILO Y VITE --}}
  {{-- ========================= --}}
  @if(app()->environment('production'))
      {{-- En producción (Render) carga los assets compilados --}}
      <link rel="stylesheet" href="{{ asset('build/assets/app.css') }}">
      <script type="module" src="{{ asset('build/assets/app.js') }}"></script>
  @else
      {{-- En desarrollo (local con npm run dev) --}}
      @vite(['resources/css/app.css', 'resources/js/app.js'])
  @endif

  {{-- Librerías externas --}}
  <script src="https://code.jquery.com/jquery-3.7.1.min.js" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/turn.js@4/turn.min.js"></script>

  {{-- Font Awesome --}}
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer"/>

  {{-- Estilos internos --}}
  <style>
    :root{
      --nav:#ffffff;
      --text:#777;
      --text-active:#1e1e1e;
      --accent:#22c55e;
      --h:44px;
      --r:14px;
    }

    body{
      background:#000;
      color:#111827;
      font-family: ui-sans-serif, system-ui, -apple-system, "Segoe UI", Roboto, Arial;
      min-height:100vh;
      display:flex;
      flex-direction:column;
    }

    header{ background:#4338ca; color:#fff; }
    main{ flex:1 1 auto; }
    footer{ background:#4338ca; color:#fff; }

    /* NAV */
    .nav-container{ position:relative; display:flex; align-items:center; gap:6px; background:var(--nav); border-radius:var(--r); padding:4px 10px; box-shadow:0 4px 12px rgba(0,0,0,.15); overflow:visible; }
    .nav-link{ position:relative; width:var(--h); height:var(--h); display:flex; flex-direction:column; align-items:center; justify-content:center; color:var(--text); text-decoration:none; z-index:2; transition:color .25s ease; }
    .nav-link.active i{ opacity:0; transform:scale(0.5); transition: all .25s ease; }
    .nav-link .label{ font-size:10px; margin-top:4px; opacity:0; transform:translateY(6px); transition:all .25s ease; color:var(--text-active); pointer-events:none; }
    .nav-link.active .label{ opacity:1; transform:translateY(0); }
    .indicator{ position:absolute; top:calc(-.5 * var(--h) + 6px); left:0; width:var(--h); height:var(--h); background:var(--accent); border-radius:50%; z-index:1; display:flex; align-items:center; justify-content:center; color:#fff; font-size:16px; transition:transform .45s cubic-bezier(.65,0,.35,1); }
    .indicator::before,.indicator::after{ content:""; position:absolute; bottom:-6px; width:18px; height:18px; border-radius:50%; box-shadow: 0 8px 0 0 var(--nav); }
    .indicator::before{ left:-9px; }
    .indicator::after{ right:-9px; }
    .nav-link i{ font-size:16px; transition: all .25s ease; }
  </style>
</head>
<body>
  <header class="shadow p-4">
    <div class="container mx-auto flex justify-between items-center">
      <div class="flex flex-col">
        <h1 class="text-2xl font-bold">PORTAFOLIO</h1>
        <p class="text-sm">DEYVIS FABIANY CRUZ CARVAJAL</p>
      </div>

      <nav class="nav-container">
        @php
          $links = [
            ['route'=>'home','icon'=>'fa-house','label'=>'Inicio'],
            ['route'=>'about','icon'=>'fa-user','label'=>'Sobre mí'],
            ['route'=>'projects','icon'=>'fa-briefcase','label'=>'Proyectos'],
            ['route'=>'education','icon'=>'fa-graduation-cap','label'=>'Educación'],
            ['route'=>'experience','icon'=>'fa-screwdriver-wrench','label'=>'Experiencia'],
            ['route'=>'skills','icon'=>'fa-code','label'=>'Habilidades'],
            ['route'=>'blog','icon'=>'fa-newspaper','label'=>'Blog'],
            ['route'=>'contact','icon'=>'fa-envelope','label'=>'Contacto'],
          ];
        @endphp

        @foreach($links as $link)
          <a href="{{ route($link['route']) }}" class="nav-link {{ request()->routeIs($link['route'].'*') ? 'active' : '' }}">
            <i class="fa-solid {{ $link['icon'] }}"></i><span class="label">{{ $link['label'] }}</span>
          </a>
        @endforeach

        <div class="indicator"><i class="fa-solid fa-house"></i></div>
      </nav>
    </div>
  </header>

  <main class="container mx-auto py-10">
    @yield('content')
  </main>

  <footer class="p-4 text-center">
    &copy; {{ date('Y') }} Portafolio creado por Deyvis Cruz @SoftSolution E.U... Todos los derechos reservados.
  </footer>

  <script>
    const links = Array.from(document.querySelectorAll('.nav-link'));
    const indicator = document.querySelector('.indicator');

    function moveIndicator(el){
      const left = el.offsetLeft;
      indicator.style.transform = `translateX(${left}px)`;
      indicator.innerHTML = el.querySelector('i').outerHTML;
      links.forEach(l => l.classList.remove('active'));
      el.classList.add('active');
    }

    document.addEventListener('DOMContentLoaded', () => {
      const current = document.querySelector('.nav-link.active') || links[0];
      if(current) moveIndicator(current);
      links.forEach(link => link.addEventListener('click', () => moveIndicator(link), { passive:true }));
    });

    window.addEventListener('resize', () => {
      const current = document.querySelector('.nav-link.active');
      if(current) moveIndicator(current);
    });
  </script>
</body>
</html>
