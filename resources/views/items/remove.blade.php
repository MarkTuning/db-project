<x-page-content-wrapper activeMenu="items" activePage="items.remove" pageTitle="Remove an Item">
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            <form method="POST" action="{{ route('items.destroy') }}">
              @csrf

              @method('DELETE')

              <div class="card">
                <div class="card-body">
                  <div style="display: flex;">
                    <h5 class="card-title">Item</h5>
                  </div>
                  
                  <select name="item_id" class="card-button">
                    <option value="0" selected disabled>Choose an Item</option>
                    @foreach ($items as $item)
                      <option value="{{ $item->id }}">Name:{{ $item->name }} &emsp; Price:{{ $item->price }} lv.</option>
                    @endforeach
                  </select>

                  <input type="submit" class="card-button" value="Remove">
                  
                  @error('item_id')
                    <div style="display: flex; color: red;">{{ $message }}</div>
                  @enderror

                  <div class="card-text" style="font-size: 0.75rem;">Disclaimer: By deleting an item you are deleting all of the supplies that have that same item as well.</div>
                </div>
              </div>
            </form>
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
  </x-page-content-wrapper>