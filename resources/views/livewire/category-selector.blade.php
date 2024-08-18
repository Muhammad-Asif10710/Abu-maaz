<div>
    <div class="mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-3">
                <div class="btn-group d-flex" role="group" aria-label="Basic outlined example" style="width: 100%">
                    @foreach($categories as $category)
                    <button type="button" class="btn btn-outline-primary @if($selectedCategoryId == $category->id) active bg-black @endif" wire:click="selectCategory('{{ $category->id }}')">
                        Get {{ $category->name }} Clothes
                    </button>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
            @foreach($products as $product)
            <div class="col">
                <div class="card h-100">
                    <img src="{{ url('images/' . $product->image_url) }}" class="card-img-top" alt="..." style="width: 100%; height: 250px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text">{{ $product->description }}</p>
                        <div class="d-flex justify-content-between">
                            <p class="card-text"><strong>Price:</strong> Rs:{{ $product->actual_price }}</p>
                            <p class="card-text"><strong>Category:</strong> {{ $product->category->name }}</p>
                        </div>
                        <div class="d-flex flex-wrap justify-content-between align-items-center">
                            @if($product->category->name == 'Stitched')
                            <div class="form-group mb-3">
                                <label for="size_{{ $product->id }}" class="size-label" style="color: black; font-weight: bold;">Size:</label>
                                <select wire:model="selectedSize" name="size_{{ $product->id }}" id="size_{{ $product->id }}" class="form-control">
                                    <option value="xs">XS</option>
                                    <option value="s">S</option>
                                    <option value="m">M</option>
                                    <option value="l">L</option>
                                    <option value="xl">XL</option>
                                </select>
                            </div>
                            @endif
                            <div class="form-group mb-3">
                                <label for="quantity_{{ $product->id }}" class="size-label" style="color: black; font-weight: bold;">Quantity:</label>
                                <input type="number" wire:model="quantities.{{ $product->id }}" class="form-control" id="quantity_{{ $product->id }}" style="width: 50px;">
                            </div>
                        </div>
                        <button wire:click="addToCart('{{ $product->id }}')" type="button" class="btn btn-dark" onclick="changeColor(this)">
                            Add to Cart
                        </button>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

<script>
    function changeColor(element) {
        element.classList.add('bg-success');
        element.innerText = 'Added';
        setTimeout(() => {
            element.classList.remove('bg-success');
            element.innerText = 'Add to Cart';
        }, 1000);
    }
</script>
