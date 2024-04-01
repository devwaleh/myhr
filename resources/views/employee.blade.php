<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-dark dark:text-gray-200 leading-tight">
            {{ __($employee['first_name'] . ' ' . $employee['last_name'])}}
        </h2>
    </x-slot>

   <div class="container">
    <div class="row justify-content-center pb-4 mt-3">
        <div class="col-md-6 bg-light p-3">
            <div><h2 class="mb-2 text-dark text-center">EDIT EMPLOYEE</h2></div>
            <form action="{{route('employee.update', [$employee['id']])}}" method="post" enctype="multipart/form-data">
                @method('put')
                @csrf
                <div class="py-2">
                    <input type="text" name="first_name" id="first_name" placeholder="First Name" class="form-control border-dark" value="{{$employee['first_name']}}" required>
                    @error('first_name')
                    <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
                <div class="py-2">
                    <input type="text" name="last_name" id="last_name" placeholder="Last Name" class="form-control border-dark" value="{{$employee['last_name']}}" required>
                    @error('last_name')
                    <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
                <div class="py-2">
                    <input type="email" name="email_address" id="email_address" placeholder="Email Address" class="form-control border-dark" value="{{$employee['email']}}" required>
                    @error('email_address')
                    <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
                <div class="py-2">
                    <input type="text" name="phone_number" id="phone_number" placeholder="Phone Number" class="form-control border-dark" value="{{$employee['phone']}}" required>
                    @error('phone_number')
                    <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
                <div class="py-2 text-center">
                    <button type="submit" class="btn btn-dark col-6">Update Employee</button>
                </div>
            </form>
        </div>
    </div>


   </div>
</x-app-layout>
