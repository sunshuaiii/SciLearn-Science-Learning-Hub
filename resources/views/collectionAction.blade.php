@if($errors->any())
<br>
<div class="alert alert-danger" role="alert">
  @foreach ($errors->all() as $error)
  <span style="color: red;">{{ $error }}</span>
  @endforeach
</div>
@endif
<div class="row">
  <div class="col-1">
    <div class="dropdown">
      <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
        Actions
      </button>
      <ul class="dropdown-menu">
        <li><a class="dropdown-item" href="/collections/{{ $collectionId }}/opics">Add or Delete Topics</a></li>
        <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#editCollectionModal">Edit Collection Name</a></li>
      </ul>
    </div>
  </div>

  <div class="col-2">
    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteCollectionModal">
      Delete Collection
    </button>
  </div>
</div>