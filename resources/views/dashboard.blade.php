<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-dark dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

   <div class="container">
    <div class="row">
        <div class="col">
            <div class="p-6 text-dark dark:text-gray-100">
                @if (session('success'))
                    <div class="alert alert-success">{{session('success')}}</div>
                @endif
                <h1 class="text-center text-light mb-2"><b>COMPANIES</b></h3>
                    {{-- {{dd($company)}} --}}
                <table class="table table-hover table-striped table-bordered">
                    @if ($companies)
                    <thead>
                        <tr>
                            <th>Logo</th>
                            <th>Company</th>
                            <th>Email Address</th>
                            <th>Website</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($companies as $company)
                            <tr>
                                <td><img src="{{asset('/storage/app/'.$company['logo'])}}" alt=""></td>
                                <td>{{$company['name']}}</td>
                                <td>{{$company['email']}}</td>
                                <td><a href="{{$company['website']}}" target="_blank">{{$company['website']}}</a></td>
                                <td><a href="{{route('company.index',[$company['id']])}}"><i class="fa-solid fa-eye"></i></a> &nbsp <form action="{{route('company.destroy',[$company['id']])}}" method="post">
                                    @method('delete')
                                    @csrf
                                    <button><i class="fa-solid fa-trash"></button>
                                </form></td>
                            </tr>
                        @endforeach
                    </tbody>
                    @else
                        <div class="alert alert-info">No company available</div>
                    @endif

                </table>
            </div>
        </div>
    </div>
    <div class="row justify-content-center pb-4" id="add_company">
        <div class="col-md-6 bg-light p-3">
            <div><h2 class="mb-2 text-dark text-center">ADD COMPANY</h2></div>
            <form action="{{route('company.create')}}" method="post" enctype="multipart/form-data">
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
                    <button type="submit" class="btn btn-dark col-6">Add Company</button>
                </div>
            </form>
        </div>
    </div>
   </div>
</x-app-layout>
