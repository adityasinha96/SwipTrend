@extends('layouts.admin')

@section('content')
<div class="content">
  <div class="row">
    <div class="col-lg-12">
      <div class="card">

        {{-- HERO HEADER --}}
        <div class="card-header p-0 bg-white border-0">
          <div class="dashboard-hero">
            <div>
              <h2>Dashboard</h2>
              <div class="hero-sub">Welcome back, {{ auth()->user()->name ?? 'Admin' }}</div>
            </div>
          </div>
        </div>

        {{-- BODY --}}
        <div class="card-body pt-3">
          @if(session('status'))
            <div class="alert alert-success" role="alert">
              {{ session('status') }}
            </div>
          @endif

          <div class="row">
            {{-- STAT CARDS --}}
            <div class="{{ $settings1['column_class'] }}">
              <div class="card stat-card h-100">
                <div class="card-body">
                  <div class="stat-meta">
                    <span class="stat-label">{{ $settings1['chart_title'] }}</span>
                    <span class="stat-icon">
                      <i class="{{ $settings1['icon'] ?? 'fas fa-chart-line' }}"></i>
                    </span>
                  </div>
                  <div class="stat-value">{{ number_format($settings1['total_number']) }}</div>
                </div>
              </div>
            </div>

            <div class="{{ $settings2['column_class'] }}">
              <div class="card stat-card h-100">
                <div class="card-body">
                  <div class="stat-meta">
                    <span class="stat-label">{{ $settings2['chart_title'] }}</span>
                    <span class="stat-icon">
                      <i class="{{ $settings2['icon'] ?? 'fas fa-users' }}"></i>
                    </span>
                  </div>
                  <div class="stat-value">{{ number_format($settings2['total_number']) }}</div>
                </div>
              </div>
            </div>

            <div class="{{ $settings3['column_class'] }}">
              <div class="card stat-card h-100">
                <div class="card-body">
                  <div class="stat-meta">
                    <span class="stat-label">{{ $settings3['chart_title'] }}</span>
                    <span class="stat-icon">
                      <i class="{{ $settings3['icon'] ?? 'fas fa-briefcase' }}"></i>
                    </span>
                  </div>
                  <div class="stat-value">{{ number_format($settings3['total_number']) }}</div>
                </div>
              </div>
            </div>

            {{-- LATEST ENTRIES 1 --}}
            <div class="{{ $settings4['column_class'] }}">
              <div class="table-card">
                <h3>{{ $settings4['chart_title'] }}</h3>
                <div class="table-responsive">
                  <table class="table table-striped table-modern">
                    <thead>
                      <tr>
                        @foreach($settings4['fields'] as $key => $value)
                          <th>{{ trans(sprintf('cruds.%s.fields.%s', $settings4['translation_key'] ?? 'pleaseUpdateWidget', $key)) }}</th>
                        @endforeach
                      </tr>
                    </thead>
                    <tbody>
                      @forelse($settings4['data'] as $entry)
                        <tr>
                          @foreach($settings4['fields'] as $key => $value)
                            <td>
                              @if($value === '')
                                {{ $entry->{$key} }}
                              @elseif(is_iterable($entry->{$key}))
                                @foreach($entry->{$key} as $subEentry)
                                  <span class="badge badge-info">{{ $subEentry->{$value} }}</span>
                                @endforeach
                              @else
                                {{ data_get($entry, $key . '.' . $value) }}
                              @endif
                            </td>
                          @endforeach
                        </tr>
                      @empty
                        <tr>
                          <td colspan="{{ count($settings4['fields']) }}">{{ __('No entries found') }}</td>
                        </tr>
                      @endforelse
                    </tbody>
                  </table>
                </div>
              </div>
            </div>

            {{-- LATEST ENTRIES 2 --}}
            <div class="{{ $settings5['column_class'] }}">
              <div class="table-card">
                <h3>{{ $settings5['chart_title'] }}</h3>
                <div class="table-responsive">
                  <table class="table table-striped table-modern">
                    <thead>
                      <tr>
                        @foreach($settings5['fields'] as $key => $value)
                          <th>{{ trans(sprintf('cruds.%s.fields.%s', $settings5['translation_key'] ?? 'pleaseUpdateWidget', $key)) }}</th>
                        @endforeach
                      </tr>
                    </thead>
                    <tbody>
                      @forelse($settings5['data'] as $entry)
                        <tr>
                          @foreach($settings5['fields'] as $key => $value)
                            <td>
                              @if($value === '')
                                {{ $entry->{$key} }}
                              @elseif(is_iterable($entry->{$key}))
                                @foreach($entry->{$key} as $subEentry)
                                  <span class="badge badge-info">{{ $subEentry->{$value} }}</span>
                                @endforeach
                              @else
                                {{ data_get($entry, $key . '.' . $value) }}
                              @endif
                            </td>
                          @endforeach
                        </tr>
                      @empty
                        <tr>
                          <td colspan="{{ count($settings5['fields']) }}">{{ __('No entries found') }}</td>
                        </tr>
                      @endforelse
                    </tbody>
                  </table>
                </div>
              </div>
            </div>

            {{-- CHART --}}
            <div class="{{ $chart6->options['column_class'] }}">
              <div class="table-card">
                <h3 class="mb-3">{!! $chart6->options['chart_title'] !!}</h3>
                {!! $chart6->renderHtml() !!}
              </div>
            </div>

          </div> {{-- /.row --}}
        </div> {{-- /.card-body --}}

      </div>
    </div>
  </div>
</div>
@endsection

@section('scripts')
@parent
{{-- Chart.js v2 (keep v2 since your chart builder targets it) --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>

{{-- THEME Chart.js to Swipetrend palette --}}
<script>
if (window.Chart) {
  Chart.defaults.global.defaultFontFamily = "'Inter','Helvetica Neue','Helvetica','Arial',sans-serif";
  Chart.defaults.global.defaultFontColor = "#0b1220";
  Chart.defaults.global.tooltips.backgroundColor = "rgba(11,18,32,.9)";
  Chart.defaults.global.tooltips.titleFontStyle = "700";
  Chart.defaults.global.tooltips.cornerRadius = 8;
  var grid = "rgba(11,18,32,.08)";
  if (Chart.scaleService && Chart.scaleService.constructors) {
    Object.keys(Chart.scaleService.constructors).forEach(function(t){
      var p = Chart.scaleService.constructors[t] && Chart.scaleService.constructors[t].prototype;
      if (p && p.gridLines) p.gridLines.color = grid;
    });
  }
}
</script>

{!! $chart6->renderJs() !!}
@endsection
