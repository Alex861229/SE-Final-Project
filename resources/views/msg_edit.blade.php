@if ($country == 'tw')
    <form method="POST" action="{{ url('message/tw/'.$msg_id) }}">
    {{ csrf_field() }}
    {{ method_field('PATCH') }}
    Country:{{ $country }}<br><br>
    Site:{{ $site->name }}<br><br>
    Content:<textarea name="content">{{ $TwMessage->content }}</textarea><br><br>
    Rating:<textarea name="rating">{{ $TwMessage->rating }}</textarea><br><br>
    <button type="submit">Update</button>
    </form>
@endif
@if ($country == 'kr')
    <form method="POST" action="{{ url('message/kr/'.$msg_id) }}">
    {{ csrf_field() }}
    {{ method_field('PATCH') }}
    Country:{{ $country }}<br><br>
    Site:{{ $site->name }}<br><br>
    Content:<textarea name="content">{{ $KrMessage->content }}</textarea><br><br>
    Rating:<textarea name="rating">{{ $KrMessage->rating }}</textarea><br><br>
    <button type="submit">Update</button>
    </form>
@endif