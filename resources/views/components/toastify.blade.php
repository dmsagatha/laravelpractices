@php
  $types = [
    'success' => 'linear-gradient(to right, #00b09b, #96c93d)',
    'error' => 'linear-gradient(to right, #ff5f6d, #ffc371)',
    'warning' => 'linear-gradient(to right, #f7b733, #fc4a1a)',
    'info' => 'linear-gradient(to right, #36d1dc, #5b86e5)',
  ];
@endphp

@foreach ($types as $type => $bg)
  @if (session($type))
    <script>
      document.addEventListener('DOMContentLoaded', () => {
        Toastify({
          text: '{{ session($type) }}',
          duration: 3000, // 8 segundos
          close: true,
          gravity: 'top',
          position: 'right',
          stopOnFocus: true,
          style: {
            background: '{{ $bg }}',
            borderRadius: '0.5rem',
            padding: '0.75rem 1rem',
            fontSize: '0.875rem',
            color: '#fff',
          },
        }).showToast();
      });
    </script>
  @endif
@endforeach
