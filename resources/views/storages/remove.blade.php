<x-page-content-wrapper activeMenu="storages" activePage="storages.remove" pageTitle="Remove a Storage">
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            <form method="POST" action="{{ route('storages.destroy') }}">
              @csrf

              @method('DELETE')

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

                  <input type="submit" class="card-button" value="Remove">
                  
                  @error('storage_id')
                    <div style="display: flex; color: red;">{{ $message }}</div>
                  @enderror

                  <div class="card-text" style="font-size: 0.75rem;">Disclaimer: By deleting a storage you are deleting all of the supplies that are in that same storage as well.</div>
                </div>
              </div>
            </form>
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
  </x-page-content-wrapper>