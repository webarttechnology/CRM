<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<!-- resources/views/timers/index.blade.php -->
@foreach($timers as $timer)
    <p>
        Timer: {{ $timer->name }} -
        @if ($timer->is_running)
            Duration: <span id="countdown_{{ $timer->id }}">{{ formatDuration($timer->duration) }}</span> -
            Status: Running -
            <form action="{{ route('timers.pause', $timer->id) }}" method="post" style="display:inline;">
                @method('patch')
                @csrf
                <button type="submit">Pause</button>
            </form>
            <form action="{{ route('timers.resume', $timer->id) }}" method="post" style="display:inline;">
                @method('patch')
                @csrf
                <button type="submit">Resume</button>
            </form>
            <script>
                // JavaScript Countdown
                var countdown_{{ $timer->id }} = {{ $timer->duration }};
                var countdownInterval_{{ $timer->id }} = setInterval(function() {
                    var countdownElement = document.getElementById('countdown_{{ $timer->id }}');
                    var hours = Math.floor(countdown_{{ $timer->id }} / 3600);
                    var minutes = Math.floor((countdown_{{ $timer->id }} % 3600) / 60);
                    var seconds = countdown_{{ $timer->id }} % 60;
                    
                    countdownElement.textContent = `${formatTime(hours)}:${formatTime(minutes)}:${formatTime(seconds)}`;
                    
                    if (countdown_{{ $timer->id }} > 0) {
                        countdown_{{ $timer->id }}--;
                    }
                }, 1000);

                function formatTime(time) {
                    return time < 10 ? `0${time}` : time;
                }
            </script>
        @else
            Status: Paused
            <form action="{{ route('timers.start', $timer->id) }}" method="post" style="display:inline;">
                @method('patch')
                @csrf
                <button type="submit">Start</button>
            </form>
        @endif
    </p>
@endforeach
@php
    function formatDuration($seconds) {
        $hours = floor($seconds / 3600);
        $minutes = floor(($seconds % 3600) / 60);
        $seconds = $seconds % 60;

        return sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);
    }
@endphp
</body>
</html>