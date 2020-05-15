<ul class="nav nav-tabs">
	@foreach($scripts as $script)
		<li class="nav-item"> 
			<a class="nav-link @if($script->code == 1) active @endif" 
			   data-toggle="tab" 
			   href="#{{ $script->name }}-{{ $calllog->ctr }}">
				{{ $script->name }} 
			</a>
		</li>
	@endforeach
</ul>