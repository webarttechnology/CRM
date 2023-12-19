
<ul>
        @foreach($work as $val)
            @if ($val->final_status == 'start')
              @php
                $task = App\Models\Developertask::where('id', $val->developer_job_id)->first();
              @endphp
            @if ($task)
            <li><a href="#">{{ $task->sale->project_name }}</a></li>
            @endif  
            @endif
        @endforeach
</ul>                               