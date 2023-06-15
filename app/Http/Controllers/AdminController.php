<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf as PDF;
use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\User;
use App\Models\Commission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Rules\UnderEighteen;
use App\Models\Booking;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    public function dashboard(Request $request)
    {
        // Get the selected month and week from the request
    $selectedMonth = $request->input('month');
    $selectedWeek = $request->input('week');
    $year = date('Y');

    // Get the start and end dates for the selected month and week
    $weeks = [];
    $startMonth = $selectedMonth ?? 1;
    $endMonth = $selectedMonth ?? 12;

    for ($month = $startMonth; $month <= $endMonth; $month++) {
        $startWeek = ($month == $selectedMonth) ? 1 : 0;
        $endWeek = ($month == $selectedMonth) ? 5 : 4;

        for ($weekNumber = $startWeek; $weekNumber <= $endWeek; $weekNumber++) {
            $startDate = Carbon::parse("{$year}-{$month}-01")->startOfWeek(Carbon::SUNDAY);
            $weekStart = $startDate->copy()->addWeeks($weekNumber - 1);
            $weekEnd = $weekStart->copy()->endOfWeek(Carbon::SATURDAY);
            $weekLabel = $weekStart->format('F j') . ' - ' . $weekEnd->format('F j');
            $weeks[] = [
                'month' => $month,
                'week' => $weekNumber,
                'label' => $weekLabel
            ];
        }
    }

    // Fetch user registration data for each day of the week
    $weekData = [];

    if ($selectedWeek) {
        $startDate = Carbon::parse("{$year}-{$selectedMonth}-01")->startOfWeek(Carbon::SUNDAY);
        $weekStart = $startDate->copy()->addWeeks($selectedWeek - 1);
        $weekEnd = $weekStart->copy()->endOfWeek(Carbon::SATURDAY);

        for ($date = $weekStart; $date <= $weekEnd; $date->addDay()) {
            $day = $date->format('Y-m-d');
            $nextDay = $date->copy()->addDay(); // Get the next day
            $carOwnerCount = User::where('user_type', 'car_owner')
            ->whereBetween('created_at', [$day, $nextDay])
            ->count();
    
        $customerCount = User::where('user_type', 'customer')
            ->whereBetween('created_at', [$day, $nextDay])
            ->count();
    
        $bookingCount = Booking::whereBetween('created_at', [$day, $nextDay])
            ->count();
    
        $carCount = Car::whereBetween('created_at', [$day, $nextDay])
            ->count();
    
        $weekData[$day] = [
            'carOwnerCount' => $carOwnerCount,
            'customerCount' => $customerCount,
            'bookingCount' => $bookingCount,
            'carCount' => $carCount
        ];
        }
    }

    // Pass the selected month and week to the view
    $selectedMonth = $selectedMonth ?? Carbon::now()->format('m');
    $selectedWeek = $selectedWeek ?? Carbon::now()->weekOfMonth;

        $carsCount = DB::table('cars')->whereNull('deleted_at')->count();
    
        // Update bookedCarsCount based on the status of the cars
        $bookedCarsCount = DB::table('bookings')->count();
        $carOwners = User::where('user_type', 'car_owner')->count();
        $customers = User::where('user_type', 'customer')->count();
        $totalBookings = DB::table('bookings')->count();

        return view('admin.dashboard', compact(
            'carsCount',
            'carOwners',
            'customers',
            'totalBookings',
            'weekData', 'selectedMonth', 'selectedWeek', 'weeks' 
        ));
    }
  


    public function carshow(Request $request)
    {
            // Get the filter option from the request
        $filter = $request->input('filter');

        // Query the cars based on the filter option
        $query = Car::with('owner', 'bookings.customer');
        

        if ($filter === 'rented') {
            $query->whereDoesntHave('bookings', function ($subquery) {
                $subquery->where('return_date_time', '>', now())
                         ->orWhereNotNull('returned_at');
            });
        } elseif ($filter === 'not_returned') {
            $query->whereHas('bookings', function ($subquery) {
                $subquery->where('return_date_time', '>', now())
                         ->whereNull('returned_at');
            });
        }
        $cars = $query->paginate(10);
        // Paginate the results if the filter is set to "all"
        //  $cars = ($filter === 'all') ? $query->paginate(10) : $query->get();
        // $cars = Car::with('owner', 'bookings.customer')->paginate(5);
        $carOwnersWithCars = DB::table('users')
        ->join('cars', 'users.id', '=', 'cars.car_owner_id')
        ->select('users.first_name', 'users.last_name')
        ->get();
        return view('admin.cars', compact('cars', 'carOwnersWithCars'));
  
    }
    public function ownershow(Request $request)
    {
        $search = $request->input('search');
        $filter = $request->input('filter'); // Add this line to get the filter value
        
        $query = User::where('user_type', 'car_owner');
        
        // Apply search query
        if ($search) {
            $query->where(function ($subquery) use ($search) {
                $subquery->where('first_name', 'LIKE', '%' . $search . '%')
                    ->orWhere('last_name', 'LIKE', '%' . $search . '%')
                    ->orWhere('email', 'LIKE', '%' . $search . '%')
                    ->orWhere('address', 'LIKE', '%' . $search . '%')
                    ->orWhere('phone_number', 'LIKE', '%' . $search . '%')
                    ->orWhere('contactperson1', 'LIKE', '%' . $search . '%')
                    ->orWhere('contactperson2', 'LIKE', '%' . $search . '%');
                })->orWhereHas('cars', function ($carQuery) use ($search) {
                    $carQuery->where('car_brand', 'LIKE', '%' . $search . '%')
                    ->orWhere('car_model', 'LIKE', '%' . $search . '%')
                    ->orWhere('year', 'LIKE', '%' . $search . '%');
                });
        }
        
        // Apply filter query
        if ($filter === 'bookings') {
            $query->whereHas('cars.bookings', function ($subquery) {
                $subquery->where(function ($subquery) {
                    $subquery->whereNull('returned_at')
                        ->orWhere('returned_at', '=', '');
                });
            });
        } elseif ($filter === 'no_bookings') {
            $query->whereHas('cars', function ($subquery) {
                $subquery->whereDoesntHave('bookings')
                    ->orWhereHas('bookings', function ($subquery) {
                        $subquery->whereNotNull('returned_at')
                            ->orWhere('returned_at', '!=', '');
                    });
            });
        }
        
        $users = $query->paginate(10);
        
        $carsWithOwners = DB::table('cars')
            ->join('users', 'cars.car_owner_id', '=', 'users.id')
            ->select('users.first_name', 'users.last_name', 'cars.car_brand', 'cars.car_model', 'cars.year', 'cars.car_owner_id')
            ->get();
        
        return view('admin.owners', compact('users', 'carsWithOwners'));
    }
    
    public function customershow(Request $request)
    {
        $search = $request->input('search');
        $filter = $request->input('filter'); // Add this line to get the filter value
    
        $query = User::where('user_type', 'customer')->withCount('bookings');
    
        // Apply search query
        if ($search) {
            $query->where(function ($subquery) use ($search) {
                $subquery->where('first_name', 'LIKE', '%' . $search . '%')
                    ->orWhere('last_name', 'LIKE', '%' . $search . '%')
                    ->orWhere('email', 'LIKE', '%' . $search . '%')
                    ->orWhere('address', 'LIKE', '%' . $search . '%')
                    ->orWhere('phone_number', 'LIKE', '%' . $search . '%')
                    ->orWhere('contactperson1', 'LIKE', '%' . $search . '%')
                    ->orWhere('contactperson2', 'LIKE', '%' . $search . '%')
                    ->orWhereHas('bookings', function ($bookingQuery) use ($search) {
                        $bookingQuery->where('pickup_date_time', 'LIKE', '%' . $search . '%')
                            ->orWhere('return_date_time', 'LIKE', '%' . $search . '%')
                            ->orWhereHas('car', function ($carQuery) use ($search) {
                                $carQuery->where('car_brand', 'LIKE', '%' . $search . '%')
                                    ->orWhere('car_model', 'LIKE', '%' . $search . '%')
                                    ->orWhere('year', 'LIKE', '%' . $search . '%');
                            })
                            ->orWhereHas('car.owner', function ($ownerQuery) use ($search) {
                                $ownerQuery->where('first_name', 'LIKE', '%' . $search . '%')
                                    ->orWhere('last_name', 'LIKE', '%' . $search . '%');
                            });
                    });
            });
        }
    
        // Apply filter query
        if ($filter === 'bookings') {
            $query->whereHas('bookings', function ($subquery) {
                $subquery->where(function ($subquery) {
                    $subquery->whereNull('returned_at')
                        ->orWhere('returned_at', '=', '');
                });
            });
        } elseif ($filter === 'no_bookings') {
            $query->whereDoesntHave('bookings')
                ->orWhereHas('bookings', function ($subquery) {
                    $subquery->whereNotNull('returned_at')
                        ->orWhere('returned_at', '!=', '');
                });
        }
    
        $users = $query->paginate(10);
    
        // Load the related bookings, cars, and their owners
        $users->load([
            'bookings.car.owner' => function ($query) {
                $query->withTrashed();
            },
            'bookings.car' => function ($query) {
                $query->withTrashed();
            }
        ]);
    
        return view('admin.customers', compact('users'));
    }
    
    
    public function show($id)
    {
        $data = Car::findOrFail($id);
        // dd($data);
        $carOwnersWithCars = DB::table('users')
        ->join('cars', 'users.id', '=', 'cars.car_owner_id')
        ->select('users.first_name', 'users.last_name')
        ->where('cars.id', $id)
        ->get();
        return view('admin.edit', ['car' => $data, 'carOwnersWithCars' => $carOwnersWithCars]);
    }
    public function showOwner($id)
    {
        $user = User::findOrFail($id);

        return view('admin.ownerEdit', ['user' => $user]);
    }
    public function showCustomer($id)
    {
        $user = User::findOrFail($id);
        return view('admin.editCustomer', ['user' => $user]);
    }
    public function update(Request $request, Car $car){
      
        $validated = $request->validate([
        'display_picture' => ['mimes:jpg,jpeg,png', 'max:2048'],
        'car_brand' => ['required', 'string', 'max:255'],
        'car_model' => ['required', 'string', 'max:255'],
        'year' => ['required', 'integer', 'min:1900', 'max:' . date('Y')],
        'seats' => ['required', 'integer', 'min:1'],
        'plate_number' => ['required', 'string', 'max:255'],
        'vehicle_identification_number' => ['required', 'string', 'max:255'],
        'location' => ['required', 'string', 'max:255'],
        'certificate_of_registration' => ['mimes:jpg,jpeg,png,pdf', 'max:2048'],
        'car_description' => ['required', 'string', 'max:1000'],
        'rental_fee' => 'required|numeric|min:0',
        'add_picture1' => ['mimes:jpg,jpeg,png', 'max:2048'],
        'add_picture2' => ['mimes:jpg,jpeg,png', 'max:2048'],
        'add_picture3' => ['mimes:jpg,jpeg,png', 'max:2048'],

        ]);
        if ($request->hasFile('display_picture')) {
            $displaypicture = $request->file('display_picture')->store('public/dp');
            $validated['display_picture'] = $displaypicture;
        }
    
        if ($request->hasFile('add_picture1')) {
            $add_picture1 = $request->file('add_picture1')->store('public/dp');
            $validated['add_picture1'] = $add_picture1;
        }
        if ($request->hasFile('add_picture2')) {
            $add_picture2 = $request->file('add_picture2')->store('public/dp');
            $validated['add_picture2'] = $add_picture2;
        }
        if ($request->hasFile('add_picture3')) {
            $add_picture3 = $request->file('add_picture3')->store('public/dp');
            $validated['add_picture3'] = $add_picture3;
        }
        if ($request->hasFile('certificate_of_registration')) {
            $certificate_of_registration = $request->file('certificate_of_registration')->store('public/cor');
            $validated['certificate_of_registration'] = $certificate_of_registration;
        }
       
        $car->update($validated);
        
        return redirect('/cars/details')->with('message', 'Data was successfully updated');
    }
    public function ownerUpdate(Request $request, User $user){
            $validated = $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['string', 'min:8'],
            'address' => ['required', 'string', 'max:255'],
            'phone_number' => ['required', 'string', 'max:255'],
            'birthday' => ['required', 'date', new UnderEighteen],
            'govtid' => ['required', 'string', 'max:255'],
            'govtid_image' => ['mimes:jpg,jpeg,png', 'max:2048'],
            'driverslicense' => ['required', 'string', 'max:255'],
            'driverslicense_image' => [ 'image', 'max:2048'],
            'driverslicense2_image' => [ 'image', 'max:2048'],
            'selfie_image' => ['image', 'max:2048'],
            'contactperson1' => ['required', 'string', 'max:255'],
            'contactperson1number' => ['required', 'string', 'max:255'],
            'contactperson2' => ['required', 'string', 'max:255'],
            'contactperson2number' => ['required', 'string', 'max:255'],
        ]);
        if ($request->hasFile('govtid_image')) {
            $govtidImage = $request->file('govtid_image')->store('public/images');
            $validated['govtid_image'] = $govtidImage;
        }
    
        if ($request->hasFile('driverslicense_image')) {
            $driversLicenseImage = $request->file('driverslicense_image')->store('public/images');
            $validated['driverslicense_image'] = $driversLicenseImage;
        }
    
        if ($request->hasFile('driverslicense2_image')) {
            $driversLicense2Image = $request->file('driverslicense2_image')->store('public/images');
            $validated['driverslicense2_image'] = $driversLicense2Image;
        }
    
        if ($request->hasFile('selfie_image')) {
            $selfieImage = $request->file('selfie_image')->store('public/images');
            $validated['selfie_image'] = $selfieImage;
        }
        $user->update($validated);
        
        return redirect('/owners/details')->with('message', 'Data was successfully updated');
    }
    public function customerUpdate(Request $request, User $user){
        $validated = $request->validate([
        'first_name' => ['required', 'string', 'max:255'],
        'last_name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255'],
        'password' => ['string', 'min:8'],
        'address' => ['required', 'string', 'max:255'],
        'phone_number' => ['required', 'string', 'max:255'],
        'birthday' => ['required', 'date', new UnderEighteen],
        'govtid' => ['required', 'string', 'max:255'],
        'govtid_image' => ['mimes:jpg,jpeg,png', 'max:2048'],
        'driverslicense' => ['required', 'string', 'max:255'],
        'driverslicense_image' => [ 'image', 'max:2048'],
        'driverslicense2_image' => [ 'image', 'max:2048'],
        'selfie_image' => ['image', 'max:2048'],
        'contactperson1' => ['required', 'string', 'max:255'],
        'contactperson1number' => ['required', 'string', 'max:255'],
        'contactperson2' => ['required', 'string', 'max:255'],
        'contactperson2number' => ['required', 'string', 'max:255'],
    ]);

    if ($request->hasFile('govtid_image')) {
        $govtidImage = $request->file('govtid_image')->store('public/images');
        $validated['govtid_image'] = $govtidImage;
    }

    if ($request->hasFile('driverslicense_image')) {
        $driversLicenseImage = $request->file('driverslicense_image')->store('public/images');
        $validated['driverslicense_image'] = $driversLicenseImage;
    }

    if ($request->hasFile('driverslicense2_image')) {
        $driversLicense2Image = $request->file('driverslicense2_image')->store('public/images');
        $validated['driverslicense2_image'] = $driversLicense2Image;
    }

    if ($request->hasFile('selfie_image')) {
        $selfieImage = $request->file('selfie_image')->store('public/images');
        $validated['selfie_image'] = $selfieImage;
    }
    $user->update($validated);
    
    return redirect('/customers/details')->with('message', 'Data was successfully updated');
}
    
    public function destroy(Car $car){
        $car->delete();
        return redirect('/cars/details')->with('message', 'Data was successfully deleted');
    }
    public function ownerDestroy(User $user){
        $user->cars()->delete(); // Delete associated cars
        $user->delete(); // Delete the owner
        return redirect('/owners/details')->with('message', 'Data was successfully deleted');
    }
    public function customerDestroy(User $user){
        $user->bookings()->delete(); // Delete associated bookings
        $user->delete(); // Delete the customer
        return redirect('/customers/details')->with('message', 'Data was successfully deleted');
    }

    public function bookshow()
    {
        $bookings = Booking::paginate(10);
        
        $bookings->load([
            'car.owner' => function ($query) {
                $query->withTrashed();
            },
            'car' => function ($query) {
                $query->withTrashed();
            }
        ]);
        
        $bookingClient = DB::table('users')
        ->join('bookings', 'users.id', '=', 'bookings.user_id')
        ->select('users.first_name', 'users.last_name')
        ->get();
        
        return view('admin.bookings', compact('bookings', 'bookingClient'));
    }

    public function verify()
    {
        $deactivatedUsers = User::where('account_status', 'Deactivated')->paginate(5);
        return view('admin.verification', compact('deactivatedUsers'));
    }
    
    public function carapprove()
    {
        $pendingCars = Car::with('owner')->where('status', 'pending')->paginate(5);
        $car_owner = User::where('user_type', 'car_owner')->get();
    
        return view('admin.carapproval', compact('pendingCars', 'car_owner'));
    }
    

    public function approveUser($userId)
    {
        $user = User::find($userId);
        if ($user) {
            $user->account_status = 'Active';
            $user->save();

            // Send approval email
            $this->sendApprovalEmail($user);

            return redirect()->back()->with('success', 'User approved successfully.');
        }

        return redirect()->back()->with('error', 'User not found.');
    }

    public function declineUser($userId)
    {
        $user = User::find($userId);
        if ($user) {
            $user->delete();

            // Send decline email
            $this->sendDeclineEmail($user);

            return redirect()->back()->with('success', 'User declined successfully.');
        }

        return redirect()->back()->with('error', 'User not found.');
    }

    private function sendApprovalEmail(User $user)
    {
        // Use the appropriate email template or customize the email content as needed
        $emailContent = "Your Account has passed the verification process and is now active! Please login to your account at https://traversecarrentals2023.duckdns.org/login";

        Mail::raw($emailContent, function ($message) use ($user) {
            $message->to($user->email)->subject('Account Approved');
        });
    }

    private function sendDeclineEmail(User $user)
    {
        // Use the appropriate email template or customize the email content as needed
        $emailContent = "Sorry, your account didn't meet our requirements. Please register again with valid documents.";

        Mail::raw($emailContent, function ($message) use ($user) {
            $message->to($user->email)->subject('Account Declined');
        });
    }

        public function approveCar($carId, $ownerId)
    {
        $car = Car::find($carId);
        if ($car) {
            $car->status = 'available';
            $car->save();

            // Get the car owner
            $carOwner = User::find($ownerId);

            // Send approval email to the car owner
            $this->sendCarApprovalEmail($carOwner, $car);
            return redirect()->back()->with('success', 'Car approved successfully.');
        }

        return redirect()->back()->with('error', 'Car not found.');
    }

    public function declineCar($carId, $ownerId)
    {
        $car = Car::find($carId);
        if ($car) {
            $car->delete();
          // Get the car owner
          $carOwner = User::find($ownerId);

          // Send approval email to the car owner
          $this->sendCarDeclineEmail($carOwner, $car);
            return redirect()->back()->with('success', 'Car declined successfully.');
        }

        return redirect()->back()->with('error', 'Car not found.');
    }

    private function sendCarApprovalEmail(User $carOwner, Car $car)
    {
        $carBrand = $car->car_brand;
        $carModel = $car->car_model;

        $emailContent = "Dear {$carOwner->first_name},\n\nWe are pleased to inform you that your car listing for {$carBrand} - {$carModel} has been approved. It can now be rented by renters. Thank you for choosing our platform.\n\nPlease login to your car owner dashboard at https://traversecarrentals2023.duckdns.org/car_owner/dashboard for more details.";

        Mail::raw($emailContent, function ($message) use ($carOwner) {
            $message->to($carOwner->email)->subject('Car Listing Approved');
        });
    }

    private function sendCarDeclineEmail(User $carOwner, Car $car)
    {
        $carBrand = $car->car_brand;
        $carModel = $car->car_model;

        $emailContent = "Dear {$carOwner->first_name},\n\nWe regret to inform you that your car listing for {$carBrand} - {$carModel} has been declined. Upon review, we found that some of the details you provided are not accurate or do not meet our guidelines for rental fees.\n\nPlease make sure to list your car again with valid and accurate details, and ensure that the rental fee falls within the specified price range.\n\nThank you for your understanding.";

        Mail::raw($emailContent, function ($message) use ($carOwner) {
            $message->to($carOwner->email)->subject('Car Listing Declined');
        });
    }
   

    public function sales(Request $request)
    {
        // Get the selected timeframe from the request
        $timeframe = $request->input('timeframe');
    
        // Calculate the start and end dates for the time range based on the selected timeframe
        $startDate = null;
        $endDate = null;
    
        if ($timeframe === 'weekly') {
            $startDate = Carbon::now()->startOfWeek();
            $endDate = Carbon::now()->endOfWeek();
        } elseif ($timeframe === 'monthly') {
            $startDate = Carbon::now()->startOfMonth();
            $endDate = Carbon::now()->endOfMonth();
        } elseif ($timeframe === 'yearly') {
            $startDate = Carbon::now()->startOfYear();
            $endDate = Carbon::now()->endOfYear();
        }
    
        // Retrieve the bookings within the time range
        $bookings = Booking::whereBetween('created_at', [$startDate, $endDate])->get();
    
        // Calculate the total commission for the bookings
        $totalCommission = 0;
        foreach ($bookings as $booking) {
            $totalCommission += $booking->getCommissionAmount();
        }
    
        // Calculate the total sales (without subtracting the commission)
        $totalSales = $bookings->sum('total_rental_fee');
    
        // Retrieve the top car owner with the most amount of sales
        $topCarOwner = User::where('user_type', 'car_owner')
            ->withCount(['bookings'])
            ->orderByDesc('bookings_count')
            ->first();
    
        $latestProfilePicture = $topCarOwner->profilePicture()->latest()->first();
    
        // Retrieve the sum of total rental fees for the top car owner
        $topCarOwnerTotalSales = Booking::join('cars', 'bookings.car_id', '=', 'cars.id')
            ->where('cars.car_owner_id', $topCarOwner->id)
            ->whereBetween('bookings.created_at', [$startDate, $endDate])
            ->sum('bookings.total_rental_fee');
    
        return view('admin.sales', [
            'totalCommission' => $totalCommission,
            'totalSales' => $totalSales,
            'totalBookings' => $bookings->count(),
            'topCarOwner' => $topCarOwner,
            'topCarOwnerTotalSales' => $topCarOwnerTotalSales,
            'latestProfilePicture' => $latestProfilePicture,
        ]);
    }

    public function weeklyDL(Request $request)
    {
    $weekData = json_decode($request->input('weekData'), true);


    // Retrieve the top car owner with the most amount of sales
    $topCarOwner = User::where('user_type', 'car_owner')
        ->withCount(['bookings'])
        ->orderByDesc('bookings_count')
        ->first();
        
    // Retrieve the commissions for the bookings
    $commissions = Commission::whereIn('booking_id', $bookings->pluck('id')->all())->get();
    $commissionreceived = $commissions->sum('commission_amount');

    // Generate the PDF view
    $pdf = PDF::loadView('admin.weekly', ['weekData' => $weekData]);

    // Generate the PDF filename
    $filename = 'weekly_data_' . date('Ymd') . '.pdf';

    // Retrieve the sum of total rental fees for the top car owner
    $topCarOwnerTotalSales = Booking::join('cars', 'bookings.car_id', '=', 'cars.id')
        ->where('cars.car_owner_id', $topCarOwner->id)
        ->whereBetween('bookings.created_at', [$startDate, $endDate])
        ->sum('bookings.total_rental_fee');

       // Prepare the commission data for the chart
$commissionData = [
    'labels' => [],
    'data' => []
];

if ($timeframe === 'weekly') {
    $numOfWeeks = $startDate->diffInWeeks($endDate) + 1;
    $dateRangeFormat = 'W M'; 
    // Generate the labels for the chart based on the number of weeks
    for ($i = 1; $i <= $numOfWeeks; $i++) {
        $label = 'Week ' . $i;
        $labelStartDate = $startDate->copy()->addWeeks($i - 1);
        $labelEndDate = $startDate->copy()->addWeeks($i)->subDay();
        $commissionData['labels'][] = $label . ' (' . $labelStartDate->format($dateRangeFormat) . ' - ' . $labelEndDate->format($dateRangeFormat) . ')';
    }

    // Retrieve the commission data for each week
    for ($i = 1; $i <= $numOfWeeks; $i++) {
        $weekStartDate = $startDate->copy()->addWeeks($i - 1);
        $weekEndDate = $startDate->copy()->addWeeks($i)->subDay();

        // Retrieve the commissions within the week
        $weekCommissions = Commission::whereIn('booking_id', $bookings->pluck('id')->all())
            ->whereBetween('created_at', [$weekStartDate, $weekEndDate])
            ->get();

        // Calculate the total commission for the week
        $weekCommissionTotal = $weekCommissions->sum('commission_amount');

        $commissionData['data'][] = $weekCommissionTotal;
    }
} elseif ($timeframe === 'monthly') {
    $numOfMonths = 12; // Change this number as per your requirement
    $dateRangeFormat = 'M Y'; // Customize the date range format if needed

    // Generate the labels for the chart based on the number of months
    for ($i = 1; $i <= $numOfMonths; $i++) {
        $label = Carbon::create(null, $i, 1)->format($dateRangeFormat);
        $labelStartDate = Carbon::create(null, $i, 1)->startOfMonth();
        $labelEndDate = Carbon::create(null, $i, 1)->endOfMonth();
        $commissionData['labels'][] = $label . ' (' . $labelStartDate->format($dateRangeFormat) . ' - ' . $labelEndDate->format($dateRangeFormat) . ')';
    }

    // Retrieve the commission data for each month
    for ($i = 1; $i <= $numOfMonths; $i++) {
        $monthStartDate = Carbon::create(null, $i, 1)->startOfMonth();
        $monthEndDate = Carbon::create(null, $i, 1)->endOfMonth();

        // Retrieve the commissions within the month
        $monthCommissions = Commission::whereIn('booking_id', $bookings->pluck('id')->all())
            ->whereBetween('created_at', [$monthStartDate, $monthEndDate])
            ->get();

        // Calculate the total commission for the month
        $monthCommissionTotal = $monthCommissions->sum('commission_amount');

        $commissionData['data'][] = $monthCommissionTotal;
    }
} elseif ($timeframe === 'yearly') {
    $startYear = Carbon::now()->startOfYear()->year;
    $endYear = Carbon::now()->year;
    $dateRangeFormat = 'Y'; // Customize the date range format if needed

    // Generate the labels for the chart based on the number of years
    for ($year = $startYear; $year <= $endYear; $year++) {
        $label = 'Year ' . $year;
        $labelStartDate = Carbon::createFromDate($year, 1, 1);
        $labelEndDate = Carbon::createFromDate($year, 12, 31);
        $commissionData['labels'][] = $label . ' (' . $labelStartDate->format($dateRangeFormat) . ' - ' . $labelEndDate->format($dateRangeFormat) . ')';
    }

    // Retrieve the commission data for each year
    for ($year = $startYear; $year <= $endYear; $year++) {
        $yearStartDate = Carbon::createFromDate($year, 1, 1);
        $yearEndDate = Carbon::createFromDate($year, 12, 31);

        // Retrieve the commissions within the year
        $yearCommissions = Commission::whereIn('booking_id', $bookings->pluck('id')->all())
            ->whereBetween('created_at', [$yearStartDate, $yearEndDate])
            ->get();

        // Calculate the total commission for the year
        $yearCommissionTotal = $yearCommissions->sum('commission_amount');

        $commissionData['data'][] = $yearCommissionTotal;
    }
}
        

    return view('admin.sales', [
        'commissionreceived' => $commissionreceived,
        'totalCommission' => $totalCommission,
        'totalSales' => $totalSales,
        'totalBookings' => $bookings->count(),
        'topCarOwner' => $topCarOwner,
        'topCarOwnerTotalSales' => $topCarOwnerTotalSales,
        'latestProfilePicture' => $latestProfilePicture,
        'commissionData' => $commissionData,
        'timeframe'=> $timeframe,
    ]);
}
public function getSalesData(Request $request)
{
    $timeframe = $request->input('timeframe', 'monthly');
    $startDate = null;
    $endDate = null;

    if ($timeframe === 'weekly') {
        $startDate = Carbon::now()->startOfWeek();
        $endDate = Carbon::now()->endOfWeek();
    } elseif ($timeframe === 'monthly') {
        $startDate = Carbon::now()->startOfMonth();
        $endDate = Carbon::now()->endOfMonth();
    } elseif ($timeframe === 'yearly') {
        $startDate = Carbon::now()->startOfYear();
        $endDate = Carbon::now()->endOfYear();

    // Download the PDF file
    return $pdf->download($filename);

    }
}
    public function monthlyDL(Request $request)
    {
        $selectedMonth = $request->input('month');
        $year = date('Y');
        $monthlyData = $this->generateMonthlyData($selectedMonth, $year);

        // Generate the PDF using the data and the corresponding view
        $pdf = PDF::loadView('admin.monthly', [
            'monthData' => $monthlyData,
            'selectedMonth' => $selectedMonth,
            'currentMonth' => Carbon::parse("{$year}-{$selectedMonth}-01")->format('F'),
            'currentYear' => $year,
        ]);

        // Download the PDF
        return $pdf->download('monthly_data.pdf');
    }
    
    private function generateMonthlyData($selectedMonth, $year)
    {
        $startOfMonth = Carbon::create($year, $selectedMonth, 1)->startOfMonth();
        $endOfMonth = $startOfMonth->copy()->endOfMonth();

        // Initialize an empty array to store the daily data
        $monthlyData = [];

        // Loop through each day of the selected month
        while ($startOfMonth <= $endOfMonth) {
            $day = $startOfMonth->format('Y-m-d');
            $nextDay = $startOfMonth->copy()->addDay();

            // Retrieve the data for each day from your database or any other source
            // Perform the necessary calculations or queries to get the data for the specific day
            $carOwnerCount = User::where('user_type', 'car_owner')
                ->whereBetween('created_at', [$day, $nextDay])
                ->count();

            $customerCount = User::where('user_type', 'customer')
                ->whereBetween('created_at', [$day, $nextDay])
                ->count();

            $bookingCount = Booking::whereBetween('created_at', [$day, $nextDay])
                ->count();

            $carCount = Car::whereBetween('created_at', [$day, $nextDay])
                ->count();

            // Add the data to the $monthlyData array
            $monthlyData[$day] = [
                'carOwnerCount' => $carOwnerCount,
                'customerCount' => $customerCount,
                'bookingCount' => $bookingCount,
                'carCount' => $carCount,
            ];

            $startOfMonth->addDay();
        }

        return $monthlyData;
    }
    

}

