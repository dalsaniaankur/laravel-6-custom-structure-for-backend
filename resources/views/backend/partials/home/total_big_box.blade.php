@if(!empty($bigBox))
    @foreach($bigBox as $bigBoxKey => $data)
        <div class="col-md-6">
            <div class="dash-col {{ $data['className'] }}">
                <h2>
                    <img src="{{ $data['iconUrl'] }}" alt=""><span class="text">{{ ucfirst($data['name']) }}</span>
                </h2>
                <div class="dash-stats customerborder">
                    <p>Total {{ strtolower($data['name']) }}</p>
                    <h3>{{ $data['total'] }}</h3>
                    <a href="{{ $data['link'] }}" class="btn viewbtn">open</a>
                </div>
            </div>
        </div>
    @endforeach
@endif
