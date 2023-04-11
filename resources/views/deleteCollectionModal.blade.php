<div class="modal" id="deleteCollectionModal" tabindex="-1" aria-labelledby="editCollectionModalLabel" aria-hidden="true" data-bs-backdrop="static">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Collection</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="/collections/{{ $collectionId }}" method="post">
          @method('delete')
          @csrf
          <div class="modal-body">
            <p>Are you sure you want to delete this collection?</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-danger">Delete</button>
          </div>
        </form>
    </div>
  </div>
</div>