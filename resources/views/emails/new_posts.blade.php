<h1>New Posts!</h1>
<p>You have new posts for {{ $data['website']['name'] }}</p>
<a href="{{ $data['website']['url'] }}">{{ $data['website']['url'] }} </a>

<h3>Posts:</h3>

<ul>
  @foreach ($data['posts'] as $post)
  <li>{{ $post->name }}</li>
  @endforeach
</ul>