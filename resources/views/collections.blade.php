@extends('layouts.app')

@section('title', 'Collections')

@section('content')

<div class="container my-4">
  <a href="home">Home</a> > <a href="/collections"> Collections </a>
</div>

<br>

</div>
<div class="container">
  <div class="row">
    <h1 class="col-8">My Collections</h1>
    <div class="col-4 justify-content-end d-flex">
      <button 
      type="button" 
      class="btn btn-primary"
      data-bs-toggle="modal" 
      data-bs-target="#createCollectionForm"
      >Create collection</button>
    </div>
  </div>


  @if($errors->any())
  <br>
  <div class="alert alert-danger" role="alert">
    @foreach ($errors->all() as $error)
      <span style="color: red;">{{ $error }}</span>
    @endforeach
  </div>
  @endif

  <br>
 
  <div class="row gy-5 ">
  @forelse($collections as $collection)
    <div class="col-3">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">{{$collection['name']}}</h5>
          
          <br><br>
          <a href="collections/{{$collection['id']}}" class="btn cartoonish-btn center">See Collection</a>
        </div>
      </div>
    </div>
  @empty
  <br><br><br><br><br><br><br><br><br>
  <h2 class="text-center text-secondary">You do not have any collection yet!</h2>
  <br><br><br><br><br>
  @endforelse
  </div>

</div>

<!-- Create Collection Modal -->
<div class="modal" id="createCollectionForm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Create New Collection</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="/collections" method="post">
          @csrf
          <label for="name" class="form-label">Collection name</label>
          <input type="text" class="form-control" name="name" id="name" placeholder="Please type the collection name">

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

<br><br><br>

@endsection

