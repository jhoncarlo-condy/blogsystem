@forelse ($categories as $key=>$category)
<tr>
    <td scope="row">{{ $key+1}}</td>
    <td>{{ $category->title }}</td>
    <td>{{ $category->description }}</td>
    <td>{{ $category->blogmax }}</td>
</tr>
@empty
<tr>
    <td> Empty Category </td>
</tr>
@endforelse
