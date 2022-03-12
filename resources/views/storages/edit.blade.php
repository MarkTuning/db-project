<x-page-content-wrapper activeMenu="storages" activePage="storages.edit" pageTitle="Edit a Storage">
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            <form method="POST" action="{{ route('storages.update') }}">
              @csrf

              @method('PATCH')

              <div class="card">
                <div class="card-body">
                  <div style="display: flex;">
                    <h5 class="card-title">Storage</h5>
                  </div>
                  
                  <select name="storage_id" class="card-button">
                    <option value="0" selected disabled>Choose a Storage</option>
                    @foreach ($storages as $storage)
                      <option value="{{ $storage->id }}">Name:{{ $storage->name }}</option>
                    @endforeach
                  </select>

                  @error('storage_id')
                    <div style="display: flex; color: red;">{{ $message }}</div>
                  @enderror

                  <div style="display: flex; margin-top: 1.25rem;">
                    <h5 class="card-title">New Name</h5>
                  </div>

                  <input name="name" type="text" placeholder="New Name" value="{{ old('name') }}" class="card-text">
                  <input type="submit" class="card-button" value="Update">
                  
                  @error('name')
                    <div style="display: flex; color: red;">{{ $message }}</div>
                  @enderror
                </div>
              </div>
            </form>
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
  </x-page-content-wrapper>