@extends('front.layouts.master')

    @inject('model', 'App\Models\Client')

    @inject('blood_type', 'App\Models\BloodType')

    @inject('governorates', 'App\Models\Governorate')

    @section('title')
        <p>Blood Bank registeration</p>
    @endsection

    @section('content')
       

        <!-- Sign Up Start -->
        <section id="sign-up">
            <div class="container">
                    <img src="{{ asset('front/imgs/logo.png') }}" alt="">
                    {!! Form::model($model, [
                        'url' => url('client-register')
                    ]) !!}
                        <input type="text"  name="name"  placeholder="Name" required="" value="{{ old('name') }}">
                        <input type="text"  name="email" placeholder="Email" required="" value="{{ old('email') }}">
                        <input type="phone" name="phone" placeholder="Phone Number" required="" value="{{ old('phone') }}">
                        <input type="password" name="password" placeholder="Password" class="form-control" value="{{ old('password') }}">
                        <input type="password" name="password_confirmation" placeholder="Password Confirmation" class="form-control" value="{{ old('password') }}">
                        <div class="form-group">
                           {!! Form::select('blood_type_id', 
                               $blood_type->all()->pluck('name', 'id'), null , [
                                  'class'=> 'form-control'
                            ]) !!}
                        </div>    
                        <input type="date" name="date_of_birth"  class="form-control">
                        <input type="date" name="last_donation_date" placeholder="Last Donation date" class="form-control">
                        <div class="form-group">
                            {!! Form::select('governorate_id', 
                                $governorates->all()->pluck('name', 'id')->toArray(), null, [
                                    'id' => 'governorate',
                                    'placeholder' => 'Select Governorate'
                                ]) !!}

                            {!! Form::select('city_id', [], null, [
                                 'id'          => 'city',
                                 'placeholder' => 'select City'
                            ]) !!}
                        </div>
            
                        <div class="reg-group">
                            <input class="check" type="checkbox" required="" style="height: auto; display:inline; margin: 0 auto;">Agree on terms and conditions<br>
                            <button class="submit" type="submit" style="background-color: rgb(51, 58, 65);">Submit</button>
                        </div>
                    {!! Form::close() !!}
            </div>
        </section>
        <!-- Sign Up End -->
        
        @push('scripts')

           <script>
             
               
            $('#governorate').change(function (e) {
                 //alert('good');
                e.preventDefault();
                //get gov
                //send ajax
                //append cities
                var governorate_id=$('#governorate').val();
                 console.log(governorate);
                if(governorate_id){
                    $.ajax({
                        url:'get-cities/'+governorate_id ,
                        type:'get',
                        success:function (data) {
                            if(data.status==1){
                                console.log(data.data);
                                $('#city').empty();
                                $('#city').append('<option value=""> city</option>');
                                $.each(data.data ,function (index, city) {
                                    $('#city').append('<option value="'+city.id+'">'+city.name+'</option>');
                                });
                            }
                        }
                    });
                }else{
                    $('#city').empty();
                    $('#city').append('<option value=""> city</option>');
                }
            });
           
           </script>
        @endpush
    @endsection