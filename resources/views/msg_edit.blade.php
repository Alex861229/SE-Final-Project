<form method="POST" action="{{ url('message/'.$message->id) }}">
{{ csrf_field() }}
{{ method_field('PATCH') }}
Title:<textarea name="title">{{ $message->title }}</textarea><br><br>
Content:<textarea name="content">{{ $message->content }}</textarea><br><br>
Rating:<textarea name="rating">{{ $message->rating }}</textarea><br><br>
<button type="submit">Update</button>
</form>