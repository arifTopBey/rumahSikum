<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rumah Sikum | Digitalisasi UMKM Tangerang</title>
    <link rel="icon" href="{{ asset('image/icon.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

   
    <link rel="stylesheet" href="{{ asset('css/sidebarDashboard.css') }}">

    <script src="https://unpkg.com/lucide@latest"></script>

    
   
</head>
<body>
    
    @yield('content-dashboard')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
      lucide.createIcons();
      
      // Navbar scroll effect
      window.addEventListener('scroll', function() {
          if (window.scrollY > 50) {
              document.querySelector('.navbar').classList.add('py-2');
          } else {
              document.querySelector('.navbar').classList.remove('py-2');
          }
      });
    </script>
</body>
</html>