<div class="cloud">
	<h2>标签云</h2>
	<ul>
		@foreach ($tags as $tag)
	        <a href="/home/tag/article_list?tag_id={{ $tag->id }}">{{ $tag->tag_name }}</a>
	    @endforeach
	</ul>
</div>