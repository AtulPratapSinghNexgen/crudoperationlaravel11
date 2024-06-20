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
                <a href="{{ route('products.create')}}" class="btn btn-dark">Create Product</a>

            </div>
        </div>
        <div class="row d-flex justify-content-center">
            @if (Session::has('success'))

            <div class="col-md-10 mt-4">
                <div class="alert alert-success">
                    {{ Session::get('success') }}
                </div>
            </div>
                
            @endif
            <div class="col-md-10">
                <div class="card border-0 shadow-lg my-4">
                    <div class="card-header bg-dark">
                        <h3 class="text-white">Products List</h3>
                    </div>

                    <table class="table table-hover">
                        <thead>
                          <tr>
                            <th scope="col">Product ID</th>
                            <th scope="col">Product Image</th>
                            <th scope="col">Product Name</th>
                            <th scope="col">Product SKU</th>
                            <th scope="col">Description</th>
                            <th scope="col">Price</th>
                            <th scope="col">Created At</th>
                            <th scope="col">Opertions</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $item)
                            <tr>
                                <th scope="row">{{ $item->p_id }}</th>
                                <td>
                                    @if ($item->image != "")
                                        <img width="50" src="{{ asset('uploads/'. $item->image)}}" alt="">
                                    @endif
                                </td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->sku}}</td>
                                <td>{{ $item->description }}</td>
                                <td>{{ $item->price }}</td>
                                <td>{{ $item->created_at->format('d M, Y') }}</td>
                                <td>
                                    <a href="{{ route('products.edit', $item->p_id)}}" class="btn btn-info">Edit</a>
                                    <a href="#" onclick="deleteProduct({{ $item->p_id }});" class="btn btn-danger">Delete</a>

                                    <form id="delete-product-from-{{$item->p_id}}" action="{{ route('products.delete', $item->p_id)}}" method="POST">
                                        @csrf
                                        @method('delete')
                                    </form>
                                </td>
                              </tr> 
                            @endforeach
                          
                         
                        </tbody>
                      </table>
                   
                </div>
            </div>
        </div>
    </div>
  </body>
</html>
<script>
    function deleteProduct(id)
    {
        if(confirm("Are you sure you want to delete product?"))
        {
            document.getElementById("delete-product-from-"+id).submit();
        }
    }
</script>