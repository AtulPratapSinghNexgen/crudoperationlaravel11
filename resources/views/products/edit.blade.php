<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Atul Pratap Singh | CRUD Laravel 11</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
    <div class="bg-dark py-3">
        <h3 class="text-white text-center">Atul Pratap Singh | CRUD Laravel 11</h3>
    </div>

    <div class="container">
        <div class="row justify-content-center mt-4">
            <div class="col-md-10 d-flex justify-content-end">
                <a href="{{ route('products.index')}}" class="btn btn-dark">Home</a>

            </div>
        </div>
        <div class="row d-flex justify-content-center">
            <div class="col-md-10">
                <div class="card border-0 shadow-lg my-4">
                    <div class="card-header bg-dark">
                        <h3 class="text-white">Edit Product</h3>
                    </div>

                    <form enctype="multipart/form-data" action="{{ route('products.update', $product->p_id)}}" method="POST">
                        @method('PUT')
                    @csrf
                        <div class="card-body">
                        <div class="mb-3">
                            <label for="" class="form-label h5">Product Name</label>
                            <input type="text" value="{{ old('name', $product->name)}}" class="@error('name') is-invalid @enderror form-control form-control-lg" placeholder="Enter the Product Name" name="name">
                            @error('name')
                                <p class="invalid-feedback">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label h5">Product Sku</label>
                            <input type="text" value="{{ old('sku', $product->sku)}}" class="@error('sku') is-invalid @enderror form-control form-control-lg" placeholder="Enter the Product SKU" name="sku">
                            @error('sku')
                                <p class="invalid-feedback">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label h5">Product Price</label>
                            <input type="text" value="{{ old('price', $product->price)}}" class="@error('price') is-invalid @enderror form-control form-control-lg" placeholder="Enter the Product Price" name="price">
                            @error('price')
                                <p class="invalid-feedback">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label h5">Product Description</label>
                            <textarea class="@error('description') is-invalid @enderror form-control form-control-lg" placeholder="Enter the Product Description" name="description" cols="30" rows="5">{{ old('description',$product->description)}}</textarea>
                            @error('description')
                                <p class="invalid-feedback">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label h5">Product Image</label>
                            <input type="file" class="@error('image') is-invalid @enderror form-control form-control-lg" name="image">
                            @if ($product->image != "")
                            <img class="w-50 my-3" src="{{ asset('uploads/'. $product->image)}}" alt="">
                        @endif
                        </div>

                        <div class="d-grid">
                            <button class="btn btn-lg btn-primary">Update Product</button>
                        </div>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
  </body>
</html>