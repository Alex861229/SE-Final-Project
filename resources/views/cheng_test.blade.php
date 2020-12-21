<!-- loop array -->
@foreach($messages['data'] as $key => $v)
    @foreach ($v as $key => $value) 
        {{ $key . ' => ' . $value }} <br>
    @endforeach
@endforeach
