<header>
    <h3 class="h6">Categories</h3>
  </header>
  @forelse ( $datas as $data )
  <div class="item d-flex justify-content-between">
  <a href="{{ route('category.show',$data->id) }}">{{ $data->title }}</a>
    <span>({{ count($data->post->where('category_id',$data->id)) }})</span>
  </div>
  @empty
  <div class="item d-flex justify-content-between"><a href="#">No Categories Available</div>
  @endforelse

