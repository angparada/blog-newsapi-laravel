<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
  </head>
  <body class="bg-light">
    <main>
      <section class="py-5 text-center container">
        <div class="row py-lg-5">
            <div class="col-lg-6 col-md-8 mx-auto">
                <h1 class="fw-light">Blog</h1>
                <p class="lead text-body-secondary">Explora las últimas noticias relacionadas con Tesla, incluyendo actualizaciones sobre ventas, resultados financieros y más.</p>
            </div>
        </div>
      </section>
      <div class="news py-5 bg-body-tertiary">
        <div class="container">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                @foreach ($articles as $item)
                    <div class="col">
                        <div class="card shadow-sm h-100">
                            <a href="{{ $item['url'] }}" target="_blank" aria-label="{{ $item['title'] }}">
                            @if ( empty($item['image']))
                                <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"></rect><text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text></svg>
                            @else
                                <img src="{{ $item['image'] }}" alt="{{ $item['title'] }}" class="bd-placeholder-img card-img-top" width="100%" height="225" preserveAspectRatio="xMidYMid slice">
                                
                            @endif
                            </a>
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title">{{ $item['title'] }}</h5>
                                <p class="card-text">{{ $item['description'] }}</p>
                                <div class="d-flex justify-content-between align-items-center mt-auto">
                                    <div class="btn-group">
                                        <a href="{{ $item['url'] }}" class="btn btn-sm btn-outline-secondary" target="_blank">Ver articulo</a>
                                    </div>
                                    <div>
                                        <img src="{{ $item['avatar'] }}" alt="{{ $item['author'] }}" class="rounded-circle me-2">
                                        <small class="text-body-secondary">{{ $item['author'] }}</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            {{-- Paginación --}}
    <nav class="mt-4">
        <ul class="pagination justify-content-center">
            @if($page > 1)
                <li class="page-item">
                    <a class="page-link" href="?page={{ $page - 1 }}">Anterior</a>
                </li>
            @endif
            <li class="page-item active">
                <span class="page-link">{{ $page }}</span>
            </li>
            <li class="page-item">
                <a class="page-link" href="?page={{ $page + 1 }}">Siguiente</a>
            </li>
        </ul>
    </nav>
        </div>
      </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
  </body>
</html>
<!--

"source" => array:2 [▶]
    "author" => "Agencia AP"
    "title" => "Tesla, afectada por protestas y caída en ventas, informará resultados del primer trimestre"
    "description" => "Tesla difundirá sus resultados financieros del primer trimestre, mientras el fabricante de vehículos eléctricos lidia con ventas lentas y las repercusiones del  ▶"
    "url" => "https://www.milenio.com/negocios/tesla-afectada-caida-ventas-dara-resultados-tercer-trimestre"
    "urlToImage" => "https://cdn.milenio.com/uploads/media/2025/04/12/companias-tesla-continuan-enfrentando-perdidas.jpg"
    "publishedAt" => "2025-04-22T21:04:00Z"
    "content"
-->