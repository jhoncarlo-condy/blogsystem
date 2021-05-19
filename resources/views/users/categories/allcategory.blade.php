<header>
    <h3 class="h6">Categories</h3>
  </header>
  @forelse ( $datas as $data )
  <div class="item d-flex justify-content-between">
  <a href="{{ route('view',$data->id) }}">{{ $data->title }}</a>
    <span>({{ $data->posts->where('category_id',$data->id)->count() }})</span>
  </div>
  @empty
  <div class="item d-flex justify-content-between"><a href="#">No Categories Available</div>
  @endforelse

