
    <div class="form-group">
        <label for="email">Old Password</label>
            {!! Form::password('password',null, [
            'class' => 'form-control'
            ]) !!}
    </div>
    <div class="form-group">
        <label for="password">New Password</label>
            {!! Form::password('password', [
            'class' => 'form-control'
            ]) !!}
    </div>
    <div class="form-group">
        <label for="password_confirmation">Password</label>
            {!! Form::password('password_confirmation', [
            'class' => 'form-control'
            ]) !!}
    </div>

   
