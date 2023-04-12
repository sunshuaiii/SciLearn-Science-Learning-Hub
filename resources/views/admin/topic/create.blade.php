<div class="mb-3">
        <label for="name" class="form-label">Image</label>
        <input type="file" class="form-control" id="image" placeholder="Image" name="image">
        @if ($errors->has('image'))
            <span class="text-danger">{{ $errors->first('image') }}</span>
        @endif
    </div>