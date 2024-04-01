<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-dark dark:text-gray-200 leading-tight">
            {{ __($company['name'])}}
        </h2>
    </x-slot>

   <div class="container">
    <div class="row">
        <div class="col">
            <div class="p-6 text-dark dark:text-gray-100">
                @if (session('success'))
                    <div class="alert alert-success">{{session('success')}}</div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger">{{session('error')}}</div>
                @endif
                <h1 class="text-center text-light mb-2"><b>EMPLOYEES</b></h3>
                    {{-- {{dd($employees)}} --}}
                <table class="table table-hover table-striped table-bordered">
                    @if ($employees)
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email Address</th>
                            <th>Phone Number</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($employees as $employee)
                            <tr>
                                <td>{{$employee['first_name']}} {{$employee['last_name']}}</td>
                                <td>{{$employee['email']}}</td>
                                <td>{{$employee['phone']}}</td>
                                <td><a href="{{route('employee.index',[$employee['id']])}}"><i class="fa-solid fa-pencil"></i></a> &nbsp <form action="{{route('employee.destroy',[$company['id'],$employee['id']])}}" method="post">
                                    @method('delete')
                                    @csrf
                                    <button><i class="fa-solid fa-trash"></button>
                                </form></td>
                            </tr>
                        @endforeach
                    </tbody>
                    @else
                        <div class="alert alert-info">No employee available</div>
                    @endif

                </table>
            </div>
        </div>
    </div>
    <div class="row justify-content-center pb-4">
        <div class="col-md-6 bg-light p-3">
            <div><h2 class="mb-2 text-dark text-center">ADD EMPLOYEE</h2></div>
            <form action="{{route('employee.create')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="py-2">
                    <input type="text" name="first_name" id="first_name" placeholder="First Name" class="form-control border-dark" required>
                    @error('first_name')
                    <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
                <div class="py-2">
                    <input type="text" name="last_name" id="last_name" placeholder="Last Name" class="form-control border-dark" required>
                    @error('last_name')
                    <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
                <div class="py-2">
                    <input type="email" name="email_address" id="email_address" placeholder="Email Address" class="form-control border-dark" required>
                    @error('email_address')
                    <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
                <div class="py-2">
                    <input type="text" name="phone_number" id="phone_number" placeholder="Phone Number" class="form-control border-dark" required>
                    @error('phone_number')
                    <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
                <input type="hidden" name="company_id" value="{{$company['id']}}">
                <div class="py-2 text-center">
                    <button type="submit" class="btn btn-dark col-6">Add Employee</button>
                </div>
            </form>
        </div>
    </div>

    <div class="row justify-content-center pb-4" id="edit_company">
        <div class="col-md-6 bg-light p-3">
            <div><h2 class="mb-2 text-dark text-center">Edit COMPANY</h2></div>
            <form action="{{route('company.update',[$company['id']])}}" method="post" enctype="multipart/form-data">
                @method('put')
                @csrf
                <div class="py-2">
                    <input type="text" name="company_name" id="company_name" placeholder="Company Name" class="form-control border-dark" required>
                    @error('company_name')
                    <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
                <div class="py-2">
                    <input type="email" name="email_address" id="email_address" placeholder="Email Address" class="form-control border-dark" required>
                    @error('email_address')
                    <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
                <div class="py-2">
                    <input type="text" name="website" id="website" placeholder="Company Website" class="form-control border-dark">
                    @error('website')
                    <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
                <div class="py-2">
                    <label for="logo" class="pb-1">Company Logo</label>
                    <input type="file" name="logo" id="logo" class="form-control">
                    @error('logo')
                    <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
                <div class="py-2 text-center">
                    <button type="submit" class="btn btn-dark col-6">Edit  Company</button>
                </div>
            </form>
        </div>
    </div>
   </div>
</x-app-layout>
