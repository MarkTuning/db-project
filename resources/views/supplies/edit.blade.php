<x-page-content-wrapper activeMenu="storageItems" activePage="storageItems.edit" pageTitle="Edit a Supply">
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            <form method="POST" action="{{ route('storage.items.update') }}">
              @csrf

              @method('PATCH')

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

                  @error('storageItem_id')
                    <div style="display: flex; color: red;">{{ $message }}</div>
                  @enderror

                  <div style="display: flex; margin-top: 1.25rem;">
                    <h5 class="card-title">New Storage</h5>
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
                    <h5 class="card-title">New Item</h5>
                  </div>

                  <select name="item_id" class="card-button">
                    <option value="0" selected disabled>Choose an Item</option>
                    @foreach ($items as $item)
                      <option value="{{ $item->id }}">Name:{{ $item->name }} &emsp; Price:{{ $item->price }} lv.</option>
                    @endforeach
                  </select>

                  @error('item_id')
                    <div style="display: flex; color: red;">{{ $message }}</div>
                  @enderror

                  <div style="display: flex; margin-top: 1.25rem;">
                    <h5 class="card-title">New Quantity</h5>
                  </div>

                  <input name="quantity" type="text" placeholder="Quantity" value="{{ old('quantity') }}" class="card-text" pattern="[0-9]+" autocomplete="off">
                  <input type="submit" class="card-button" value="Add">
                  
                  @error('quantity')
                    <div style="display: flex; color: red;">{{ $message }}</div>
                  @enderror
                </div>
                </div>
              </div>
            </form>
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
  </x-page-content-wrapper>