<x-page-content-wrapper activeMenu="items" activePage="items.add" pageTitle="Add an Item">
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            <form method="POST" action="{{ route('items.store') }}">
              @csrf

              <div class="card">
                <div class="card-body">
                  <div style="display: flex;">
                    <h5 class="card-title">Name</h5>
                  </div>

                  <input name="name" type="text" placeholder="Name" value="{{ old('name') }}" class="card-text">

                  @error('name')
                    <div style="display: flex; color: red;">{{ $message }}</div>
                  @enderror

                  <div style="display: flex; margin-top: 1.25rem;">
                    <h5 class="card-title">Price</h5>
                  </div>

                  <input name="price" type="text" placeholder="Price(lv.)" value="{{ old('price') }}" class="card-text">
                  <input type="submit" class="card-button" value="Add">
                  
                  @error('price')
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