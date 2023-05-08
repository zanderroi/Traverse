@include('components.header')
<h2 class="text-center p-4"> WELCOME ADMIN </h2>
<div class="row">
    <div class="col-md-4">
        <div class="card bg-black text-white">
            <div class="card-body">
                <h5 class="card-title text-center">Total cars</h5>
                <p class="card-text text-center">{{ $carsCount }}</p>
                <hr>
                <table class="table table-borderless text-white">
                    <tr>
                        <td>Booked</td>
                        <td> 0 </td>
                    </tr>
                    <tr>
                        <td>Available</td>
                        <td> 5 </td>
                    </tr>
                </table>
                <hr>
                <div class="d-flex justify-content-center">
                    <a href="/cars/details" class="btn btn-outline-light">
                        View more details
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card bg-secondary text-white">
            <div class="card-body">
                <h5 class="card-title text-center">Total car owners</h5>
                <p class="card-text text-center">{{ $carOwners }}</p>
                <hr>
                <table class="table table-borderless text-white">
                    <tr>
                        <td>On Transanctions</td>
                        <td> 0 </td>
                    </tr>
                    <tr>
                        <td>Vacant</td>
                        <td> 5 </td>
                    </tr>
                </table>
                <hr>
                <div class="d-flex justify-content-center">
                    <a href="#" class="btn btn-outline-light">
                        View more details
                    </a>
                </div>
                

            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card bg-success text-white">
            <div class="card-body">
                <h5 class="card-title text-center">Total customers</h5>
                <p class="card-text text-center">{{ $customers }}</p>
                <hr>
                <table class="table table-borderless text-white">
                    <tr>
                        <td>On Transactions</td>
                        <td> 0 </td>
                    </tr>
                    <tr>
                        <td>Vacant</td>
                        <td> 3 </td>
                    </tr>
                </table>
                <hr>
                <div class="d-flex justify-content-center">
                    <a href="#" class="btn btn-outline-light">
                        View more details
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@include('components.footer')



