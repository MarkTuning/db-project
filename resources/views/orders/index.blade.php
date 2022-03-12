<x-page-content-wrapper activePage="order" pageTitle="Create an Order">
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            <form method="POST" action="{{ route('order.place') }}">
              @csrf

              <div class="card">
                <div class="card-body">
                  <div style="display: flex;">
                    <h5 class="card-title">Supply</h5>
                  </div>
                  
                  <select name="storageItem_id" id="storageItem_id" class="card-button">
                    <option value="0" price="0" selected disabled>Choose a Supply</option>
                    @foreach ($storageItems as $storageItem)
                      <option value="{{ $storageItem->id }}" price="{{ $storageItem->item->price }}">
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
                    <h5 class="card-title">Quantity of Order</h5>
                  </div>

                  <input name="quantity" id="quantity" type="text" placeholder="Quantity" value="{{ old('quantity') }}" class="card-text" pattern="[0-9]+" autocomplete="off">

                  @error('quantity')
                    <div style="display: flex; color: red;">{{ $message }}</div>
                  @enderror

                  <div style="display: flex; margin-top: 1.25rem;">
                    <h5 class="card-title">Order Details</h5>
                  </div>

                  <span class="card-text">Total Price: </span>
                  <span class="card-text" id="totalPrice">0.00 lv.</span>

                  <input type="submit" class="card-button" value="Place Order">
                </div>
                </div>
              </div>
            </form>
            <script src="{{ asset('/js/priceCalculator.js') }}"></script>
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
  </x-page-content-wrapper>