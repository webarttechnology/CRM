@if (count($notify) > 0)
<ul class="notification-list">
    @foreach ($notify as $notification)
        @php
            // Calculate the time difference
            $timeDifference = $notification->created_at->diffForHumans();
        @endphp
        <li class="notification-message">
            <a href="{{ url($notification->url) }}">
                <div class="media d-flex">
                    <span class="avatar flex-shrink-0">
                        @if ($notification->user->user_image)
                            <img alt="" src="{{ url($notification->user->user_image) }}">
                        @else
                            <img alt="" src="{{ url('panel/assets/img/profiles/user-profile.png') }}">
                        @endif
                    </span>
                    <div class="media-body flex-grow-1">
                        <p class="noti-details"><span
                                class="noti-title">{{ optional($notification->user)->name ?? '' }}</span>
                            {{ $notification->message }}</p>
                        <p class="noti-time"><span class="notification-time">{{ $timeDifference }}</span>
                        </p>
                    </div>
                </div>
            </a>
        </li>
    @endforeach
</ul>
@else
   <span class="text-danger text-center d-block mt-5">No record found</span>
@endif

