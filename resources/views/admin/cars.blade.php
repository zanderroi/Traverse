@include('components.header')
@section('content')
    <h1 class="pt-4 pb-2">All Cars</h1>
    <table class="table">
        <thead>
            <tr>
                <th scope="col" class="py-3 px-6">ID</th>
                <th scope="col" class="py-3 px-6">Brand</th>
                <th scope="col" class="py-3 px-6">Model</th>
                <th scope="col" class="py-3 px-6">Year</th>
                <th scope="col" class="py-3 px-6">Price</th>
                <th scope="col" class="py-3 px-6">Owner</th>
                <th scope="col" class="py-3 px-6">Rented Count</th>
                <th scope="col" class="py-3 px-6">Status</th>
                <th scope="col" class="py-3 px-6"></th>
                <th scope="col" class="py-3 px-6"></th>


            </tr>
        </thead>
        <tbody>
            @foreach ($cars as $index => $car)
                <tr>
                    <td>{{ $car->id }}</td>
                    <td>{{ $car->car_brand }}</td>
                    <td>{{ $car->car_model }}</td>
                    <td>{{ $car->year }}</td>
                    <td>{{ $car->rental_fee }}</td>
                    <td>{{ $carOwnersWithCars[$index]->first_name }}{{ $carOwnersWithCars[$index]->last_name }}</td>
                    <td></td>
                    <td>{{ $car->status }}</td>  
                    <td class="py-2 px-6">
                        <a href="/car/{{$car->id}}" class="bg-gray-700 hover:bg-gray-800 text-white px-4 py-1 rounded">
                            Edit
                        </a></td>
                    <td><form action="/car/{{$car->id}}" method="POST">
                        @method('delete')
                        @csrf
                        <button type="submit" class="bg-red-700 hover:bg-red-800 text-white py-1 px-4 rounded shadow-lg hover:shadow-xl transition duration-duration-200" type="submit">Delete</button>
                        </form></td>
                </tr>
               
            @endforeach
        </tbody>
    </table>
@include('components.footer')