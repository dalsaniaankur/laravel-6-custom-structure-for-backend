@if(!empty($loginUser))
<div class="col-lg-6 pt-3">
    <h2 class="pr-box-heading">Hi, {{ $loginUser->name }}</h2>
    <div id="profile-box">
        <div class="row">
            <div class="col-sm-6">
                @if(!empty($loginUser->last_login_date) && $loginUser->last_login_date != '0000-00-00 00:00:00')
                    <p id="last-login">Last login
                        <span>
                            {{ DateFacades::dateFormat($loginUser->last_login_date,'format-3') }}
                            <br/>
                            {{ DateFacades::dateFormat($loginUser->last_login_date,'time-format-1') }}
                        </span>
                    </p>
                @endif
                <div id="box-profile-opt" class="mt-5">
                    <h3>Your profile</h3>
                    @if ( !empty($loginUser->photo) && Common::isFileExists($loginUser->photo) )
                        <img src="{{ url($loginUser->photo) }}" alt="">
                    @else
                        <img src="{{ url('backend/images/profile-default.png') }}" alt="">
                    @endif
                    <p class="u_width">
                        <span>{{ $loginUser->name }}</span>
                        <br>
                        {{ $loginUser->email }}
                    </p>
                    <a href="{{ url($loadingPageType.'/profile') }}" class="btn viewbtn editbtn">Edit</a>
                </div>
            </div>
            <div class="col-sm-6">
                <div id="box-date">
                    <img src="{{ url('backend/images/date-big.png') }}">
                    <p id="time">{{ DateFacades::getCurrentDateTime('format-2') }}</p>
                    <p id="day" class="mt-3">{{ DateFacades::getCurrentDateTime('format-4') }}
                        <span>{{ DateFacades::getCurrentDateTime('format-3') }}</span></p>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
