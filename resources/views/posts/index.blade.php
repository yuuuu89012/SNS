@foreach($post as $p)
    <p>{{ $p->title }}</p>
    <p><img src="{{ asset('uploads/' . $p->image) }}" alt="Post Image"></p>
    <p>{{ $p->description }}</p>
@endforeach
