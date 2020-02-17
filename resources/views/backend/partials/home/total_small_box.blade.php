@if(!empty($smallBox))
    @foreach($smallBox as $smallBoxKey => $data)
        <div class="col-lg-3 col-md-6 col-sm-6">
            <a href="{{ $data['link'] }}" class="totals-box {{ $data['colorClassName'] }}">
                <span>TOTAL {{ strtoupper($data['name']) }}</span>
                <p>{{ $data['total'] }}<small>{{ ucfirst($data['name']) }}</small></p>
            </a>
        </div>
    @endforeach
@endif
