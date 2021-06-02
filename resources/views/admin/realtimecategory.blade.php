@php
    $auth = Auth::user();
@endphp
@forelse ($categories as $key=>$category)
<tr>
    <td scope="row">{{ $key+1}}</td>
    <td>{{ $category->title }}</td>
    <td>{{ $category->description }}</td>
    <td>{{ $category->blogmax }}</td>
    @if($auth->usertype != '1')

    @else
    <td>
        <!-- Button trigger edit modal -->
        <div class="form-row">
            <a name="" style="color:green;" id="" href="#" role="button"
             data-toggle="modal" data-target="#editModal{{ $category->id }}">
                <i class="fas fa-edit"></i>
            </a>
    </td>
    <td>
        {{-- delete category --}}
            <!-- Button trigger modal -->

            <a name="" style="color:red;" id="" href="#" role="button"
             data-toggle="modal" data-target="#deleteModal{{ $category->id }}">
                <i class="fas fa-trash"></i>
            </a>
            <!-- Modal -->
            <div class="modal fade" data-backdrop="static" id="deleteModal{{ $category->id }}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title"><i class="fas fa-exclamation-triangle" style="color:yellow;"></i>Are you sure you want to delete?<i class="fas fa-exclamation-triangle" style="color:yellow;"></i></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                        </div>
                        <div class="modal-body">
                            <span>Note: Make sure that there are no posts with the category you selected.</span>
                            <form id="deleteform"
                            action="{{ route('categories.destroy',$category->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <div class="container text-right">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-danger">Delete</button>
                                </div>
                                </form>
                        </div>

                    </div>
                </div>
            </div>
            @endif
        </div>
    </td>
    {{-- EDIT MODAL --}}
        <!-- Modal -->
        <div class="modal fade" id="editModal{{ $category->id }}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Category: {{ $category->title }}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>
                    <div class="modal-body">
                        <form  action="{{ route('categories.update', $category->id)  }}" class="editcategory" method="post">
                            @method('PUT')
                            @csrf
                            <div class="form-group">
                              <label for="title"></label>
                              <input type="text" class="form-control" name="title"  aria-describedby="helpId" placeholder="" value="{{ $category->title }}">
                            </div>
                            <div class="form-group">
                              <label for="description"></label>
                              <textarea class="form-control" name="description" col="60" rows="5" maxlength="100">{{ $category->description }}</textarea>
                            </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
</tr>
@empty
<tr>
    <td> Empty Category </td>
 </tr>


@endforelse
