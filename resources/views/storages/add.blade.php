<x-page-content-wrapper activeMenu="storages" activePage="storages.add" pageTitle="Add a Storage">
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            <form method="POST" action="{{ route('storages.store') }}">
              @csrf

              <div class="card">
                <div class="card-body">
                  <div style="display: flex;">
                    <h5 class="card-title">Name</h5>
                  </div>

                  <input name="name" type="text" placeholder="Name" value="{{ old('name') }}" class="card-text">
                  <input type="submit" class="card-button" value="Add">
                  
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