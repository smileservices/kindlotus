@foreach($cause->tags as $tag)<a class="tag" href="{{ url('search/tag/'.$tag->id.'/'.str_slug($tag->tag, '-')) }}"><span class="causes_tag">{{ $tag->tag }}</span></a>@endforeach