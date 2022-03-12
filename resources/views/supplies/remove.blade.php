<x-page-content-wrapper activeMenu="storageItems" activePage="storageItems.remove" pageTitle="Remove a Supply">
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            <form method="POST" action="{{ route('storage.items.destroy') }}">
              @csrf

              @method('DELETE')

              <div class="card">
                <div class="card-body">
                  <div style="display: flex;">
                    <h5 class="card-title">Supply</h5>
                  </div>
                  
                  <select name="storageItem_id" class="card-button">
                    <option value="0" selected disabled>Choose a Supply</option>
                    @foreach ($storageItems as $storageItem)
                      <option value="{{ $storageItem->id }}">
                        Storage:{{ $storageItem->storage->name }}
                        &emsp; Item:{{ $storageItem->item->name }}
                        &emsp; Price:{{ $storageItem->item->price }} lv.
                        &emsp; Quantity:{{ $storageItem->quantity }}
                      </option>
                    @endforeach
                  </select>

                  <input type="submit" class="card-button" value="Remove">
                  
                  @error('storageItem_id')
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