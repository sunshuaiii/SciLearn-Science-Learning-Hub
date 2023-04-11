<div class="modal" id="editCollectionModal" tabindex="-1" aria-labelledby="editCollectionModalLabel" aria-hidden="true" data-bs-backdrop="static">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Collection</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="/collections/{{ $collectionId }}" method="post">
          @method('put')
          @csrf
          <label for="name" class="form-label">Collection name</label>
          <input type="text" class="form-control" name="name" id="name" placeholder="Please type the collection name" value="{{$collectionName}}">

          <input hidden type="text" class="form-control" name="id" id="id" value="{{ $collectionId }}">

          <br>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
        </form>
    </div>
  </div>
</div>