<x-layouts.app :title="__('Dashboard')">
    <div class="grid gap-4 md:grid-cols-4 lg:grid-cols-2">
      @php $charts = ['Status','Reservas (7 dias)']; @endphp
      @foreach (['chartStatus','chartLast7'] as $i => $canvasId)
        <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
          {{-- Pattern SVG de fundo --}}
          <svg class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" fill="none">
            <defs>
              <pattern id="pattern-{{ $i }}" x="0" y="0" width="8" height="8" patternUnits="userSpaceOnUse">
                <path d="M-1 5L5 -1M3 9L8.5 3.5" stroke-width="0.5"></path>
              </pattern>
            </defs>
            <rect stroke="none" fill="url(#pattern-{{ $i }})" width="100%" height="100%"></rect>
          </svg>
          {{-- Conteúdo do card --}}
          <div class="relative z-10 flex flex-col max-h-[90%] p-4 items-center">
            <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-200 mb-2">{{ $charts[$i] }}</h3>
            <canvas id="{{ $canvasId }}" class="flex-1"></canvas>
          </div>
        </div>
      @endforeach
    </div>
    <div class="grid gap-4 md:grid-cols-4 lg:grid-cols-2 mt-5">
        @php $charts = ['Top 5 Salas','Novos Usuários (7 dias)']; @endphp
        @foreach (['chartTopRooms','chartNewUsers'] as $i => $canvasId)
          <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
            {{-- Pattern SVG de fundo --}}
            <svg class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" fill="none">
              <defs>
                <pattern id="pattern-{{ $i }}" x="0" y="0" width="8" height="8" patternUnits="userSpaceOnUse">
                  <path d="M-1 5L5 -1M3 9L8.5 3.5" stroke-width="0.5"></path>
                </pattern>
              </defs>
              <rect stroke="none" fill="url(#pattern-{{ $i }})" width="100%" height="100%"></rect>
            </svg>
            {{-- Conteúdo do card --}}
            <div class="relative z-10 flex h-full flex-col p-4  items-center">
              <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-200 mb-2">{{ $charts[$i] }}</h3>
              <canvas id="{{ $canvasId }}" class="flex-1"></canvas>
            </div>
          </div>
        @endforeach
      </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
      // 1. Status Pie
      new Chart(document.getElementById('chartStatus'), {
        type: 'pie',
        data: {
          labels: @json(array_keys($byStatus->toArray())),
          datasets: [{ data: @json(array_values($byStatus->toArray())) }]
        },
        options: { plugins:{legend:{position:'bottom'}} }
      });

      // 2. Line Últimos 7 dias
        const last7 = @json($last7);
        new Chart(document.getElementById('chartLast7'), {
        type: 'line',
        data: {
            labels: last7.map(d => d.date),
            datasets: [{
            label: 'Reservas',
            data: last7.map(d => d.count),
            fill: false,
            tension: 0.3,
            pointRadius: 4,
            pointHoverRadius: 6,
            borderWidth: 2,
            }]
        },
        options: {
            scales: {
            y: {
                beginAtZero: true,
                ticks: {
                stepSize: 1,
                },
                grid: {
                drawBorder: false,
                color: (ctx) => ctx.tick.value === 0 ? '#000' : '#ddd',
                zeroLineColor: '#000'
                }
            },
            x: {
                grid: { display: false }
            }
            },
            plugins: {
            legend: { display: false },
            tooltip: {
                mode: 'index',
                intersect: false,
            }
            },
            interaction: {
            mode: 'nearest',
            axis: 'x',
            intersect: false
            }
        }
        });

      // 3. Bar Top Rooms
      const topRooms = @json($topRooms);
      new Chart(document.getElementById('chartTopRooms'), {
        type: 'bar',
        data: {
          labels: topRooms.map(r => r.name),
          datasets: [{ label:'Reservas', data:topRooms.map(r=>r.total) }]
        },
        options: { indexAxis:'y' }
      });

      // 4. Line Novos Usuários
      const newUsers = @json($newUsers);
      new Chart(document.getElementById('chartNewUsers'), {
        type: 'line',
        data: {
          labels: newUsers.map(d => d.date),
          datasets: [{ label:'Usuários', data:newUsers.map(d=>d.count), fill:false, tension:0.3 }]
        }
      });
    </script>
</x-layouts.app>
